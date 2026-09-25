<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    public function setUp(): void
    {
        parent::setUp();
        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testTodolistServiceNotNull()
    {
        self::assertNotNull($this->todolistService);
    }

    public function testSaveTodo()
    {
        $this->todolistService->saveTodo("1", "apakah");

        $todolist = Session::get("todolist");
        foreach ($todolist as  $value){
            self::assertEquals("1", $value["id"]);
            self::assertEquals('apakah', $value["todo"]);
        }
    }

    public function testGetTodolistEmpty()
    {
        self::assertEquals([], $this->todolistService->getTodolist());
    }

    public function testGetTodolistNotEmpty()
    {
        $expected = [
            [
                'id' => '1',
                'todo' => 'apakah'
            ],[

                'id' => '2',
                'todo' => 'apakahlagi'
            ]
        ];

        $this->todolistService->saveTodo("1", 'apakah');
        $this->todolistService->saveTodo("2", 'apakahlagi');

        self::assertEquals($expected, $this->todolistService->getTodolist());
    }

    public function testRemoveTodolist()
    {
        $this->todolistService->saveTodo("1", 'apakah');
        $this->todolistService->saveTodo("2", 'apakahlagi');

        self::assertEquals(2, sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodolist('3');
        self::assertEquals(2, sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodolist('1');
        self::assertEquals(1, sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodolist('2');
        self::assertEquals(0, sizeof($this->todolistService->getTodolist()));
    }
}   
