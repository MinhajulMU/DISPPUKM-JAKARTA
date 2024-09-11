<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redis;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use App\Helpers\Response;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        //
    }
    public function login(Request $request)
    {
        //
        $credentials = $request->only('username', 'password');

        //valid credential
        $validator = Validator::make($credentials, [
            'username' => 'required|email',
            'password' => 'required|string|min:2|max:50'
        ]);

        if ($validator->fails()) {
            return Response::error(message: "Password / Email Invalid");
        }

        $user = User::where('email', $request->input('username'))->first();
        if (!$user) {
            return Response::error(message: "Password / Email Invalid");
        }

        if (!\Hash::check($request->password, $user->password, [])) {
            return Response::error(message: "Email dan Kata sandi tidak sesuai");
        }

        if (!$token = JWTAuth::fromUser($user)) {
            return Response::error(code: 401, message: "Cannot Generate Token");
        }
        return Response::success(data: [
            'token' => $token
        ], message:"success login");
    }
}
