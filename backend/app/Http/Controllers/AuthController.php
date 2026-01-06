<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PasswordReset;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'full_name' => 'required|string|max:150',
            'username'  => 'required|string|max:100|unique:users,username',
            'email'     => 'required|email|max:150|unique:users,email',
            'password'  => 'required|string|min:6',
            'phone'     => 'nullable|string|max:30',
            'address'   => 'nullable|string',
        ]);

        // Create user with hashed password
        $user = User::create([
            'full_name'    => $validated['full_name'],
            'username'     => $validated['username'],
            'email'        => $validated['email'],
            'password_hash'=> Hash::make($validated['password']),
            'phone'        => $validated['phone'] ?? null,
            'address'      => $validated['address'] ?? null,
        ]);

        // Generate Sanctum token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return success response
        return response()->json([
            'message'      => 'User registered successfully',
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => $user,
        ], 201);
    }

    /**
     * Get authenticated user details
     */
    public function me(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        return response()->json([
            'id'         => $user->id,
            'full_name'  => $user->full_name,
            'username'   => $user->username,
            'email'      => $user->email,
            'phone'      => $user->phone,
            'trust_score'=> $user->trust_score,
            'role'       => $user->role,
            'status'     => $user->status,
            'created_at' => $user->created_at,
        ]);
    }

    /**
     * Login user (supports login with either username or email)
     */
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'login'    => 'required|string', // Can be username or email
            'password' => 'required|string',
        ]);

        $login    = $request->input('login');
        $password = $request->input('password');

        // Find user by username or email
        $user = User::where('username', $login)
            ->orWhere('email', $login)
            ->first();

        // Check if user exists and password is correct
        if (!$user || !Hash::check($password, $user->password_hash)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'      => 'Login successful',
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => $user
        ]);
    }

    /**
     * Logout user (revoke all tokens)
     */
    public function logout(Request $request)
    {
        // Revoke all tokens for the authenticated user
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    public function verifyResetCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:6',
        ]);

        $reset = PasswordReset::where('email', $request->email)
            ->where('token', $request->code)
            ->first();

        if (!$reset || Carbon::parse($reset->created_at)->addMinutes(15)->isPast()) {
            return response()->json(['message' => 'کد نامعتبر یا منقضی شده'], 400);
        }

        return response()->json(['message' => 'کد معتبر است']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:6',
            'password' => 'required|min:6',
        ]);

        $email = trim(strtolower($request->email));

        $reset = PasswordReset::where('email', $email)
            ->orderBy('created_at', 'desc')
            ->first();

        if (
            !$reset ||
            $reset->token !== (string) $request->code ||
            Carbon::parse($reset->created_at)->addMinutes(15)->isPast()
        ) {
            return response()->json(['message' => 'کد نامعتبر یا منقضی شده'], 400);
        }

        $user = User::where('email', $email)->firstOrFail();

        $user->password_hash = Hash::make($request->password);
        $user->save();

        PasswordReset::where('email', $email)->delete();

        return response()->json(['message' => 'رمز عبور با موفقیت تغییر یافت']);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = trim(strtolower($request->email));

        // حتی کاربران soft-deleted هم پیدا می‌شوند
        $user = User::withTrashed()
            ->where('email', $email)
            ->first();

        // همیشه پاسخ یکسان (امنیتی)
        if (!$user) {
            return response()->json([
                'message' => 'در صورت وجود حساب، کد بازیابی ارسال شد'
            ]);
        }

        // پاک کردن کدهای قبلی
        PasswordReset::where('email', $email)->delete();

        $code = random_int(100000, 999999);

        PasswordReset::create([
            'email' => $email,
            'token' => (string) $code,
            'created_at' => now(),
        ]);

        try {
            Mail::to($user->email)->send(new ResetPasswordMail($code));
        } catch (\Exception $e) {
            \Log::error('Email send failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'خطا در ارسال ایمیل'
            ], 500);
        }

        return response()->json([
            'message' => 'در صورت وجود حساب، کد بازیابی ارسال شد'
        ]);
    }

}
