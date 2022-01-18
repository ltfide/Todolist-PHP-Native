<?php 

namespace Todolist\PHP\Native\Controller;

use Exception;
use Todolist\PHP\Native\App\View;
use Todolist\PHP\Native\Config\Database;
use Todolist\PHP\Native\Domain\Todolist;
use Todolist\PHP\Native\Exception\ValidationException;
use Todolist\PHP\Native\Model\UserTodolistRequest;
use Todolist\PHP\Native\Model\UserTodolistResponse;
use Todolist\PHP\Native\Repository\TodolistRepository;
use Todolist\PHP\Native\Service\TodolistService;

class TodolistController 
{
    private TodolistService $todolistService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $todolistRepository = new TodolistRepository($connection);
        $this->todolistService = new TodolistService($todolistRepository); 
    }

    public function index()
    {
        $user = new TodolistRepository(Database::getConnection());
        View::render("Home/index", [
          "title" => "My Todolist",
          "user" => [
            "data" => $user->show()
          ]
        ]);
    }

    public function postAdd()
    {
        $request = new UserTodolistRequest();
        $request->task = htmlspecialchars($_POST["task"]);
        $user = new TodolistRepository(Database::getConnection());

        try {
            $this->todolistService->add($request);
            View::render("Home/index", [
              "title" => "My Todolist",
              "success" => "Data Successfull Added",
              "user" => [
                "data" => $user->show()
              ]
            ]);
        } catch (ValidationException $exception) {
            View::render("Home/index", [
              "title" => "My Todolist",
              "error" => $exception->getMessage(),
              "user" => [
                "data" => $user->show()
              ]
            ]);
        }
    }

    public function destroy(): void
    {
      try {
          $user = new TodolistRepository(Database::getConnection());
          $user->deleteById($_POST['id']);
          View::redirect("/");
      } catch (\Exception $exception) {
          $exception->getMessage();
      }
        
    }

}