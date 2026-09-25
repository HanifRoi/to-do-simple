<?php
namespace App\Services\Implement;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;
use Override;

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

    #[Override]
    public function removeTodolist(string $todoId)
    {
        $todolist = Session::get("todolist");
        foreach($todolist as $index=>$value){
            if($value['id'] == $todoId){
                unset($todolist[$index]);
                break;
            }
        }

        Session::put("todolist", $todolist);
    }
    
}