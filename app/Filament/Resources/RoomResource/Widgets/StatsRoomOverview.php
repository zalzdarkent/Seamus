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
            Stat::make('Musical Instrument', Room::query()->count())
        ];
    }
}
