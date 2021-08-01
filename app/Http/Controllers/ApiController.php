<?php

namespace App\Http\Controllers;
use App\Todo;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getAllTodos() {
    	// $todos = Todo::paginate(10);
    	
    	$todo = Todo::type('todo')->status('publish')->paginate(2);

    	return response($todo, 200);
    }

    public function createTodo(Request $request) {
       $todo=new Todo();
       $todo->post_title="todo2";
       $todo->post_content="todo2";
       $todo->post_name="todo2";
       $todo->post_type="todo";
       $todo->meta->isactive=1;       
       $todo->save();

	    return response($todo, 200);
    }

    public function getTodo($id) {
      if (Todo::where('id', $id)->exists()) {
        $todo = Todo::where('id', $id)->get();
        return response($todo, 200);
      } else {
        return response()->json([
          "message" => "Todo not found"
        ], 404);
      }
    }

    public function updateTodo(Request $request, $id) {
	    if (Todo::where('id', $id)->exists()) {
	        $todo = Todo::find($id);
	        $todo->save();

	        return response()->json([
	            "message" => "Todo updated successfully"
	        ], 200);
	        } else {
	        return response()->json([
	            "message" => "Todo not found"
	        ], 404);
	        
	    }
    }

    public function deleteTodo ($id) {
    	if(Todo::where('id', $id)->exists()) {
	        $todo = Todo::find($id);
	        $todo->delete();

	        return response()->json([
	          "message" => "Todo deleted"
	        ], 202);
	      } else {
	        return response()->json([
	          "message" => "Todo not found"
	        ], 404);
	      }
    }
}
