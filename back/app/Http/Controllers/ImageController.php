<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function image ($filename) {
        try {
//            dd($filename);
            $path = Storage::disk('images')->getAdapter()->getPathPrefix().$filename;
            return Response::download($path);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }
}
