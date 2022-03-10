<?php
//
//namespace Tests\Feature;
//
//use App\Models\User;
//use Illuminate\Support\Facades\Hash;
//use Tests\TestCase;
//
//class AuthenticationTest extends TestCase
//{
//
////    public function testRequiredFieldsForRegistration()
////    {
////        $this->json('POST', 'api/register', ['Accept' => 'application/json'])
////            ->assertStatus(422)
////            ->assertJson([
////                "message" => "The given data was invalid.",
////                "errors" => [
////                    "name" => ["The name field is required."],
////                    "email" => ["The email field is required."],
////                    "password" => ["The password field is required."],
////                ]
////            ]);
////    }
//
////    public function testRepeatPassword()
////    {
////        $userData = [
////            "name" => "John Doe",
////            "email" => "doe@example.com",
////            "password" => "demo12345",
////             "password_confirmation" => "demo12345"
////        ];
////
////        $this->json('POST', 'api/register', $userData, ['Accept' => 'application/json'])
////            ->assertStatus(422);
////            ->assertJsonStructure([
////                "data" => [
////                    'id',
////                    'name',
////                    'email',
////                    'created_at',
////                    'updated_at',
////                ],
////                "access_token",
////            ]);
////        $this->assertAuthenticated();
////    }
//
//    public function testSuccessfulRegistration()
//    {
//        $userData = [
//            "name" => "John Doe",
//            "email" => "doe@example.com",
//            "password" => "demo12345",
//            "password_confirmation" => "demo12345"
//        ];
//
//        $this->json('POST', 'api/register', $userData, ['Accept' => 'application/json'])
//            ->assertStatus(200)
//            ->assertJsonStructure([
//                "data" => [
//                    'id',
//                    'name',
//                    'email',
//                    'created_at',
//                    'updated_at',
//                ],
//                "access_token",
//            ]);
////        $this->assertAuthenticated();
//    }
//
////    public function testMustEnterEmailAndPassword()
////    {
////        $this->json('POST', 'api/login')
////            ->assertStatus(422);
////
////    }
//
//    public function testSuccessfulLogin()
//    {
//        $user = User::create([
//            'email' => 'sample@test.com',
//            'name' => 'sAde',
//            'password' => bcrypt('sample123'),
//        ]);
//
//
//        $loginData = ['email' => 'sample@test.com', 'password' => 'sample123'];
//
//        $this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json'])
//            ->assertStatus(200);
//
//
//        $this->assertAuthenticated();
//    }
//
//}
