<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function types () {
        $result = [
            ['id'=>1, 'name'=>'Футболка №1', 'imgFront'=>'88e88688bde40620b80079f7cc23290f.jpg', 'imgBack'=>'88e88688bde40620b80079f7cc23290f.jpg'],
            ['id'=>2, 'name'=>'Футболка №2', 'imgFront'=>'b77ccb40d22718853042d062f14732f3.jpg', 'imgBack'=>'b77ccb40d22718853042d062f14732f3.jpg'],
            ['id'=>3, 'name'=>'Футболка №3', 'imgFront'=>'c0cbfef4a183576095bb6025b0133127.jpg', 'imgBack'=>'c0cbfef4a183576095bb6025b0133127.jpg'],
        ];
        return response()->json($result, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }
}
