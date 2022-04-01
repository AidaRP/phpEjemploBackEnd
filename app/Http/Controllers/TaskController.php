<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

    public function getAll() 
    {
        
        Log::info('GetAll tasks');
        try {
            $tasks = Task::all();
            
            Log::info('Tasks done');

            return $tasks;
        } catch (\Exception $exception) {
            Log::error('Error-> '.$exception->getMessage());

            return ['error' => $exception->getMessage()];
        }
    }

    public function getOne($id)
    {
        $userId = auth()->user()->id;
        $task = Task::where('user_id', $userId)->findOrFail($id);

        return $task;
    }

    public function delete($id)
    {
        $userId = auth()->user()->id;

        $task = Task::where('user_id', $userId)->findOrFail($id);

        $task->delete();

        return 'Task deleted';
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }   

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->user()->id
        ];

        Task::create($data);

        return 'Task created';
    }

    public function getAllByUser()
    {
        $dataUser = auth()->user();

        $tasksByUserId = User::find($dataUser->id)->tasks;

        $response = [
            'user' => $dataUser,
            'tasks' => $tasksByUserId
        ];

        return $response;
    }

    public function exampleMiddleware()
    {
        return 'Middleware';
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'string',
            'description' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $userId = auth()->user()->id;

        $task = Task::where('user_id', $userId)->findOrFail($id);

        if ($request->has('title')) {
            $task->title = $request->title;
        }

        if ($request->has('description')) {
            $task->description = $request->description;
        }

        $task->save();

        
        return 'Task updated';
    }
}
