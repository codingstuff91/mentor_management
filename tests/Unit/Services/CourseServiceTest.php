<?php

use App\Services\CourseService;

it('calculates the total price of a course based on duration and hourly rate', function ($duration, $expectedTotalPrice) {
    $hourlyRate = 10;

    $courseTotalPrice = CourseService::calculate_total_price($duration, $hourlyRate);

    expect($courseTotalPrice)->toBe($expectedTotalPrice);
})->with([
    'One hour' => [60, 10],
    'Two hours' => [120, 20],
    'Two hours and 30 minutes' => [150,25],
]);

it('transform course duration into minutes', function () {
    $courseDuration = "03:00:00";

    $courseDurationInSeconds = CourseService::transform_duration_in_minutes($courseDuration);

    expect($courseDurationInSeconds)->toBe(180);
});

it('transform course duration in minutes into hour format', function () {
    $courseDuration = 150;

    $courseDurationInSeconds = CourseService::tranform_duration_into_HH_MM_format($courseDuration);

    expect($courseDurationInSeconds)->toBe("02:30");
});


