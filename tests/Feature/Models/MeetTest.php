<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Meet;
use Tests\TestCase;

class MeetTest extends TestCase
{
    use RefreshDatabase;
    
    /**@test */
    public function test_get_Meets(){
        Meet::factory()->create();
        $this->get('/administration/meet/getListMeetings/1')
            ->assertOk()
            ->assertStatus(200);

            $this->assertCount(1, Meet::all());
    }

    /**@test */
    public function test_set_Meet(){
        $response = $this->post('/administration/meet/setCreateMeet', [
            'title' => 'Test title',
            'purpose' => 'Test purpose',
            'date' => now(),
            
        ]);
            $response->assertOk();
            $response->assertStatus(200);
           // $this->assertCount(1, Meet::all());

            $meet = Meet::first();
            $this->assertEquals($meet->title, 'Test title');
    }

        /**@test */
        public function test_edit_Meet(){
            $meet = Meet::factory()->create();
            $response = $this->post('/administration/meet/editMeet/' . $meet->id, [
                'title' => 'Test Update',
                'purpose' => 'Test Uptade',
                'date' => now(),
                
            ]);
                $response->assertOk();
                $response->assertStatus(200);
                $this->assertCount(1, Meet::all());

                $meet = $meet->fresh();

                $this->assertEquals($meet->title, 'Test Update');
        }

    /**@test */
    public function test_delete_Meet(){

        $meet =Meet::factory()->create();
        $this->delete('/administration/meet/deleteMeet/' . $meet->id)
            ->assertOk()
            ->assertStatus(200);

            $this->assertCount(0, Meet::all());
    }
}
