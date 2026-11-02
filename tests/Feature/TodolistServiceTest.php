<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Testing\Assert;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    public function setUp(): void
    {
        parent::setUp();
        DB::delete("DELETE FROM todos");
        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testTodolistServiceNotNull()
    {
        self::assertNotNull($this->todolistService);
    }

    public function testSaveTodo()
    {
        $this->todolistService->saveTodo("1", "Hanif");

        $todolist =$this->todolistService->getTodolist();
        foreach ($todolist as  $value){
            self::assertEquals("1", $value["id"]);
            self::assertEquals('Hanif', $value["todo"]);
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
                'todo' => 'hanif'
            ],[

                'id' => '2',
                'todo' => 'roihan'
            ]
        ];

        $this->todolistService->saveTodo("1", 'hanif');
        $this->todolistService->saveTodo("2", 'roihan');

        Assert::assertArraySubset($expected, $this->todolistService->getTodolist());
    }

    public function testRemoveTodolist()
    {
        $this->todolistService->saveTodo("1", 'hanif');
        $this->todolistService->saveTodo("2", 'roihan');

        self::assertEquals(2, sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodolist('3');
        self::assertEquals(2, sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodolist('1');
        self::assertEquals(1, sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodolist('2');
        self::assertEquals(0, sizeof($this->todolistService->getTodolist()));
    }
}   
