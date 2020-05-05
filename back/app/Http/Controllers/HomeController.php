<?php

namespace App\Http\Controllers;

use PDF;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function types()
    {
        $result = [
            ['id' => 1, 'name' => 'Футболка №1', 'imgFront' => '88e88688bde40620b80079f7cc23290f.jpg', 'imgBack' => '88e88688bde40620b80079f7cc23290f.jpg'],
            ['id' => 2, 'name' => 'Футболка №2', 'imgFront' => 'b77ccb40d22718853042d062f14732f3.jpg', 'imgBack' => 'b77ccb40d22718853042d062f14732f3.jpg'],
            ['id' => 3, 'name' => 'Футболка №3', 'imgFront' => 'c0cbfef4a183576095bb6025b0133127.jpg', 'imgBack' => 'c0cbfef4a183576095bb6025b0133127.jpg'],
        ];
        return response()->json($result, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }

    public function logos()
    {
        $result = [
            ['id' => 1, 'name' => 'Logo №1', 'img' => 'futbolist.png'],
            ['id' => 2, 'name' => 'Logo №2', 'img' => 'logo1x1.png'],
            ['id' => 3, 'name' => 'Logo №3', 'img' => 'manchester_united_PNG23.png'],
        ];
        return response()->json($result, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }


    public function doc1()
    {
        return view('email.fizik_doc1')
            ->with('number', 12345)
            ->with('date', '20.04.2020')
            ->with('fio', 'Иванов')
            ->with('info', 'Еуыефыв фы вфы вфы вф ы в');
    }

    public function doc2()
    {
        return view('email.fizik_doc2')
            ->with('number', 12345)
            ->with('date', '20.04.2020')
            ->with('fio', 'Иванов')
            ->with('buyer', 'Еуыефыв фы вфы вфы вф ы в')
            ->with('price', 999);
    }

    public function doc3()
    {
        return view('email.yurik_doc1')
            ->with('number', 12345)
            ->with('date', '20.04.2020')
            ->with('field1', 'Иванов')
            ->with('field2', 'FIELD 2')
            ->with('field3', 'FIELD 3')
            ->with('info', 'Еуыефыв фы вфы вфы вф ы в');
    }

    public function doc4()
    {
        return view('email.yurik_doc2')
            ->with('number', 12345)
            ->with('date', '20.04.2020')
            ->with('field1', 'Иванов')
            ->with('field2', 'FIELD 2')
            ->with('field3', 'FIELD 3')
            ->with('info', 'Еуыефыв фы вфы вфы вф ы в')
            ->with('price', 999);
    }

    public function printPDF()
    {
        // This  $data array will be passed to our PDF blade

        try {
            $data = [
                'title' => 'First PDF for Medium',
                'heading' => 'Hello from 99Points.info',
                'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.'
            ];

            $pdf = PDF::loadView('pdf_view', $data);
            return $pdf->download('medium.pdf');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }

    }


}
