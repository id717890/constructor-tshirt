<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Source\ConfigService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class CatalogController extends Controller
{
    public function index()
    {
        $result = Catalog::orderBy('created_at','desc')->get();;
        return response()->json($result, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }

    public function exportCatalogFile(Request $request)
    {
        try {
            $filename = Input::get('filename');
            $path = Storage::disk('catalogs')->getAdapter()->getPathPrefix() . $filename;
            return Response::download($path);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }

    public function create(Request $request)
    {
        try {
            $file = Input::file('doc');
            $name = '_';
            $ext = '_';
            if (isset($file)) {
                $ext = $file->getClientOriginalExtension();
                $name = 'catalog-' . ConfigService::GUID();
                if ($ext !== '') {
                    $file->storeAs('catalogs', $name . '.' . $ext);
                }
            } else return response()->json(['success' => false, 'error' => 'File is required'], 400);
            $newCatalog = new Catalog();
            $newCatalog->name = Input::get('name');
            $newCatalog->image = Input::get('image');
            $newCatalog->file = $name . '.' . $ext;
            $newCatalog->ext = $ext;
            $newCatalog->save();
            return response()->json($newCatalog, 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $find = Catalog::find($id);
            if ($find === null) return response()->json(['success' => false, 'error' => 'Catalog not found'], 400);
            $image = Input::get('image');
            $file = Input::file('doc');

            $file_name = Input::get('file_name');
            if ($find->file !== $file_name) {
                try {
                    if (Storage::exists('catalogs/' . $find->file) === true) Storage::delete('catalogs/' . $find->file);
                } catch (\Exception $e) {
                }

                if (isset($file)) {
                    $ext = $file->getClientOriginalExtension();
                    $name = 'catalog-' . ConfigService::GUID();
                    if ($ext !== '') {
                        $file->storeAs('catalogs', $name . '.' . $ext);
                        $find->file = $name . '.' . $ext;
                        $find->ext = $ext;
                    }
                } else return response()->json(['success' => false, 'error' => 'File is required'], 400);
            }
            if ($find->image !== $image) {
                try {
                    if (Storage::exists('images/' . $find->image) === true) Storage::delete('images/' . $find->image);
                } catch (\Exception $e) {
                }
            }
            $find->name = Input::get('name');
            $find->image = Input::get('image');
            $find->save();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function delete($id)
    {
        try {
            $item = Catalog::find($id);
            if ($item !== null) {
                try {
                    if (Storage::exists('images/' . $item->image) === true) Storage::delete('images/' . $item->image);
                    if (Storage::exists('catalogs/' . $item->file) === true) Storage::delete('catalogs/' . $item->file);
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
