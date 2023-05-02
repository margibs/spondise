<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Traits\HttpResponses;

class GoogleAuthenticationController extends Controller
{
    use HttpResponses;

    public function redirect()
    {
        return $this->success([
            'redirect' => Socialite::with('google')->stateless()->redirect()->getTargetUrl()
        ]);
    }

    public function callback()
    {
        $user = Socialite::driver('google')->stateless()->user();
    }
}
