<?php

use App\Models\Course;
use function Pest\Laravel\artisan;

it('normalizes course duration into minutes', function () {
    // Given: a customer, a student, and a course linked to an invoice
    $customer = createCustomerWithInvoice();
    $student = createStudentWithSubjectAndCustomer($customer);
    $course = createCourseWithStudentAndInvoice($student, $customer->invoice->first());

    // Inject an invalid course duration (e.g. 20 minutes instead of standardized 60)
    $course->course_duration = 20;
    $course->save();

    // When: the normalization command is run
    artisan('course:normalize-duration');

    // Then: the course duration should now be normalized to 60 minutes
    expect($course->fresh()->course_duration)->toBe(60);
});
