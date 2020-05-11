<?php

namespace App\Http\Controllers;

use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class HomeSliderController extends Controller
{
    public function getHomeSlides () {
        $result = HomeSlider::orderBy('created_at','desc')->get();
        return response()->json($result, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }

    public function createHomeSlide(Request $request)
    {
        try {
            $staff = HomeSlider::create(Input::all());
            return response()->json($staff, 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function updateHomeSlide(Request $request, $id)
    {
        try {
            $find = HomeSlider::find($id);
            if ($find === null) return response()->json(['success' => false, 'error' => 'Model not found'], 400);
            $find->image = Input::get('image');
            $find->url= Input::get('url');
            $find->save();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function deleteHomeSlide ($id) {
        try {
            $item = HomeSlider::find($id);
            if ($item !== null) {
                try {
                    if (Storage::exists('images/' .$item->image) === true) Storage::delete('images/' .$item->image);
                } catch(\Exception $e) {}
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
