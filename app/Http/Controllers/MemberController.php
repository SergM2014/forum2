<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;

class MemberController extends Controller
{
    public function show(Member $member)
    {
        $topicsNumber = $member->topics()->count();
        $responsesNumber = $member->responses()->count();
        $lastResponse = $member->responses()->latest()->first();

        return view('custom.member.info', compact('member', 'topicsNumber', 'responsesNumber', 'lastResponse'));
    }

    public function create()
    {

        return view('custom.member.signUp');
    }


    public function store(Request $request)
    {
        $request->validate([
            'login' => 'required|min:6|unique:members,name',
            'email' => 'required|email|unique:members,email',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6'
        ]);


        $member = new Member();
        if(!is_null($request->imageData)) $member->avatar = $request->imageData;
        $member->name = $request->login;
        $member->email = $request->email;
        $member->password = bcrypt($request->password);
        $member->remember_token = str_random(16);
        $member->save();

        session(['member' => $request->login]);

        return view('custom.member.added');

    }

    public function leave(Request $request)
    {
        $request->session()->forget('member');

         return redirect('/');

    }


}
