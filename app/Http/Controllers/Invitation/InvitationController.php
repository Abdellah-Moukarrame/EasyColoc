<?php

namespace App\Http\Controllers\Invitation;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Http\Request;


class InvitationController extends Controller
{
    public function index()
    {

        return view('colocations.show');
    }
    public function create(Request $request)
    {
        $token = random_bytes(10);
        dd($token);
        Membership::create([
            'user_id' => User::where('email', $request->email)->first()->id,
            'colocation_id' => $request->colocation_id,
            'type' => 'member',
            'status' => 'pending',
            'solde' => 0,
            'joined_at' => now(),
            'left_at' => null,
            'token' => $token,
        ]);
    }
    // /acceptJoin/{token}
    public function accept(Request $request)

    {
        $membership = Membership::where('token', $request->token)->where('status', 'pending')->first();

        $membership->update([
            'token'  => null,
            'status' => 'complete',
        ]);
        return redirect()->route('colocation.show', ['id' => $membership->colocation_id]);
    }
    public function refuse() {}
}
