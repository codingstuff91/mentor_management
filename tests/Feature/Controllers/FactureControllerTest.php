<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Cours;
use App\Models\Eleve;
use App\Models\Customer;
use App\Models\Facture;
use App\Models\Matiere;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FactureControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);
        $user = User::first();

        $this->actingAs($user);

        $this->createTestData();
    }

    private function createTestData()
    {
        $this->matiere = Matiere::factory()->create();
        $this->customer = Customer::factory()->create();
        
        $this->eleve = Eleve::factory()->create([
            'matiere_id' => $this->matiere->id,
            'client_id' => $this->client->id,
        ]);
    
        Facture::factory()->create([
            'client_id' => $this->customer->id,
        ]);
    
        Cours::factory(2)->create([
            'eleve_id' => $this->eleve->id,
            'facture_id' => Facture::first()->id,
        ]);
    }

    public function test_it_can_fetch_all_the_factures()
    {
        $response = $this->get(route('facture.index'));
        $response->assertOk();
    }

    public function test_it_can_render_the_facture_create_view()
    {
        $response = $this->get(route('facture.create'));

        $response->assertOk();
        $response->assertSee('Nom du client');
    }

    public function test_it_can_show_the_details_of_a_facture()
    {
        $facture = Facture::first();

        $response = $this->get(route('facture.show', $facture->id));
        $response->assertOk();
    }

    public function test_it_can_show_the_total_number_of_hours_of_a_facture()
    {
        $facture = Facture::first();
        $totalCoursesHours = Cours::all()->count();

        $response = $this->get(route('facture.show', $facture->id));

        $response->assertOk();
        $response->assertSee("Nombre heures : " . $totalCoursesHours);
    }

    public function test_the_total_price_of_a_facture_is_correctly_calculated()
    {
        $facture = Facture::first();
        $totalPriceOfCourses = Cours::select('nombre_heures', 'taux_horaire')->get();

        $totalPrice = $totalPriceOfCourses->sum('taux_horaire');

        $response = $this->get(route('facture.show', $facture->id));

        $response->assertOk();
        $response->assertSee($totalPrice ." €");        
    }
}
