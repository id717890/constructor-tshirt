<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SizeController extends Controller
{
    public function index()
    {
        $result = Size::with('color')->get();
        return response()->json($result, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }

    public function get($color_id)
    {
        $result = Size::where('color_id',$color_id)->with('color')->get();
        return response()->json($result, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }

    public function create(Request $request)
    {
        try {
            $model = Size::create(Input::all());
            return response()->json($model, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function updateprices(Request $request, $id)
    {
        try {
            $price = Input::get('price');
            $find = Color::find($id);
            if ($price === null) return response()->json(['success' => false, 'error' => 'Price not found'], 400);
            if ($find === null) return response()->json(['success' => false, 'error' => 'Color not found'], 400);
            $allSizes = Size::where('color_id', $id)->get();
            foreach($allSizes as $size) {
                $size->price = intval($price);
                $size->save();
            }
            return response()->json($allSizes, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $find = Size::find($id);
            if ($find === null) return response()->json(['success' => false, 'error' => 'Model not found'], 400);
            $find->color_id = Input::get('color_id');
            $find->size= Input::get('size');
            $find->price = Input::get('price');
            $find->count = Input::get('count');
            $find->save();
            return response()->json(['success' => true], 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function delete($id)
    {
        try {
            $item = Size::find($id);
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
