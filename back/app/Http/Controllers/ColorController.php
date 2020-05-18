<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Size;
use App\Source\ConfigService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ColorController extends Controller
{
    private $sizes;

    public function __construct() {
        $this->sizes = ConfigService::all_sizes();
    }

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
            $image_front = Input::get('image_front');
            $image_back = Input::get('image_back');
            $find = Color::find($id);
            if ($find === null) return response()->json(['success' => false, 'error' => 'Model not found'], 400);
            if ($find->image_front !== $image_front) {
                try {
                    if (Storage::exists('images/' . $find->image_front) === true) Storage::delete('images/' . $find->image_front);
                } catch (\Exception $e) {
                }
            }
            if ($find->image_back !== $image_back) {
                try {
                    if (Storage::exists('images/' . $find->image_back) === true) Storage::delete('images/' . $find->image_back);
                } catch (\Exception $e) {
                }
            }
            $find->name = Input::get('name');
            $find->article = Input::get('article');
            $find->model_id = Input::get('model_id');
            $find->image_front = $image_front;
            $find->image_back = $image_back;
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
                if ($item->image_front !== null) {
                    try {
                        if (Storage::exists('images/' . $item->image_front) === true) Storage::delete('images/' . $item->image_front);
                    } catch (\Exception $e) {
                    }
                }
                if ($item->image_back !== null) {
                    try {
                        if (Storage::exists('images/' . $item->image_back) === true) Storage::delete('images/' . $item->image_back);
                    } catch (\Exception $e) {
                    }
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
