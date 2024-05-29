<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Notifications\ProductNotification;
use App\Notifications\SendProductNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'adminEmail'  => 'required|email',
            'name'        => 'required',
            'phone'       => 'required',
            'email'       => 'required|email',
            'productCode' => 'required',
            'productName' => 'required',
            'quantity'    => 'required',
            'amount'      => 'required',
        ]);

        $details = [
            'name'        => $request->get('name'),
            'phone'       => $request->get('phone'),
            'email'       => $request->get('email'),
            'productCode' => $request->get('productCode'),
            'productName' => $request->get('productName'),
            'quantity'    => $request->get('quantity'),
            'amount'      => $request->get('amount'),
        ];
        //Enviar correo de solicitud  a administrador
        Notification::route('mail', $request->adminEmail)->notify(new ProductNotification($details));
        //Enviar correo de envio a solicitante
        Notification::route('mail', $request->email)->notify(new SendProductNotification($details));

        return response()->json(['message' => 'Se ha generado la solicitud de producto exitosamente.']);
    }
}
