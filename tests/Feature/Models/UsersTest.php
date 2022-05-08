<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use function PHPUnit\Framework\assertCount;

class UsersTest extends TestCase
{
  use RefreshDatabase;

  /**@test */
  public function test_user_index(){
      User::factory()->create();
      $this->get('/administration/user/getListUsers/1/2')
          ->assertOk()
          ->assertStatus(200);

          $this->assertCount(1, User::all());
  }

  /**@test */
  public function test_get_user(){
    $this->get('/administration/user/getUser/1')
        ->assertOk()
        ->assertStatus(200);
  }

  /**@test */
  public function test_set_user(){
    $response = $this->post('/administration/user/setCreateUser', [
        'name' => 'Test name',
        'document' => 'Test document',
        'phone' => 'Test phone',
        'email' => 'Test email',
        'username' => 'Test password'
    ]); 
    
        $response->assertOk();
        $response->assertStatus(200);
        $this->assertCount(1, User::all());

        $user = User::first();
        $this->assertEquals($user->name, 'Test name');
  }

  /**@test */
  public function test_edit_user(){
    $user = User::factory()->create();
    $response = $this->post('/administration/user/editUser/' . $user->id, [
      'name' => 'Test update',
      'document' => 'Test document',
      'phone' => 'Test phone',
      'email' => 'Test email',
      'username' => 'Test password'
    ]);
        $response->assertOk();
        $response->assertStatus(200);

        $this->assertCount(1, User::all());

        $user = $user->fresh();

        $this->assertEquals($user->name, 'Test update');
  }

   /**@test */
   public function test_delete_user(){
    $user = User::factory()->create();
    $this->delete('/administration/user/deleteUser/' . $user->id )
        ->assertOk()
        ->assertStatus(200);
        
        $this->assertCount(0, User::all());
  }

  

  

}
