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



        return view('custom.member', compact('member', 'topicsNumber', 'responsesNumber', 'lastResponse'));
    }
}
