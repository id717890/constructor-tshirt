<?php

namespace App\Http\Controllers;

use App\Models\Callback;
use Egulias\EmailValidator\Exception\ExpectingCTEXT;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;
use Validator;
use Illuminate\Support\Facades\Input;
use Mail;

class CallbackController extends Controller
{
    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'phone' => 'required|max:255',
            ]);
//        return response()->json(Input::all(), 200);
            if ($validator->passes()) {
                $callback = new Callback();
                $callback->name = Input::get('name');
                $callback->phone = Input::get('phone');
                $callback->is_coupon = Input::get('is_coupon');
                $callback->save();
                $subject = "Уведомление с " . getenv('FROM_SEO');
                $email = [];
                if (!is_null(getenv('EMAIL1')) && getenv('EMAIL1') !== '') array_push($email, getenv('EMAIL1'));
                if (!is_null(getenv('EMAIL2')) && getenv('EMAIL2') !== '') array_push($email, getenv('EMAIL2'));
                if ($callback->is_coupon == true) $message = "Запрос на предоставление СКИДОЧНОГО КУПОНА + КАТАЛОГА";
                else $message = "Запрос на ОБРАТНЫЙ ЗВОНОК";
                Mail::send('email.callback', ['text' => $message, 'name' => $callback->name, 'phone' => $callback->phone],
                    function ($mail) use ($email, $subject) {
                        $mail->from(getenv('FROM_EMAIL_ADDRESS'), getenv('FROM_SEO'));
                        $mail->to($email);
                        $mail->subject($subject);
                    });
                return response()->json(200);
            } else {
                return response()->json($validator->errors()->all(), 400);
            }

        } catch (\Exception $e) {
//            return response()->json($e->getMessage(), 500, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
            return response()->json('Ошибка сервера при обработке запроса', 500, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        }


    }
}
