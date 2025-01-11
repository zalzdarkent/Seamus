<?php

namespace App\Filament\Resources\RoomResource\Widgets;

use App\Models\Room;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsRoomOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Studio Rooms', Room::query()->count())
        ];
    }
    protected function getHeading(): ?string
    {
        return 'Total Studio Rooms';
    }
}
