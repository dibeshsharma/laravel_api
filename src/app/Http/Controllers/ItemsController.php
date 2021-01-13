<?php

namespace App\Http\Controllers;
use App\Item;
use App\Events\ItemAdded;
use App\Events\ItemUpdated;
use App\Events\ItemDeleted;
use Illuminate\Http\Request;
use Validator;

class ItemsController extends Controller
{
    public function index()
    {    	
        return response()->json(Item::get(),200);
    }

    public function show($id)
    {
    	return response()->json(Item::findOrFail($id), 200);
    }

    public function store(Request $request)
    {
    	$rules = [
    		"name"  => "required",
    		"email" => "required|unique:items",
    	];

    	$validator = Validator::make($request->all(), $rules);

    	if($validator->fails()){
    		return response()->json(['errors'=>$validator->errors(), 'message' => 'Form Errors.'], 400);
    	}

    	$item = Item::create($request->all());
        event(new ItemAdded($item));
    	return response()->json(['item' => $item, 'message' => 'Registered successfully.'], 201);
    }

    public function update(Request $request, Item $item)
    {
    	$item->update($request->all());
        event(new ItemUpdated($item));
    	return response()->json(['item'=>$item, 'message'=>'Updated successfully.'], 200);
    }

    public function delete(Request $request, Item $item)
    {
        $oldItem = [
            "id"=>$item->id,
            "name" => $item->name,
            "email" => $item->email
        ];

        $item->delete();
        event(new ItemDeleted($oldItem));
    	return response()->json(null, 204);
    }

    public function errors()
    {
    	return response()->json(['msg'=>'Oops, the server does not recognize the request method. Sorry.'], 501);
    }
}
