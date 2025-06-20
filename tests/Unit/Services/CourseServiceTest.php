<?php

use App\Services\CourseService;

it('calculates the total price of a course based on duration and hourly rate', function ($duration, $expectedTotalPrice) {
    $courseTotalPrice = CourseService::calculate_total_price($duration, 10);

    expect($courseTotalPrice)->toBe($expectedTotalPrice);
})->with([
    'One hour' => ["01:00:00", 10],
    'One hour and 30 minutes' => ["01:30:00", 15],
    'Two hours and 30 minutes' => ["02:30:00", 25],
]);

it('transform course duration into minutes', function ($duration, $expectedMinutesCount) {
    $courseDurationInSeconds = CourseService::transform_duration_in_minutes($duration);

    expect($courseDurationInSeconds)->toBe($expectedMinutesCount);
})->with([
    'One hour' => ["01:00:00", 60],
    'One hour and 40 minutes' => ["01:40:00",100],
    'Two hours and 30 minutes' => ["02:30:00",150],
]);;

it('transform course duration in minutes into hour format', function () {
    $courseDuration = 150;

    $courseDurationInSeconds = CourseService::tranform_duration_into_HH_MM_format($courseDuration);

    expect($courseDurationInSeconds)->toBe("02:30");
});


