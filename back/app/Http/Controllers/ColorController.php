<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ColorController extends Controller
{
    private $sizes = ['6XS-5XS', '4XS-3XS', '2XS', 'XS', 'S', 'M', 'L', 'XL', '2ХL-3ХL'];

    public function index()
    {
        $result = Color::with('model')->with('sizes')->get();
        return response()->json($result, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }

    public function create(Request $request)
    {
        try {
            $model = Color::create(Input::all());
            if ($model !== null)
                foreach ($this->sizes as $s) {
                    $size = new Size();
                    $size->size = $s;
                    $size->price = 0;
                    $size->count = 0;
                    $size->color_id = $model->id;
                    $size->save();
                }
            return response()->json($model, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
//            $name = Input::get('name');
//            $description = Input::get('description');
//            $type = Input::get('type_id');
//            $image = Input::get('image');
            $find = Color::find($id);
            if ($find === null) return response()->json(['success' => false, 'error' => 'Model not found'], 400);
            $find->name = Input::get('name');
            $find->article = Input::get('article');
            $find->model_id = Input::get('model_id');
            $find->image_front = Input::get('image_front');
            $find->image_back = Input::get('image_back');
            $find->save();
            return response()->json(['success' => true], 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function delete($id)
    {
        try {
            $item = Color::find($id);
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
