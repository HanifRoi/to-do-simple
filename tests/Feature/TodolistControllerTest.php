<?php

namespace Tests\Feature;

use Database\Seeders\TodoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Override;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    #[Override]
    protected function setUp(): void
    {
        parent::setUp();
        DB::delete("DELETE FROM todos");
    }
    public function testTodolist()
    {
        $this->seed(TodoSeeder::class);
        $this->withSession([
            'user'=>'roihan'
        ])->get('/todolist')->assertSeeText('1')
                            ->assertSeeText('hanif')
                            ->assertSeeText('2')
                            ->assertSeeText('roihan');
    }

    public function testAddTodolistFailed()
    {
        $this->withSession([
            'user'=>'roihan'
        ])->post('/todolist', [])
            ->assertSeeText('Todo is Required');
    }

     public function testAddTodolistSuccess()
    {
        $this->withSession([
            'user'=>'roihan'
        ])->post('/todolist', [
            'todo'=>'halo'
        ])->assertRedirect('/todolist');
    }

    public function testRemoveTodolist()
    {
        $this->withSession([
            'user'=>'roihan',
            'todolist' => [
                [
                    'id'=>'1',
                    'todo'=>'halo'
                ],[
                    'id'=>'2',
                    'todo'=>'halolagi'
                ]
            ]
        ])->post('/todolist/1/delete')->assertRedirect('/todolist');
    }
}
