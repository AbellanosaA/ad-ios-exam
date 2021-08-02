<?php

namespace App\Http\Controllers;
use App\Todo;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getTodo(Request $request) {
        $query = Todo::query();

        if ($s = $request->input('s')) {
            $query->whereRaw("isactive LIKE '%" . $s . "%'");                
        }

        if ($sort = $request->input('sort')) {
            $query->orderBy('id', $sort);
        }

        $perPage = 1;
        $page = $request->input('page', 1);
        $total = $query->count();

      $result = $query->offset(($page - 1) * $perPage)->limit($perPage)->get();

      return response()->json([
          'data' => $result,
          'total' => $total,
          'page' => $page,
          'last_page' => ceil($total / $perPage)
      ], 404);
    }

    public function createTodo(Request $request) {
       $todo=new Todo;
       $todo->isactive= $request->isactive;       
       $todo->save();

	    return response($todo, 200);
    }
  

    public function updateTodo(Request $request, $id) {
	    if (Todo::where('id', $id)->exists()) {
	        $todo = Todo::find($id);
	        $todo->isactive = is_null($request->isactive) ? $todo->isactive : $request->isactive;
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
