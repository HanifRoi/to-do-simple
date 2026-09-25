<?php

namespace App\Services;

interface TodolistService
{
    public function saveTodo(String $id, String $todo): void;

    public function getTodolist(): array;
}

