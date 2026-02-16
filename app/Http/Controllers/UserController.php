<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $users=User::all();
        return view('users.show',compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=User::findOrFail($id);
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validate=$request->validate([
            'name'=>'required | min:3',
            'email'=>'required | email',
            'password'=>'nullable | min:6'
        ],[
            'required'=>'هذا الحقل مطلوب',
            'email'=>'يجب ادخال بريد الكتروني صالح',
            'name.min'=>'يجب ان يكون اسم المستخدم اكبر من 3 احرف',
            'password.min'=>'يجب ان تكون كلمه السر اكبر من 6 احرف'
        ]);

        if($request->filled('password')){       //التحقق اذا كان حقل كلمه المرور فارغ 
            $validate['password']=Hash::make($request->password);
        }
        else{
            unset($validate['password']);
        }

        $user->update($validate);       //تحديث البيانات
        return back()->with('success','تم تحديث بيانات المستخدم');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
{
    if($user->role !== 'مدير'){   //منع حذف مستخدم في دور مدير
        $user->delete();
    
        return back()->with('success', 'تم حذف المستخدم بنجاح');
    }
    else
        return back()->with('error', 'عفوا لا يمكن حذف مستخدم في دور مدير');
}

    public function register()
    {
        return view('users.add_user');
    }
}
