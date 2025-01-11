<?php

namespace App\Filament\Resources\FacilityResource\Widgets;

use App\Models\Facility;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsFacilityOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Musical Instrument', Facility::query()->count())
        ];
    }
    protected function getHeading(): ?string
    {
        return 'Total Musical Instrument';
    }
}
