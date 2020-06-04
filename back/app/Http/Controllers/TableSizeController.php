<?php

namespace App\Http\Controllers;

use App\Models\TableSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TableSizeController extends Controller
{
    public function index()
    {
        $result = TableSize::all();
        return response()->json($result, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }

    public function create(Request $request)
    {
        try {
            $find = TableSize::where('size', Input::get('size'))->get();
            if (count($find) > 0) return response()->json(['success' => false, 'error' => ['code' => 1, 'message' => 'Размеру уже существует']], 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
            $item = TableSize::create(Input::all());
            return response()->json(['success' => true, 'data' => $item], 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $find = TableSize::find($id);
            if ($find === null) return response()->json(['success' => false, 'error' => 'Model not found'], 400);

            $size = Input::get('size');
            if ($size !== $find->size) {
                $find2 = TableSize::where('size', Input::get('size'))->get();
                if (count($find2) > 0) return response()->json(['success' => false, 'error' => ['code' => 1, 'message' => 'Размеру уже существует']], 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
            }
            $find->size = $size;
            $find->name1 = Input::get('name1');
            $find->age1 = Input::get('age1');
            $find->rf1 = Input::get('rf1');
            $find->height1 = Input::get('height1');
            $find->chest1 = Input::get('chest1');
            $find->waist1 = Input::get('waist1');
            $find->name2 = Input::get('name2');
            $find->age2 = Input::get('age2');
            $find->rf2 = Input::get('rf2');
            $find->height2 = Input::get('height2');
            $find->chest2 = Input::get('chest2');
            $find->waist2 = Input::get('waist2');
            $find->name3 = Input::get('name3');
            $find->age3 = Input::get('age3');
            $find->rf3 = Input::get('rf3');
            $find->height3 = Input::get('height3');
            $find->chest3 = Input::get('chest3');
            $find->waist3 = Input::get('waist3');
            $find->name4 = Input::get('name4');
            $find->age4 = Input::get('age4');
            $find->rf4 = Input::get('rf4');
            $find->height4 = Input::get('height4');
            $find->chest4 = Input::get('chest4');
            $find->waist4 = Input::get('waist4');
            $find->save();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function delete($id)
    {
        try {
            $item = TableSize::find($id);
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
