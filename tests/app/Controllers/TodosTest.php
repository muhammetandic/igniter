<?php

namespace CodeIgniter;

use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;

class TestTodosController extends CIUnitTestCase
{
    use ControllerTestTrait, DatabaseTestTrait;
    public function testShowTodos()
    {
        $result = $this
            ->withUri('http://localhost:8080/todos')
            ->controller(\App\Controllers\Todos::class)
            ->execute('index');

        $this->assertTrue($result->isOK());
    }

    public function testShowTodo()
    {
        $result = $this
            ->withUri('http://localhost:8080/todos/2')
            ->controller(\App\Controllers\Todos::class)
            ->execute('show');

        $this->assertTrue($result->isOK());
    }

    public function testCreateTodo()
    {
        $body = json_encode(['job' => 'Merhaba', 'isCompleted' => true]);

        $result = $this
            ->withBody($body)
            ->controller(\App\Controllers\Todos::class)
            ->execute('create');

        $this->assertTrue($result->created());
    }
}