<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    /**
     * 登录
     * Created by zfy.
     * Date:2020/11/13 15:15
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials,$request->has('remember'))) {
            //登录成功
            session()->flash('success', '欢迎回来！');
            return redirect()->route('users.show', [Auth::user()]);
        } else {
            //登录失败
            session()->flash('danger', '您的邮箱和密码不匹配');
            return redirect()->back()->withInput();
        }
    }

    /**
     * 登出
     * Created by zfy.
     * Date:2020/11/13 15:15
     */
    public function destroy(){
        Auth::logout();
        session()->flash('success',"您已成功退出！");
        return redirect('login');
    }
}
