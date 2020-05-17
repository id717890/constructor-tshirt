<?php

namespace App\Http\Controllers;

use App\Models\ModelT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ModelController extends Controller
{
    public function index()
    {
        $result = ModelT::with('type')->orderBy('order')->get();
        return response()->json($result, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }

    public function create(Request $request)
    {
        try {
            $model = ModelT::create(Input::all());
            return response()->json($model, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function updateOrder(Request $request, $id)
    {
        try {
            $order = Input::get('order');
            $find = ModelT::find($id);
            if ($find === null) return response()->json(['success' => false, 'error' => 'Model not found'], 400);
            $find->order = $order;
            $find->save();
            return response()->json(['success' => true, 'models' => ModelT::with('type')->orderBy('order')->get()], 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
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
            $order = Input::get('order');
            $find = ModelT::find($id);
            if ($find === null) return response()->json(['success' => false, 'error' => 'Model not found'], 400);
            if ($find->image !== $image) {
                try {
                    if (Storage::exists('images/' . $find->image) === true) Storage::delete('images/' . $find->image);
                } catch (\Exception $e) {
                }
            }
            $find->name = $name;
            $find->description = $description;
            $find->type_id = $type;
            $find->image = $image;
            $find->order = $order;
            $find->save();
            return response()->json(['success' => true], 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function delete($id)
    {
        try {
            $item = ModelT::find($id);
            if ($item !== null) {
                try {
                    if (Storage::exists('images/' . $item->image) === true) Storage::delete('images/' . $item->image);
                } catch (\Exception $e) {
                }
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
