<?php

namespace App\Http\Controllers;

use App\Models\ModelT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ModelController extends Controller
{
    public function index()
    {
        $result = ModelT::with('type')->get();
        return response()->json($result, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }

    public function create(Request $request)
    {
        try {
            $name = Input::get('name');
            $description = Input::get('description');
            $type = Input::get('type_id');
            $image = Input::get('image');
            $model = ModelT::create(['name' => $name, 'description' => $description, 'type_id' => $type, 'image'=>$image]);
            return response()->json($model, 200, JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $name = Input::get('name');
            $description = Input::get('description');
            $type = Input::get('type_id');
            $image = Input::get('image');
            $find = ModelT::find($id);
            if ($find === null) return response()->json(['success' => false, 'error' => 'Model not found'], 400);
            $find->name = $name;
            $find->description = $description;
            $find->type_id = $type;
            $find->image = $image;
            $find->save();
            return response()->json(['success' => true], 200, JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function delete($id)
    {
        try {
            $item = ModelT::find($id);
            if ($item !== null) {
                $item->delete();
            } else {
                return response()->json(['success' => false, 'error' => 'User not found'], 400);
            }
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }
}
