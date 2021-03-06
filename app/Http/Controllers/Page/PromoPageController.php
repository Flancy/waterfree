<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromoPageController extends Controller
{
    public function index()
    {
    	return view('pages.promo');
    }
    
    public function mail(DilerMailRequest $request)
    {
    	$mail = Mail::to('flancyk.flancyk@yandex.ru')->send(new DilerMail($request))->subject('MYHIM.RU - Заявка от дилера!');

        return redirect()->back()
            ->withSuccess('Спасибо за заявку! Наш менеджер скоро свяжется с Вами!');
    }
}
