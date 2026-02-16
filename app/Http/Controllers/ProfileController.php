<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('success', 'تم الحفظ');
    }

    /**
     * Delete the user's account.
     */
public function destroy(Request $request): RedirectResponse
{
    
    $request->validate( [
        'passwordDelete' => ['required'],
    ],[
        'passwordDelete.required'=>'يجب ادخال كلمه المرور الحاليه',
    ]);

    //  التحقق من صحة كلمة المرور
    if (! Hash::check($request->passwordDelete, $request->user()->password)) {
        
        return back()->withErrors(['passwordDelete' => 'كلمة المرور غير صحيحه']);
    }

    
    $user = $request->user();

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/');
}
}
