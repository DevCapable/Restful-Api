<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiProductTest extends TestCase
{


    public function test_to_get_all_product(){
        Product::all();
        $response = $this->json('GET','/api/getAllProduct')->assertStatus(200);
    }

    public function test_to_create_product(){
        $this->_getAuth();
        $product = Product::create([
            'cost' => 5090,
            'product_name' => ''
        ]);
        $response = $this->json('POST','/api/createProduct')->assertStatus(200);
    }

    public function test_to_update()
    {
        $this->_getAuth();
        $product = Product::create([
            'cost' => 400,
            'product_name' => 'First Body',
        ]);


        $response = $this->json('POST', '/api/updateProduct/' . $product->id)
            ->assertStatus(200);
    }

    public function test_to_search_product_by_name(){
        $this->_getAuth();
        $product = Product::create([
            'cost'=>2000,
            'product_name'=>'IPHONE 14'
        ]);
        $prod = Product::first();
        $response = $this->json('POST','/api/searchProduct/'.$prod->product_name)->assertStatus(200);
    }

    public function test_to_delete_product(){
        $this->_getAuth();
        $product = Product::create([
            'cost'=>2000,
            'product_name'=>'IPHONE 14'
        ]);
        $response = $this->json('POST','/api/deleteProduct/'.$product->id)->assertStatus(200);
    }



    function _getAuth(){
        $user = \App\Models\User::factory()->create();
        return  $this->actingAs($user);

    }



}
