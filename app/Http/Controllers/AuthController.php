<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        if(empty($request->name)){
            return response()->json([
                    'success' => false,
                    'data' => [
                        'message' => 'Name Tidak Boleh Kosong'
                    ]
                ]);
        }elseif(empty($request->email)){
            return response()->json([
                    'success' => false,
                    'data' => [
                        'message' => 'Email Tidak Boleh Kosong'
                    ]
                ]);
        }elseif(empty($request->password)){
            return response()->json([
                    'success' => false,
                    'data' => [
                        'message' => 'Password Tidak Boleh Kosong'
                    ]
                ]);
        }


    // Validasi password tambahan
            if (!preg_match('/(?=.*[a-z])/', $request->password)) {
                return response()->json([
                    'success' => false,
                    'data' => [
                        'message' => 'Password harus memiliki setidaknya satu huruf kecil.'
                    ]
                ]);
            } elseif (!preg_match('/(?=.*[A-Z])/', $request->password)) {
                return response()->json([
                    'success' => false,
                    'data' => [
                        'message' => 'Password harus memiliki setidaknya satu huruf besar.'
                    ]
                ]);
            } elseif (!preg_match('/(?=.*\d)/', $request->password)) {
                return response()->json([
                    'success' => false,
                    'data' => [
                        'message' => 'Password harus memiliki setidaknya satu angka.'
                    ]
                ]);
            } elseif (!preg_match('/(?=.*[@$!%*?&])/', $request->password)) {
                return response()->json([
                    'success' => false,
                    'data' => [
                        'message' => 'Password harus memiliki setidaknya satu simbol.'
                    ]
                ]);
            } elseif (strlen($request->password) < 8) {
                return response()->json([
                    'success' => false,
                    'data' => [
                        'message' => 'Password harus memiliki minimal 8 karakter.'
                    ]
                ]);
            }

        // Buat user baru
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Registration successful'
        ]);
    }

    public function login(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email cannot be empty',
            'password.required' => 'Password cannot be empty',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika user tidak ditemukan
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password'
            ], 401);
        }

        // Cek password
        if (!password_verify($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password'
            ], 401);
        }

        // Generate token
        $token = JWTAuth::fromUser($user);

        // Kirim token sebagai respons
        return response()->json([
            'success' => true,
            'token' => $token
        ]);
    }
}