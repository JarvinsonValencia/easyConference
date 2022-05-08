<?php

namespace Tests\Feature\Models;

use App\Models\Activity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;
    /**@test */
    public function test_activity_index(){
        $activity = Activity::factory()->create();
        $this->get('/administration/activity/getListActivities/1')
            ->assertOk()
            ->assertStatus(200);
        
            $this->assertCount(1, Activity::all());
    }

    /**@test */
    public function test_set_activity(){
       $response = $this->post('/administration/activity/setCreateActivity', [
            'name' => 'Test name',
            'description' => 'Test description',
            'estimated_date' => now()
       ]);  
            $response->assertOk();
            $response->assertStatus(200);
            $this->assertCount(1, Activity::all());

            $activity = Activity::first();
            $this->assertEquals($activity->name, 'Test name');
    }

        /**@test */
        public function test_edit_activity(){
            $activity = Activity::factory()->create();
            $response = $this->post('/administration/activity/editActivity/' . $activity->id, [
                 'name' => 'Test Update',
                 'description' => 'Test Update',
                 'estimated_date' => now()
            ]);  
                 $response->assertOk();
                 $response->assertStatus(200);
                 $this->assertCount(1, Activity::all());
     
                 $activity = $activity->fresh();
                 $this->assertEquals($activity->name, 'Test Update');
         }

    /**@test */
    public function test_delete_activity(){
        $activity = Activity::factory()->create();
        $this->delete('/administration/activity/deleteActivity/' . $activity->id)
            ->assertOk()
            ->assertStatus(200);

            $this->assertCount(0, Activity::all());
    }


}
