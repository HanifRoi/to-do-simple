<?php
namespace App\Services\Implement;

use App\Models\Todo;
use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;
use Override;

class TodolistServiceImpl implements TodolistService
{

    public function saveTodo(String $id, String $todo):void{
       $todo = new Todo([
        'id'=>$id,
        'todo'=>$todo
       ]);
       $todo->save();
    }


    public function getTodolist(): array
    {
        return Todo::get()->toArray();
    }

    #[Override]
    public function removeTodolist(string $todoId)
    {
        $todo = Todo::find($todoId);
        $todo->delete();
    }
    
}