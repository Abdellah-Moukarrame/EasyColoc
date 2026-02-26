<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\InvitationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index(){
        Mail::to('moukarrameabdella4@gmail.com')->send(new InvitationEmail);
        echo ('sent succesfully');
    }
}
