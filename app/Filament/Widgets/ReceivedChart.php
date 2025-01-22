<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Booking;
use Carbon\Carbon;

class ReceivedChart extends ChartWidget
{
    protected static ?string $heading = 'Yearly Revenue';

    protected function getData(): array
    {
        // Mengambil data total_amount per bulan
        $data = Booking::selectRaw('SUM(total_amount) as total, MONTH(created_at) as month')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Membuat array data untuk chart
        $amounts = [];
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        // Inisialisasi array dengan 0 untuk setiap bulan
        foreach ($labels as $label) {
            $amounts[] = 0;
        }

        // Mengisi data sesuai bulan
        foreach ($data as $item) {
            // Menggunakan bulan yang sesuai dengan index array
            $amounts[$item->month - 1] = $item->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Received (Rupiah)',
                    'data' => $amounts,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Bisa diganti sesuai jenis chart yang diinginkan
    }
}

