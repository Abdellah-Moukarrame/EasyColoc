<?php

namespace App\Http\Controllers\Membership;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Statement;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function quitter(Request $request)
    {
        $unpaidCount = Statement::where([
            'user_id' => auth()->id(),
            'colocation_id' => $request->colocation_id,
            'status' => 'unpaid',
        ])->count();
        // dd($unpaidCount, auth()->user()->reputation);

        if ($unpaidCount > 0) {
            auth()->user()->update([
                'reputation' => auth()->user()->reputation - 1
            ]);
        }
        if ($unpaidCount == 0) {
            auth()->user()->update([
                'reputation' => auth()->user()->reputation + 1
            ]);
        }

        Membership::where([
            'user_id' => auth()->id(),
            'colocation_id' => $request->colocation_id,
        ])->update([
            'left_at' => now(),
            'status' => 'pending',
        ]);

        return redirect()->route('welcome.dashboard');
    }
}
