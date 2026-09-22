<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')->assertSeeText("Login");
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            'user'=> 'roihan',
            'password'=>'rahasia'
        ])->assertRedirect('/')
            ->assertSessionHas("user", "roihan");
    }

    public function testLoginError()
    {
        $this->post('/login',[])->assertSeeText('User Atau Password harus diisi');
    }

    public function testLoginWrong()
    {
        $this->post('/login', [
            'user' => 'roihan',
            'password'=> 'bonbon'
        ])->assertSeeText('User Atau Password salah');
    }



}
