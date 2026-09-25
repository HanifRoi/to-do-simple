<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            'user'=>'roihan',
            'todolist'=>[
                [
                    'id'=>'1',
                    'todo'=>'apakah'
                ],
                [
                    'id'=>'2',
                    'todo'=>'apakahlagi'
                ],
                [
                    'id'=>'3',
                    'todo'=>'apakahlagilagi'
                ]
            ]
        ])->get('/todolist')->assertSeeText('1')
                            ->assertSeeText('apakah')
                            ->assertSeeText('2')
                            ->assertSeeText('apakahlagi')
                            ->assertSeeText('3')
                            ->assertSeeText('apakahlagilagi');
    }
}
