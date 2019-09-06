<?php

namespace App\Http\Controllers;

use App\Account;
use App\Task;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;

class Tasks extends Controller
{
    public function create(TaskRequest $request, Account $account)
    {
        $data = $request->only(["task"]);
        $data["account_id"] = $account->id;
        $task = Task::create($data);

        return new TaskResource($task);
    }

    public function list(Account $account)
    {
        return TaskResource::collection(Task::where("account_id", $account->id)->get());
    }

    public function read(Account $account, Task $task)
    {
        return new TaskResource($task);
    }

    public function update(TaskRequest $request, Account $account, Task $task)
    {
        $data = $request->only(["task"]);
        $task->fill($data)->save();

        return new TaskResource($task);
    }

    public function complete(Account $account, Task $task)
    {
        $task->completed = true;
        $task->save();
        return new TaskResource($task);
    }

    public function delete(Account $account, Task $task)
    {
        $task->delete();
        return response(null, 204);
    }
}
