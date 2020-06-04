<?php

namespace App\Http\Controllers;

use App\Models\AboutImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class AboutImageController extends Controller
{
    public function index()
    {
        $result = AboutImage::orderBy('created_at', 'desc')->get();
        return response()->json($result, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }

    public function create(Request $request)
    {
        try {
            $staff = AboutImage::create(Input::all());
            return response()->json($staff, 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $find = AboutImage::find($id);
            if ($find === null) return response()->json(['success' => false, 'error' => 'Model not found'], 400);
            $image = Input::get('image');
            if ($find->image !== $image) {
                try {
                    if (Storage::exists('images/' . $find->image) === true) Storage::delete('images/' . $find->image);
                } catch (\Exception $e) {
                }
            }
            $find->name = Input::get('name');
            $find->image = $image;
            $find->save();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function delete($id)
    {
        try {
            $item = AboutImage::find($id);
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
