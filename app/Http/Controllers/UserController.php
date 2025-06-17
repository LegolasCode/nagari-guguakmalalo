<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function accountRequestView()
    {
        $users = User::where('status', 'submitted')->get();
        return view('pages.account-request.index', compact('users'));
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'approved';
        $user->save();

        return redirect()->route('account.request')->with('success', 'Permintaan akun telah disetujui.');
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'rejected';
        $user->save();

        return redirect()->route('account.request')->with('success', 'Permintaan akun telah ditolak.');
    }
}
