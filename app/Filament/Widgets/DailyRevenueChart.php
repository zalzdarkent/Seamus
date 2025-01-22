<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Booking;
use Carbon\Carbon;

class DailyRevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Daily Revenue';

    protected function getData(): array
    {
        // Ambil data dari 7 hari terakhir
        $data = Booking::query()
            ->whereDate('created_at', '>=', Carbon::now()->subDays(6))
            ->groupByRaw('DATE(created_at)')
            ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
            ->orderBy('date')
            ->get();

        // Buat array default untuk 7 hari terakhir
        $dates = collect(range(0, 6))->map(function ($day) {
            return Carbon::now()->subDays($day)->format('Y-m-d');
        })->reverse()->values();

        // Format data agar sesuai dengan labels
        $revenueData = $dates->map(function ($date) use ($data) {
            return $data->firstWhere('date', $date)?->total ?? 0;
        });

        return [
            'datasets' => [
                [
                    'label' => 'Total Revenue (Rupiah)',
                    'data' => $revenueData->toArray(),
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => '#4ade80',
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $dates->map(fn ($date) => Carbon::parse($date)->format('D'))->toArray(), // Label hari (Sen, Sel, Rab, dst.)
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
