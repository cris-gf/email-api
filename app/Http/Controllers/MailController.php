<?php

namespace App\Http\Controllers;

use App\Mail\FormMail;
use App\Notifications\FormNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class MailController extends Controller
{
    public function sendNotification(Request $request)
    {
        $request->validate([
            'adminEmail' => 'required|email',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'productCode' => 'required',
            'productName' => 'required',
            'quantity' => 'required',
            'amount' => 'required',
        ]);

        $details = [
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'productCode' => $request->get('productCode'),
            'productName' => $request->get('productName'),
            'quantity' => $request->get('quantity'),
            'amount' => $request->get('amount'),
        ];

        Notification::route('mail', $request->email)->notify(new FormNotification($details));

        return response()->json(['message' => 'Se ha enviado la solicitud exitosamente.'], 200);
    }
}
