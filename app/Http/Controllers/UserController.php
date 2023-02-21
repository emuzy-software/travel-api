<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function info(): JsonResponse
    {
        $auth = Auth::user();

        return $this->success('Thành công', $auth);
    }
}
