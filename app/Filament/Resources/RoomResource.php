<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Filament\Resources\RoomResource\RelationManagers;
use App\Models\Facility;
use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('name')
                        ->label('Room Name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('category')
                        ->label('Category')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\FileUpload::make('photo')
                        ->label('Photo')
                        ->required()
                        ->image()
                        ->directory('rooms/photos') // Simpan di folder rooms/photos
                        ->visibility('public')
                        ->maxSize(5120)
                        ->acceptedFileTypes(['image/jpeg', 'image/png'])
                        ->deleteUploadedFileUsing(function ($file, $record) {
                            // Hapus file lama dari storage
                            if ($record && $record->photo && $file !== $record->photo) {
                                Storage::delete($record->photo);
                            }
                        }),
                    Forms\Components\TextInput::make('price_per_hour')
                        ->label('Price Per Hour')
                        ->required()
                        ->numeric(),
                    Forms\Components\MultiSelect::make('facilities')
                        ->label('Facilities')
                        ->relationship('facilities', 'name') // Relasi dengan facilities
                        ->options(Facility::all()->pluck('name', 'id'))
                        ->required(),
                ])->columnSpan('full'), // Membuat Card full-width
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Room Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Photo')
                    ->width(80) // Lebar kolom dalam piksel
                    ->height(80),
                Tables\Columns\TextColumn::make('price_per_hour')
                    ->label('Price Per Hour')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')), // Atur ke mata uang sesuai kebutuhan
                Tables\Columns\TagsColumn::make('facilities.name')
                    ->label('Facilities')
                    ->separator(', '), // Pisahkan fasilitas dengan koma
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Category')
                    ->options(Room::pluck('category', 'category')->unique()->toArray()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
