<?php

namespace App\Http\Controllers;

use App\Models\ModelSize;
use App\Models\ModelT;
use App\Source\ConfigService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ModelController extends Controller
{
    private $sizes;

    public function __construct()
    {
        $this->sizes = ConfigService::all_sizes();
    }

    public function index()
    {
        $result = ModelT::with('type')->with('model_sizes')->orderBy('order')->get();
        return response()->json($result, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }

    public function autoCreate(Request $request)
    {
        try {
            DB::statement('delete from model_sizes');
            foreach (ModelT::all() as $model) {
                foreach ($this->sizes as $size) {
                    $model_size = new ModelSize();
                    $model_size->model_id = $model->id;
                    $model_size->size = $size;
                    $model_size->save();
                }
            }
            return response()->json('success', 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }

    }

    public function create(Request $request)
    {
        try {
            $model = ModelT::create(Input::all());
            foreach ($this->sizes as $size) {
                $model_size = new ModelSize();
                $model_size->model_id = $model->id;
                $model_size->size = $size;
                $model_size->save();
            }
            return response()->json($model, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function updateOrder(Request $request, $id)
    {
        try {
            $order = Input::get('order');
            $find = ModelT::find($id);
            if ($find === null) return response()->json(['success' => false, 'error' => 'Model not found'], 400);
            $find->order = $order;
            $find->save();
            return response()->json(['success' => true, 'models' => ModelT::with('type')->orderBy('order')->get()], 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function updateSize(Request $request, $id)
    {
        try {
            $sizes = Input::get('sizes');
            $find = ModelT::find($id);
            if ($find === null) return response()->json(['success' => false, 'error' => 'Model not found'], 400);
            if (count($sizes) > 0) {
                foreach ($sizes as $size) {

                    $findModelSize = ModelSize::find($size['id']);

                    if ($findModelSize !== null) {
                        $findModelSize->is_show = $size['is_show'];
                        $findModelSize->save();
                    }
                }
            }
            return response()->json(['success' => true], 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $name = Input::get('name');
            $description = Input::get('description');
            $type = Input::get('type_id');
            $image = Input::get('image');
            $order = Input::get('order');
            $find = ModelT::find($id);
            if ($find === null) return response()->json(['success' => false, 'error' => 'Model not found'], 400);
            if ($find->image !== $image) {
                try {
                    if (Storage::exists('images/' . $find->image) === true) Storage::delete('images/' . $find->image);
                } catch (\Exception $e) {
                }
            }
            $find->name = $name;
            $find->description = $description;
            $find->type_id = $type;
            $find->image = $image;
            $find->order = $order;
            $find->save();
            return response()->json(['success' => true], 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function delete($id)
    {
        try {
            $item = ModelT::find($id);
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
