<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Console\Command;

class StoreCourseDurationIntoMinutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'course:normalize-duration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Normalize course durations to standard minute format (e.g. 60 minutes)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $courses = Course::all();

        $courses->each(function ($course) {
            $transformedDurationIntoMinutes = CourseService::transform_duration_in_minutes($course->duration);

            $course->course_duration = $transformedDurationIntoMinutes;

            $course->save();
        });

        $this->info('Courses duration updated');
    }
}
