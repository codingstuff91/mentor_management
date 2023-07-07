<?php

namespace Tests\Feature\Controllers;

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
            ->create([
                'customer_id' => Customer::first()->id,
            ]);
    }

    /** @test */
    public function can_fetch_the_students_index_view()
    {
        $response = $this->get(route('student.index'));
        $response->assertOk();
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
    public function can_store_a_new_student()
    {
        $this->post(route('student.store', [
            'nom' => "John Doe",
            'matiere_id' => Subject::first()->id,
            'customer_id' => Customer::first()->id,
            'objectifs' => "Some random text to test",
            'commentaires' => "Some random text to test",
        ]));

        $this->assertDatabaseCount('students', 1);
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
    public function can_render_the_edit_student_view()
    {
        $response = $this->get(route('student.edit', $this->student));
        $response->assertOk();
    }

    /** @test */
    public function can_update_a_student()
    {
        $this->patch(route('student.update', $this->student), [
            "nom" => "test",
            "objectifs" => "Learn php",
        ]);

        $this->student->refresh();

        $this->assertEquals($this->student->nom, "test");
        $this->assertEquals($this->student->objectifs, "Learn php");
    }

    /** @test */
    public function cannot_update_a_student_without_a_name()
    {
        $response = $this->patch(route('student.update', $this->student), [
            "nom" => "",
            "objectifs" => "Learn php",
        ]);

        $response->assertSessionHasErrors('nom');
    }

    /** @test */
    public function cannot_update_a_student_without_objectives()
    {
        $response = $this->patch(route('student.update', $this->student), [
            "nom" => "test",
            "objectifs" => "",
        ]);

        $response->assertSessionHasErrors('objectifs');
    }
}
