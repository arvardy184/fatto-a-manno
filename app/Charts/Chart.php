<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Buy;
use Ramsey\Uuid\Type\Integer;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class Chart
{
    protected $chart;


    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($month, $year, $clothes_type, $clothes_color)
    {

        // Start building the query
        $query = Buy::with('cloth');

        // Apply filters based on validated data
        if (!is_null($month)) {
            $query->whereMonth('created_at', $month);
            $query->whereYear('created_at', $year);
        } else {
            if (!is_null($year)) {
                $query->whereYear('created_at', $year);
            }
        }

        if (!is_null($clothes_type) || !is_null($clothes_color)) {
            $query->whereHas('cloth', function ($q) use ($clothes_type, $clothes_color) {
                if (!is_null($clothes_type)) {
                    $q->where('type', $clothes_type);
                }
                if (!is_null($clothes_color)) {
                    $q->where('color', $clothes_color);
                }
            });
        }

        // Determine how to group the results
        if (!is_null($month)) {
            // Group by day if month is provided
            $data = $query->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->groupBy('date')
                ->get()
                ->toArray();
            if ($data) {
                $counts = $this->getCountsArrayForMonth(Carbon::parse($data[0]['date']), $data);
            } else {
                $counts = [];
            }

            $dates = $this->getAllDatesInMonth($year, $month);
        } else {
            // Group by month if month is not provided
            $data = $query->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->groupBy('month')
                ->get()
                ->toArray();

            $counts = $this->getCountsArrayForMonths($data);
            $dates = $this->getAllMonthNamesInYear($year);
        }


        return $this->chart->horizontalBarChart()
            ->setTitle('Transaction Analysis')
            ->setSubtitle('Clothes ' . $clothes_type . ' ' . $clothes_color)
            ->setColors(['#FFC107', '#D32F2F'])
            ->addData('Quantity', $counts)
            ->setXAxis($dates);

    }

    public function getCountsArrayForMonth(?string $month, array $data): array
    {
        $counts = [];

        if (!is_null($month)) {
            // Parse the month string into a Carbon instance
            $startOfMonth = Carbon::parse($month)->startOfMonth();
            $endOfMonth = Carbon::parse($month)->endOfMonth();
            $daysInMonth = $startOfMonth->daysInMonth;

            // Initialize the counts array with zeros
            $counts = array_fill(0, $daysInMonth, 0);

            // Create a map of dates to counts from the input data
            foreach ($data as $item) {
                $date = Carbon::parse($item['date']);
                $index = $date->day - 1; // day of month - 1 for zero-based index
                $counts[$index] = $item['count'];
            }
        }

        return $counts;
    }

    public function getAllDatesInMonth(int $year, int $month): array
    {
        $dates = [];

        // Create a Carbon instance for the first day of the month
        $startOfMonth = Carbon::createFromDate($year, $month, 1);
        // Get the last day of the month
        $endOfMonth = $startOfMonth->copy()->endOfMonth();

        // Generate all dates from the start to the end of the month
        for ($date = $startOfMonth; $date->lte($endOfMonth); $date->addDay()) {
            $dates[] = $date->toDateString(); // Format date as a string
        }

        return $dates;
    }

    public function getAllMonthNamesInYear($year)
    {
        $months = [];

        // Loop through each month of the year
        for ($month = 1; $month <= 12; $month++) {
            // Create a Carbon instance for the current month and year
            $date = Carbon::create($year, $month, 1);

            // Add the name of the month to the array
            $months[] = $date->format('F');
        }

        return $months;
    }

    function getCountsArrayForMonths(array $data): array
    {
        $counts = array_fill(0, 12, 0);

        // Loop through each item in the data
        foreach ($data as $item) {
            // Extract month and count from the item
            $month = $item['month'];
            $count = $item['count'];

            // Add the count to the corresponding month in the counts array
            $counts[$month - 1] += $count;
        }

        return $counts;
    }
}
