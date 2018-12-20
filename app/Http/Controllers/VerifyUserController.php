<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class VerifyUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($token, User $user)
    {
        if(empty($token)) {
            return redirect()->route('login');
        }
        $token = base64_decode($token);
        $token = explode('|', $token);

        if(count($token) == 1) {
            return redirect()->route('login');
        }

        $email = $token[0];
        $user_id = $token[1];

        $check_token = $user->where('email', $email)->where('userid', $user_id)->count();

        if($check_token == 0)
        {
            return redirect()->route('login');
        } elseif($check_token == 1) {
            return redirect()->route('login')->with('status', 'Your e-mail is already verified. You can now login.');
        }

        return redirect()->route('login')->with('status', 'Thanks for confirmation. Please login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
