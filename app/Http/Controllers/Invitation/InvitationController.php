<?php

namespace App\Http\Controllers\Invitation;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function index() {}
    public function create()
    {
        Membership::create([
            'user_id' => auth()->user()->id,
            'colocation_id' => $colocation->id,
            'type' => 'owner',
            'status' => 'complete',
            'solde' => 0,
            'joined_at' => now(),
            'left_at' => null,
        ]);
    }
}
