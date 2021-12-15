<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function createTask( Request $request){
        $request->validate([
            "name_task" => "required",
            "description" => "required"
        ]);

        $user_id = auth()->user()->id;

        $task = new task();
        $task->user_id = $user_id;
        $task->name_task = $request->name_task;
        $task->description = $request->description;
   
        $task->save();

        return response([
            "status" => 1,
            "msg" => "¡Tarea creada con exito!"
        ]);
    
    }

    public function checkTask(){
        $user_id = auth()->user()->id;
        $task = task::where("user_id", $user_id)->get();
    
        return response([
            "status" => 1,
            "msg" => "Lista de tareas",
            "data" => $task
        ]);
    }

    public function updateTask( Request $request, $id){
        $user_id = auth()->user()->id;

        if( task::where( ["user_id"=>$user_id, "id"=>$id ])->exists() ){
            $task = task::find($id);

            $task->name_task = isset($request->task_name) ? $request->name_task : $task->name_task;
            $task->description = isset($request->description) ? $request->description : $task->description;

            $task->save();

            return response([
                "status" => 1,
                "msg" => "¡Tarea actualizada con exito!"
            ]);
        }else{
            return response([
                "status" => 0,
                "msg" => "La tarea no existe"
            ], 404); 
        }
    }

    public function deleteTask($id){
        $user_id = auth()->user()->id;

        if( task::where( ["id"=>$id, "user_id"=>$user_id] )->exists()){
            $task = task::where( ["id"=>$id, "user_id"=>$user_id] )->first();
            $task->delete();

            return response([
                "status" => 1,
                "msg" => "Tarea eliminada"
            ]);
        }else{
            return response([
                "status" => 0,
                "msg" => "La tarea no existe"
            ], 404); 
        }
    }
}
