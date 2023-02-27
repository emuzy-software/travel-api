<?php

namespace App\Http\Controllers;

use App\Requests\Authentication\LoginRequest;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Services\UserServiceInterface;
use App\Requests\Authentication\SignUpRequest;
use Illuminate\Contracts\Auth\Guard;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }
    public function signUp(SignUpRequest $request): JsonResponse
    {
        try {
            $data = $request->only(['email', 'password', 'name']);
            $emailChecked = $this->userService->findUserByEmail($data['email']);
            if (!empty($emailChecked)) {
                return $this->error(__('auth.email_exist'), null, 500);
            }

            $user = $this->userService->createUser($data);

            return $this->success(__('general.success'), $user);
        } catch (\Exception $exception) {
            Log::error('signUp(): ' . json_encode($exception));
            Log::error($exception);

            return $this->error(__('general.server_error'), null, 500);
        }
    }
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $email = $request->input('email');
            $password = $request->input('password');
            $credentials = [
                'email' => $email,
                'password' => $password
            ];

            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->error('Tài khoản hoặc mật khẩu không đúng', null, 400);
            }

            $user =  $this->guard()->user();
            if (!$user->is_active) {
                return $this->error('Không có quyền truy cập', null, 403);
            }

            if (empty($user->email_verified_at)) {
                return $this->error('Email chưa được xác thực', null, 501);
            }

            $expiresIn = JWTAuth::factory()->getTTL() * 60;
            $result = $this->makeToken($token, $expiresIn);
            DB::transaction(function () use ($user, $credentials) {
                // Update last login time
                $user =  $this->guard()->user();

                $user->last_login = Carbon::now()->timestamp;
            });

            return $this->success('Thành công', $result);
        } catch (\Exception $error) {
            Log::error($error);
            return $this->error('Có lỗi xảy ra', null, 500);
        } catch (GuzzleException $e) {
            Log::error($e);
            return $this->error('Có lỗi xảy ra', null, 500);
        }
    }

    public function refreshToken(Request $request): JsonResponse
    {
        try {
            $token = $this->guard()->refresh();
            $expiresIn = JWTAuth::factory()->getTTL() * 60;
            $result = $this->makeToken($token, $expiresIn);

            return $this->success('Thành công', $result);
        } catch (\Exception $error) {
            Log::error('Refresh token error message: ' . $error->getMessage());

            return $this->error('Có lỗi xảy ra', null, 500);
        } catch (GuzzleException $e) {
            Log::error($e);
            return $this->error('Có lỗi xảy ra', null, 500);
        }
    }

    public function logout(): JsonResponse
    {
        try {
            Auth::logout();

            return $this->success('Login thành công');
        } catch (\Exception $exception) {
            return $this->error('Có lỗi xảy ra', null, 500);
        }
    }
    /**
     * Get the guard to be used during authentication.
     *
     * @return Guard
     */
    public function guard(): Guard
    {
        return Auth::guard();
    }
    /**
     * Make token
     *
     * @param string $token
     * @param int $expiresIn
     * @return array
     */
    private function makeToken(string $token, int $expiresIn): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => $expiresIn
        ];
    }
}
