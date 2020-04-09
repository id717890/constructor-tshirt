<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TypeController extends Controller
{
    public function index () {
        $result = Type::all();
        return response()->json($result, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }

    public function create(Request $request)
    {
        try {
            $name = Input::get('name');
            $staff = Type::create(['name' => $name]);
            return response()->json($staff, 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $name = $request->name;
            $find = Type::find($id);
            if ($find === null) return response()->json(['success' => false, 'error' => 'User not found'], 400);
            $find->name = $name;
            $find->save();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function delete ($id) {
        try {
            $item = Type::find($id);
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
