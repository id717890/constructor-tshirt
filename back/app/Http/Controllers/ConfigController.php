<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ConfigController extends Controller
{
    public function index()
    {
        $result = Config::all();
        return response()->json($result, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }

    public function set()
    {
        try {
            $key = Input::get('key');
            $value = Input::get('value');
            if ($key === null) return response()->json(['success' => false, 'error' => 'Key is null'], 400);
            if ($value === null) return response()->json(['success' => false, 'error' => 'Value is null'], 400);
            $find = Config::where('key',$key)->first();
            if ($find === null) {
                $model = Config::create(Input::all());
            } else {
                $find->value = $value;
                $find->save();
            }
            return response()->json(['success' => true], 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }
}
