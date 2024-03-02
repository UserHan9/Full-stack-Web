<?php

namespace App\Http\Controllers\Api;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // Set validation
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
            ], 422);
        }

        // Dapatkan credentials dari request
        $credentials = $request->only('email', 'password');

        // Jika auth gagal
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah',
            ], 401);
        }

        $user = auth()->user();

      
        $roles = $user->getRoleNames();
        $permissions = $user->getAllPermissions()->pluck('name');

        
        return $this->authenticated($request, $user, $token, $roles, $permissions);
    }

    /**
     * Handle the authenticated user.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $user
     * @param string $token
     * @param array $roles
     * @param \Illuminate\Support\Collection $permissions
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user, $token, $roles, $permissions)
    {
        // Lakukan otentikasi pengguna
        auth()->login($user);

        $response = [
            'success' => true,
        'id' => auth()->user()->id,
        'name' => auth()->user()->name,
        'email' => auth()->user()->email,
        'roles' => $roles,
        'permissions' => $permissions,
        'token' => $token,
            
        ];

        return response()->json($response, 200);
    }
}
