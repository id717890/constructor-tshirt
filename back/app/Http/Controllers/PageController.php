<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PageController extends Controller
{
    public function index () {
        $result = Page::orderBy('created_at','desc')->get();
        return response()->json($result, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }

    public function single ($id) {
        $result = Page::find($id);
        return response()->json($result, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }

    public function create(Request $request)
    {
        try {
            $staff = Page::create(Input::all());
            return response()->json($staff, 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $find = Page::find($id);
            if ($find === null) return response()->json(['success' => false, 'error' => 'Model not found'], 400);
            $find->title = Input::get('title');
            $find->content= Input::get('content');
            $find->save();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function delete ($id) {
        try {
            $item = Page::find($id);
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
