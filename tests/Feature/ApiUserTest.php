<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiUserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register_for_user()
    {
        $user = User::where('email','Ade123@gmail.com')->first();
        if ($user){
            $response = $this->get('/');
            $response->assertStatus(200);
        }else{
            $response = $this->postJson('/api/register', [
                'name'=>'Adewale',
                'email'=>'Ade123@gmail.com',
                'password'=> 'ade123',
                'password_confirmation'=> 'ade123'
            ]);

            $response
                ->assertStatus(200);
        }

    }

    public function test_successful_login()
    {
        $user = User::create([
            'name'=>'Ade123',
            'email' => 'sample@test.com',
            'password' => bcrypt('sample123'),
        ]);


        $loginData = ['email' => 'sample@test.com', 'password' => 'sample123'];

        $this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(200);

        $this->assertAuthenticated();
    }

    public function test_to_buy_coins(){
        $this->_getAuth();
        $user = User::first();

                 $response = $this->json('POST', '/api/depositCoin/' . $user->email)
                     ->assertStatus(200);

//            $this->assertAuthenticated();

    }

    public function test_update_user(){
        $this->_getAuth();

        $user = User::first();

        $response = $this->json('POST', '/api/updateProduct/' . $user->id)
            ->assertStatus(200);
    }

    public function test_to_delete_user(){
        $this->_getAuth();
        $user = User::where('email','ade123@gmail.com')->first();
        if ($user){
            $response = $this->json('DELETE','/api/delete/'.$user->id);
            $response->assertStatus(200);
        }
       $response->assertDontSee($user,true);
    }


    function _getAuth(){
        $user = \App\Models\User::factory()->create();
        return  $this->actingAs($user);

    }
}
