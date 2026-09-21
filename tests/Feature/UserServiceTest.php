<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
   private UserService $userService;

   protected function setUp() : void
   {
    parent::setUp();
    $this->userService = $this->app->make(UserService::class);
   }


   public function testLoginSuccess()
   {
    self::assertTrue($this->userService->login("roihan","rahasia"));
   }

   public function testLoginFailed()
   {
    self::assertFalse($this->userService->login("hanif", "password"));
   }

   public function testLoginWrongPassword()
   {
    self::assertFalse($this->userService->login("roihan", "password"));
   }
}
