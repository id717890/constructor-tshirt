<?php

namespace App\Http\Controllers;

use App\Models\Promocode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PromocodeController extends Controller
{
    public function index()
    {
        $result = Promocode::orderBy('created_at', 'desc')->get();
        return response()->json($result, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }

    public function check()
    {
        try {
            $code = Input::get('code');
            if ($code === null) return response()->json(['success' => false, 'error' => 'Code is required'], 200);
            $find = Promocode::where('code', $code)->first();
            if ($find === null) return response()->json(['success' => false, 'error' => 'Code not found'], 200);
            return response()->json(['success' => true, 'data' => $find], 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }

    }

    public function create(Request $request)
    {
        try {
            $staff = Promocode::create(Input::all());
            return response()->json($staff, 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $find = Promocode::find($id);
            if ($find === null) return response()->json(['success' => false, 'error' => 'Model not found'], 400);
            $find->name = Input::get('name');
            $find->code = Input::get('code');
            $find->discount = Input::get('discount');
            $find->save();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function delete($id)
    {
        try {
            $item = Promocode::find($id);
            if ($item !== null) {
                $item->delete();
            } else {
                return response()->json(['success' => false, 'error' => 'Not found'], 400);
            }
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }
}
