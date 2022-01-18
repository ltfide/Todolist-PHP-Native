<?php 

namespace Todolist\PHP\Native\Service;

use Todolist\PHP\Native\App\View;
use Todolist\PHP\Native\Config\Database;
use Todolist\PHP\Native\Domain\Todolist;
use Todolist\PHP\Native\Exception\ValidationException;
use Todolist\PHP\Native\Model\UserTodolistRequest;
use Todolist\PHP\Native\Model\UserTodolistResponse;
use Todolist\PHP\Native\Repository\TodolistRepository;

class TodolistService
{
    private TodolistRepository $todolistRepository;

    public function __construct(TodolistRepository $todolistRepository)
    {
        $this->todolistRepository = $todolistRepository;
    }

    public function add(UserTodolistRequest $request): UserTodolistResponse
    {
        $this->validateUserTodolistRequest($request);

        try {
            Database::beginTransaction();
            $user = new Todolist();
            $user->task = $request->task;

            $this->todolistRepository->save($user);

            $response = new UserTodolistResponse();
            $response->todolist = $user;

            Database::commitTransaction();
            return $response;
        } catch (\Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    public function delete(UserTodolistRequest $request) 
    {
        try {
            $user = $this->todolistRepository->findById($request->id);
            if ($user == null) {
                throw new ValidationException("Error");
            }

            $this->todolistRepository->deleteById($user->id);

            $response = new UserTodolistResponse();
            $response->user = $user;
            return $response;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    private function validateUserTodolistRequest(UserTodolistRequest $request)
    {
        if ($request->task == null || trim($request->task) == "") {
          throw new ValidationException("New Task can not blank");
        }
    }
}