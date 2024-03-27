<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
   /**
     * A basic feature test example.
     */

    /* public function setUp(): void{
        parent::setUp();
        // Artisan::call('db:seed');
    } */

    public function test_example(): void
    {
        $this->seed();
        $response = $this->withHeaders([
           'Contet-Type'=>'application/json' ,
            'Authorization'=>'01a200ae-5e11-46b2-9625-5bf6ff2db976'
        ])->get('/api/v1/people');
        // $response->dd();
        $response->assertStatus(200);
    }

    public function test_login_status_ok(): void
    {

        $login = $this->withHeaders([
           'Contet-Type'=>'application/json' ,
            'Authorization'=>'01a200ae-5e11-46b2-9625-5bf6ff2db976'
        ])->post('/api/v1/auth/login',
                [
                    'email'=>'admin@admin.con',
                    'password'=>'password'
                ]);
        $login->dd();
        $login->assertStatus(200);
    }

    public function test_login_structure_json_response():void
    {


        $login = $this->withHeaders([
           'Contet-Type'=>'application/json' ,
            'Authorization'=>'01a200ae-5e11-46b2-9625-5bf6ff2db976'
        ])->post('/api/v1/auth/login',
                [
                    'email'=>'admin@admin.con',
                    'password'=>'password'
                ]);
        $login->assertJson(fn(AssertableJson $json)=>
                $json->whereAllType([
                    'status'=> 'integer',
                    'error'=>'boolean',
                    'message'=>'array',
                    'message.jwt'=>'string'
                ])
            );
    }
}
