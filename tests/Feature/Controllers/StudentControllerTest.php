<?php

namespace Tests\Feature\Controllers;

use App\Models\Course;
use App\Models\Customer;
use Tests\TestCase;
use App\Models\User;
use App\Models\Student;
use App\Models\Invoice;
use App\Models\Subject;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);
        $user = User::first();

        $this->actingAs($user);

        $this->customer = Customer::factory()
            ->has(Invoice::factory())
            ->create();

        $this->student = Student::factory()
            ->for(Subject::factory())
            ->has(Course::factory())
            ->create([
                'customer_id' => $this->customer->id,
            ]);

        $this->inactiveStudent = Student::factory()
            ->inactive()
            ->for(Subject::factory())
            ->has(Course::factory())
            ->create([
                'customer_id' => $this->customer->id,
            ]);

        $this->studentAttributes = [
            'name' => 'test',
            'subject' => Subject::first(),
            'active' => true,
            'customer' => $this->customer->id,
            'goals' => 'Learn PHP',
        ];
    }

    /** @test */
    public function can_fetch_the_students_index_view()
    {
        $response = $this->get(route('student.index'));
        $response->assertOk();
    }

    /** @test */
    public function can_display_the_students_sorted_by_status()
    {
        $this->get(route('student.index'))
            ->assertOk()
            ->assertSeeInOrder([$this->student->name, $this->inactiveStudent->name]);
    }

    /** @test */
    public function can_render_student_create_view()
    {
        $response = $this->get(route('student.create'));
        $response
            ->assertOk()
            ->assertSee('Nom')
            ->assertSee('Matière')
            ->assertSee('Client')
            ->assertSee('Objectifs')
            ->assertSee('Commentaires');
    }

    /** @test */
    public function can_render_the_customers_list_into_the_student_create_view()
    {
        $response = $this->get(route('student.create'));

        $response
            ->assertOk()
            ->assertSee($this->customer->name);
    }

    /** @test */
    public function can_render_the_subjects_list_into_the_student_create_view()
    {
        $response = $this->get(route('student.create'));

        $response
            ->assertOk()
            ->assertSee(Subject::first()->name);
    }

    /** @test */
    public function can_store_a_new_student()
    {
        $this->post(route('student.store', [
            'name' => "John Doe",
            'subject' => Subject::first()->id,
            'customer' => $this->customer->id,
            'goals' => "Some random text to test",
            'comments' => "Some random text to test",
        ]));

        $this->assertDatabaseCount('students', 3);
    }

    /** @test */
    public function cannot_store_a_new_student_without_a_name()
    {
        $incompleteStudentAttributes = array_merge($this->studentAttributes, [
            'name' => '',
        ]);

        $response = $this->post(route('student.store'), $incompleteStudentAttributes);
        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function cannot_store_a_new_student_without_a_customer()
    {
        $incompleteStudentAttributes = array_merge($this->studentAttributes, [
            'customer' => '',
        ]);

        $response = $this->post(route('student.store'), $incompleteStudentAttributes);
        $response->assertSessionHasErrors('customer');
    }

    /** @test */
    public function cannot_store_a_new_student_without_a_subject()
    {
        $incompleteStudentAttributes = array_merge($this->studentAttributes, [
            'subject' => '',
        ]);

        $response = $this->post(route('student.store'), $incompleteStudentAttributes);
        $response->assertSessionHasErrors('subject');
    }

    /** @test */
    public function cannot_store_a_new_student_without_goals()
    {
        $incompleteStudentAttributes = array_merge($this->studentAttributes, [
            'goals' => '',
        ]);

        $response = $this->post(route('student.store'), $incompleteStudentAttributes);
        $response->assertSessionHasErrors('goals');
    }

    /** @test */
    public function can_render_the_show_student_view()
    {
        $response = $this->get(route('student.show', $this->student));

        $response
            ->assertOk()
            ->assertSee($this->student->name)
            ->assertSee($this->student->objectifs)
            ->assertSee($this->student->subject->name);
    }

    /** @test */
    public function can_display_the_course_details_of_a_student()
    {
        $response = $this->get(route('student.show', $this->student));

        $firstStudentCourse = $this->student->courses->first();

        $response
            ->assertOk()
            ->assertSee($this->student->goals)
            ->assertSee($firstStudentCourse->date->format('d/m/Y'))
            ->assertSee($firstStudentCourse->start_hour->format('H:i'))
            ->assertSee($firstStudentCourse->end_hour->format('H:i'))
            ->assertSeeText($firstStudentCourse->hours_count . "heure")
            ->assertSee($firstStudentCourse->learned_notions);
    }

    /** @test */
    public function can_render_the_edit_student_view()
    {
        $response = $this->get(route('student.edit', $this->student));
        $response->assertOk();
    }

    /** @test */
    public function can_update_a_student()
    {
        $response = $this->patch(route('student.update', $this->student), $this->studentAttributes);
        $response->assertSessionHasNoErrors();

        $this->student->refresh();

        $this->assertEquals($this->student->name, "test");
        $this->assertEquals($this->student->goals, "Learn PHP");
    }

    /** @test */
    public function cannot_update_a_student_without_a_name()
    {
        $response = $this->patch(route('student.update', $this->student), [
            "name" => "",
            "goals" => "Learn php",
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function cannot_update_a_student_without_objectives()
    {
        $response = $this->patch(route('student.update', $this->student), [
            "name" => "test",
            "goals" => "",
        ]);

        $response->assertSessionHasErrors('goals');
    }
}
