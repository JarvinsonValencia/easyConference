<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
Use App\Models\User;
use Faker\Guesser\Name;

class UsersTest extends TestCase
{
   use RefreshDatabase;

    public function test_user(){
        $this->get('/user')->assertStatus(200);
    }

  public function test_create_user(){

    $user = User::factory()->create();

    $this->post('/administration/user/setCreateUser', [
        $user
    ])->assertInstanceOf("User", $user);


  }


}
