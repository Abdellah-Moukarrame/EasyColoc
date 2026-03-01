<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\InvitationEmail;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index(Request $request){
        $token = bin2hex(random_bytes(10));
        Mail::to('moukarrameabdella4@gmail.com')->send(new InvitationEmail($token));


        Membership::create([
            'user_id' => User::where('email',$request->email)->first()->id,
            'colocation_id' => $request->colocation_id,
            'type' => 'member',
            'status' => 'pending',
            'solde' => 0,
            'joined_at' => now(),
            'left_at' => null,
            'token' => $token,
        ]);
        echo ('sent succesfully');
    }

}
