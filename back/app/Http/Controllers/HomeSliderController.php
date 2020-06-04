<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\HomeSlider;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class HomeSliderController extends Controller
{
    public function getHomeSlides()
    {
        $result = HomeSlider::orderBy('created_at', 'desc')->get();
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
            $image = Input::get('image');
            if ($find === null) return response()->json(['success' => false, 'error' => 'Model not found'], 400);
            if ($find->image !== $image) {
                try {
                    if (Storage::exists('images/' . $find->image) === true) Storage::delete('images/' . $find->image);
                } catch (\Exception $e) {
                }
            }
            $find->image = $image;
            $find->type = Input::get('type');;
            $find->iframe = Input::get('iframe');;
            $find->url = Input::get('url');
            $find->save();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function deleteHomeSlide($id)
    {
        try {
            $item = HomeSlider::find($id);
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

    public function updateDiscountSlide()
    {
        try {
            $key1 = Input::get('key1');
            $value1 = Input::get('value1');
            $key2 = Input::get('key2');
            $value2 = Input::get('value2');
            if ($key1 === null) return response()->json(['success' => false, 'error' => 'Key is null'], 400);
            if ($value1 === null) return response()->json(['success' => false, 'error' => 'Value is null'], 400);
            $find = Config::where('key', $key1)->first();
            if ($find === null) {
                $model = Config::create(['key' => $key1, 'value' => $value1]);
            } else {
                if ($find->value !== $value1) {
                    try {
                        if (Storage::exists('images/' . $find->value) === true) Storage::delete('images/' . $find->value);
                    } catch (\Exception $e) {
                    }
                }
                $find->value = $value1;
                $find->save();
            }
            $find2 = Config::where('key', $key2)->first();
            if ($value2 === null || $value2 === '') {
                $find2->delete();
            } else {
                if ($find2 === null) {
                    Config::create(['key' => $key2, 'value' => $value2]);
                } else {
                    if ($find2->value !== $value2) {
                        try {
                            if (Storage::exists('images/' . $find2->value) === true) Storage::delete('images/' . $find2->value);
                        } catch (\Exception $e) {
                        }
                    }
                    $find2->value = $value2;
                    $find2->save();
                }
            }

            return response()->json(['success' => true], 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function getPartners()
    {
        $result = Partner::all();
        return response()->json($result, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }

    public function createPartner(Request $request)
    {
        try {
            $staff = Partner::create(Input::all());
            return response()->json($staff, 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function updatePartner(Request $request, $id)
    {
        try {
            $find = Partner::find($id);
            $image = Input::get('image');
            $url = Input::get('url');
            if ($find === null) return response()->json(['success' => false, 'error' => 'Model not found'], 400);
            if ($find->image !== $image) {
                try {
                    if (Storage::exists('images/' . $find->image) === true) Storage::delete('images/' . $find->image);
                } catch (\Exception $e) {
                }
            }
            $find->image = $image;
            $find->url= $url;
            $find->save();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function deletePartner($id)
    {
        try {
            $item = Partner::find($id);
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
