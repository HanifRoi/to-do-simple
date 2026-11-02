<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Override;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    #[Override]
    protected function setUp(): void
    {
        parent::setUp();
        DB::delete("DELETE FROM users");
    }
    public function testLoginPage()
    {
        $this->get('/login')->assertSeeText("Login");
    }

    public function testLoginSuccess()
    {
        $this->seed(UserSeeder::class);
        $this->post('/login', [
            'user'=> 'hanif@localhost',
            'password'=>'rahasiarahasia'
        ])->assertRedirect('/')
            ->assertSessionHas("user", "hanif@localhost");
    }

    public function testLoginError()
    {
        $this->post('/login',[])->assertSeeText('Username Atau Password harus diisi');
    }

    public function testLoginWrong()
    {
        $this->post('/login', [
            'user' => 'roihan',
            'password'=> 'bonbon'
        ])->assertSeeText('User Atau Password salah');
    }

    public function testLogout()
    {
        $this->withSession([
            "user"=>"roihan",
        ])->post('/logout')->assertRedirect("/")
            ->assertSessionMissing("user");
    }

    public function testLoginPageForMember()
    {
        $this->withSession([
            "user"=>"roihan"
        ])->get('/login')->assertRedirect('/');
    }

public function testLoginForUserAlreadyLogin()
    {
        $this->withSession([
            "user"=>"roihan"
        ])->post('/login', [
            'user'=> 'roihan',
            'password'=>'rahasia'
        ])->assertRedirect('/');
    }

    public function testLogoutGuest()
    {
        $this->post('logout')
        ->assertRedirect('/');
    }

}
