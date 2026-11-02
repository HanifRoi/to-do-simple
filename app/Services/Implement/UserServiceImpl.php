<?php

namespace App\Services\Implement;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserServiceImpl implements UserService
{

	function login(string $email, string $password): bool
	{
		Auth::attempt([
			'email' => $email,
			'password'=>$password
		]);
	}
}