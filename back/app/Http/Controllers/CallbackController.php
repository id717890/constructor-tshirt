<?php

namespace App\Http\Controllers;

use App\Exports\ContractFizik1;
use App\Exports\ZakazExport;
use App\Models\Callback;
use Egulias\EmailValidator\Exception\ExpectingCTEXT;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;
use Validator;
use Illuminate\Support\Facades\Input;
use Mail;
use Maatwebsite\Excel\Facades\Excel;

class CallbackController extends Controller
{
    public function  callMe(Request $request)
    {
        try {
            $name = Input::get('name');
            $phone = Input::get('phone');
            $subject = "Новая заявка с JOMA-CLUB.RU";
            $email = [];
            array_push($email, 'jusupovz@gmail.com');
//            array_push($email, 'jusupovz@gmail.com', 'vadimnazarovich@mail.ru');
            $fr = 'info@joma-club.ru';
            $seo = 'JOMA-CLUB';
            Mail::send('email.call_me', [
                'name' => $name,
                'phone' => $phone,
            ],
                function ($mail) use ($email, $subject, $fr, $seo) {
                    $mail->from($fr, $seo);
                    $mail->to($email);
                    $mail->subject($subject);
                });

            return response()->json(200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        }
    }

    public function  sendIdea(Request $request)
    {
        try {
            $name = Input::get('name');
            $phone = Input::get('phone');
            $text = Input::get('text');
            $subject = "Новое предложение JOMA-CLUB.RU";
            $email = [];
//            array_push($email, 'jusupovz@gmail.com');
            array_push($email, 'jusupovz@gmail.com', 'vadimnazarovich@mail.ru');
            $fr = 'info@joma-club.ru';
            $seo = 'JOMA-CLUB';
            Mail::send('email.idea', [
                'name' => $name,
                'phone' => $phone,
                'text' => $text,
            ],
                function ($mail) use ($email, $subject, $fr, $seo) {
                    $mail->from($fr, $seo);
                    $mail->to($email);
                    $mail->subject($subject);
                });

            return response()->json(200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        }
    }

    public function sendMail(Request $request)
    {
        try {

            $typeCustomer = Input::get('typeCustomer');
            $price = Input::get('price');
            $fio = Input::get('fio');
            $date = Input::get('date');
            $number = Input::get('number');
            $info = Input::get('info');
            $field1 = Input::get('field1');
            $field2 = Input::get('field2');
            $field3 = Input::get('field3');
            $zakazTovar = json_decode(Input::get('zakazTovar'), true);
            $zakazTovarSum = Input::get('zakazTovarSum');
            $zakazLogos = json_decode(Input::get('zakazLogos'), true);
            $zakazLogosEach = json_decode(Input::get('zakazLogosEach'), true);
            $zakazLogosSum = Input::get('zakazLogosSum');
            $zakazNumberName = json_decode(Input::get('zakazNumberName'), true);
//             return response()->json($price, 200,['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
            $images = $request->file('images');
            $subject = "Уведомление о заказе";
            $email = [];
//            array_push($email, 'jus_za@mail.ru');
//            array_push($email, 'jusupovz@gmail.com');
            array_push($email, 'jusupovz@gmail.com', 'vadimnazarovich@mail.ru');
//            array_push($email, 'jusupovz@gmail.com', 'vadimnazarovich@mail.ru', 'info@joma-club.ru');
            $fr = 'info@joma-club.ru';
            $seo = 'JOMA-CLUB';
            Mail::send('email.zakaz', [
                'typeCustomer' => $typeCustomer,
                'fio' => $fio,
                'info' => $info,
                'date' => $date,
                'number' => $number,
                'price' => $price,
                'field1' => $field1,
                'field2' => $field2,
                'field3' => $field3,
                'zakazTovar' => $zakazTovar,
                'zakazTovarSum' => $zakazTovarSum,
                'zakazLogos' => $zakazLogos,
                'zakazLogosEach' => $zakazLogosEach,
                'zakazLogosSum' => $zakazLogosSum,
                'zakazNumberName' => $zakazNumberName
            ],
                function ($mail) use ($email, $subject, $fr, $seo, $images) {
                    $mail->from($fr, $seo);
                    $mail->to($email);
                    $mail->subject($subject);

                    if (count($images) > 0) {
                        foreach ($images as $file) {
                            $mail->attach($file, array(
                                    'as' => $file->getClientOriginalName() . '.jpg', // If you want you can chnage original name to custom name
                                    'mime' => $file->getMimeType())
                            );
                        }
                    }

                });

            return response()->json(200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
//            return response()->json('Server error during processing request', 500, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        }
    }

    public function create(Request $request)
    {
        try {
            $zakazTovar = json_decode(Input::get('zakazTovar'), true);
            $zakazNumberName = json_decode(Input::get('zakazNumberName'), true);
            $zakazNanesenie = json_decode(Input::get('zakazNanesenie'), true);
            $zakazNanesenieEach = json_decode(Input::get('zakazNanesenieEach'), true);
//            $docBuy = Input::get('docBuy');
//            $docNanesenie = json_decode(Input::get('docNanesenie'), true);
            $info = json_decode(Input::get('info'), true);
            $images = $request->file('images');
            $subject = "Уведомление о заказе";
            $email = [];

            // if (!is_null(getenv('EMAIL1')) && getenv('EMAIL1') !== '') array_push($email, getenv('EMAIL1'));
            // if (!is_null(getenv('EMAIL2')) && getenv('EMAIL2') !== '') array_push($email, getenv('EMAIL2'));
//            array_push($email, 'jus_za@mail.ru');
//            array_push($email, 'jusupovz@gmail.com', 'vadimnazarovich@mail.ru', 'info@joma-club.ru');
            array_push($email, 'jusupovz@gmail.com');
//            array_push($email, 'jusupovz@gmail.com', 'jus_za@mail.ru');
            $fr = 'info@joma-club.ru';
            $seo = 'JOMA-CLUB';
//            dd($docBuy);
//             return response()->json($docBuy, 200);
            //  return response()->json($zakazNanesenie, 200);
            //   return response()->json($zakazNumberName, 200);
            // return response()->json($email, 200);
            // return response()->json(getenv('EMAIL1'), 200);
            // return response()->json(getenv('EMAIL1'), 200);
            // return response()->json(getenv('EMAIL2'), 200);
            // return response()->json(getenv('FROM_EMAIL_ADDRESS'), 200);
            // return response()->json(getenv('FROM_SEO'), 200);

            Mail::send('email.callback', [
                'zakazTovar' => $zakazTovar,
                'zakazNanesenie' => $zakazNanesenie,
                'zakazNumberName' => $zakazNumberName,
                'zakazNanesenieEach' => $zakazNanesenieEach,
                'info' => $info
//                'docBuy' => $docBuy
            ],
                function ($mail) use ($email, $subject, $fr, $seo, $images) {
                    $mail->from($fr, $seo);
                    $mail->to($email);
                    $mail->subject($subject);

                    if (count($images) > 0) {
                        foreach ($images as $file) {
                            $mail->attach($file, array(
                                    'as' => $file->getClientOriginalName() . '.jpg', // If you want you can chnage original name to custom name
                                    'mime' => $file->getMimeType())
                            );
                        }
                    }
//                    $mail->attach(
//                        Excel::download(
//                            new ContractFizik1('1','2','3', '4'),
//                            'report.xlsx'
//                        )->getFile(), ['as' => 'report.xlsx']
//                    );
                });

            return response()->json(200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
//            return response()->json('Server error during processing request', 500, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        }
    }
}
