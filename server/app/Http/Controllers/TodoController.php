<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoStoreRequest;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    // return todo view
    public function index()
    {
        $todo = Todo::where('user_id', Auth::user()->id)->get();
        return response()->json([
            "todo" => $todo
        ], 200);
    }


    // store the todo view in database
    public function store(TodoStoreRequest $request)
    {
        $validate =  $request->validated();

        $todo = new Todo();
        $todo->name = $validate['name'];
        $todo->description = $validate['description'];

        //associate with each user
        $todo->user()->associate(Auth::user());
        $todo->save();
        return response()->json([
            "todo" => $todo,
            "Success" => "Todo Created Sucessfully"
        ], 200);
    }




    //return details view
    public function details($id)
    {
        $todo = Todo::where('id', $id)->get();
        return response()->json([
            "todo" => $todo,
        ], 200);
    }


    //update todo on database
    public function update(TodoStoreRequest $request, $id)
    {
        $validate =  $request->validated();
        $todo = Todo::where('id', $id)->update($validate);


        return response()->json([
            "todo" => $todo,
            "message" => "Todo Updated"
        ], 200);
    }

    //delete todo
    public function delete($id)
    {
        Todo::where('id', $id)->delete();
        //session()->flash('success', 'Todo Deleted Successfully');
        return response()->json([
            "message" => "Todo Deleted",
        ], 200);
    }
}
