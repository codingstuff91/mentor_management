<?php

namespace App\Services;

use App\Models\Invoice;
use Carbon\Carbon;

class InvoiceService
{
    public static function compute_total_price(Invoice $invoice): int
    {
        return $invoice->courses->sum('price');
    }

    public static function compute_total_hours(Invoice $invoice): string
    {
        $total = Carbon::parse('00:00');

        $courses = $invoice->courses;

        foreach ($courses as $course) {
            $total->addHours(Carbon::parse($course->duration)->hour);
            $total->addMinutes(Carbon::parse($course->duration)->minute);
        }

        return $total->format('H:i');
    }
}
