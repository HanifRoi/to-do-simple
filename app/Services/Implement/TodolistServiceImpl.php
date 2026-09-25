<?php
namespace App\Services\Implement;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImpl implements TodolistService
{

    public function saveTodo(String $id, String $todo):void{
        if(!Session::exists("todolist")){
             Session::put("todolist", []);
        }

        Session::push("todolist", [
            "id" => $id,
            "todo" => $todo
        ]);
    }


    public function getTodolist(): array
    {
        return Session::get("todolist", []);
    }
    
}