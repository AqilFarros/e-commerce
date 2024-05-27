<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $userTransaction = Transaction::where('user_id', auth()->user()->id)->get();
        $pending = $userTransaction->where('status', 'pending')->count();
        $settlement = $userTransaction->where('status', 'settlement')->count();
        $expired = $userTransaction->where('status', 'expired')->count();

        return view('pages.user.index', compact('pending', 'settlement', 'expired'));
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required'
        ]);

        try {
            $currentPassword = Hash::check($request->old_password, auth()->user()->password);

            if ($currentPassword) {
                if ($request->password == $request->confirm_password) {
                    $user = auth()->user();
                    $user->password = Hash::make($request->password);
                    $user->save();

                    return redirect()->back()->with('success', 'Your Password Successfully Has Been Changed');
                } else {
                    return redirect()->back()->with('error', 'Your New Password Is Not Same With Confirm Password');
                }
            } else {
                return redirect()->back()->with('error', 'Your Old Password Is Wrong');
            }
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Failed To Change Password');
        }
    }
}
