<?php

namespace App\Filament\Resources\BookingResource\Widgets;

use App\Models\Booking;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ReceivedOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Received', 'Rp ' . number_format(Booking::query()->sum('total_amount'), 0, ',', '.'))
        ];
    }

    protected function getHeading(): ?string
    {
        return 'Total Received';
    }
    protected function getColumns(): int
    {
        return 2; // Menjadikan layout menjadi dua kolom
    }
}
