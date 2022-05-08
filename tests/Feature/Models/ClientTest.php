<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Client;
use Tests\TestCase;

class ClientTest extends TestCase
{   
    use RefreshDatabase;
    /**@test */
    public function test_get_clients(){
        Client::factory()->create();
        $this->get('/administration/client/getListClients')
            ->assertOk()
            ->assertStatus(200);

            $this->assertCount(1, Client::all());
    }

    /**@test */
    public function test_set_clients(){
        $response = $this->post('/administration/client/setCreateClient', [
                'name' => 'Test name',
                'document' => 'Test document',
                'email' => 'Test email',
                'phone' => 'Test phone',
                'address' => 'Test address'
        ]);
            $response-> assertOk();
            $response->assertStatus(200);

            $this->assertCount(1, Client::all());
            $client = Client::first();
            $this->assertEquals($client->name, 'Test name');
    }

    /**@test */
    public function test_edit_clients(){
        $client = Client::factory()->create();
        $response = $this->post('/administration/client/editClient/' . $client->id, [
                'name' => 'Test Update',
                'document' => 'Test Update',
                'email' => 'Test Update',
                'phone' => 'Test Update',
                'address' => 'Test Update'
        ]);
            $response-> assertOk();
            $response->assertStatus(200);
            $this->assertCount(1, Client::all());

            $client = $client->fresh();
            $this->assertEquals($client->name, 'Test Update');
    }

    /**@test */
    public function test_delete_clients(){
        $client = Client::factory()->create();
        $this->delete('/administration/client/deleteClient/' . $client->id)
            ->assertOk()
            ->assertStatus(200);
        
        $this->assertCount(0, Client::all());
    }
}
