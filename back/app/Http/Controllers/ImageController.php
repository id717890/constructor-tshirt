<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;


class ImageController extends Controller
{
    function GUID()
    {
        return trim(com_create_guid(), '{}');
    }

    public function image($filename)
    {
        try {
//            dd($filename);
            $path = Storage::disk('images')->getAdapter()->getPathPrefix() . $filename;
            return Response::download($path);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }

    public function upload(Request $request)
    {
        try {
            $image = Input::file('image');
            $prefix = Input::get('prefix') !== null ? Input::get('prefix') : '';
            $path = '';

            if (isset($image)) {
                $ext = $image->getClientOriginalExtension();
                $name = $prefix . $this->GUID();

                if ($ext !== '') {
                    $path = $image->storeAs('images', $name . '.' . $ext);

                    if ($path !== '' && $path !== null) {
                        return response()->json([
                            'name' => $name,
                            'fullname' => $name . '.' . $ext,
                            'path' => $path
                        ], 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
                    }
                }
            }
            return response()->json([], 400, JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }
}
