<?php

namespace Tests\Feature\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\Eleve;
use App\Models\Client;
use App\Models\Matiere;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EleveControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);
        $user = User::first();

        $this->actingAs($user);

        $this->matiere = Matiere::factory()->create();
        $this->client = Client::factory()->create();

        $this->eleve = Eleve::factory()->create([
            'matiere_id' => $this->matiere->id,
            'client_id' => $this->client->id,
        ]);
    }

    public function test_it_can_fetch_the_eleve_list()
    {
        $response = $this->get(route('eleve.index'));
        $response->assertOk();
    }
    
    public function test_it_can_render_the_eleve_create_view()
    {
        $response = $this->get(route('eleve.create'));
        $response->assertOk();

        $view = $this->view('eleve.create', [
            'clients' => Matiere::all(),
            'matieres' => Client::all(),
        ]);

        $view->assertSee('Nom');
        $view->assertSee('Matière');
        $view->assertSee('Client');
        $view->assertSee('Objectifs');
        $view->assertSee('Commentaires');
    }

    public function test_it_can_store_a_new_eleve()
    {
        $response = $this->post(route('eleve.store', [
            'nom' => "John Doe",
            'matiere_id' => Matiere::first()->id,
            'client_id' => Client::first()->id,
            'objectifs' => "Some random text to test",
            'commentaires' => "Some random text to test",
        ]));
        
        $this->assertDatabaseCount('eleves', 1);
    }
}
