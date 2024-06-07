<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $role = $request->user()->role;

        if ($role === 'admin') {
            return redirect()->route('admins.dashboard');
        } elseif ($role === 'petugas') {
            return redirect()->route('petugas.dashboard');
        } elseif ($role === 'siswa') {
            return redirect()->route('siswas.dashboard');
        }
        return redirect('/');
    }

    public function storeMobile(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();
        $role = $user->role;

        return response()->json([
            'message' => 'Logged in successfully',
            'role' => $role,
            'user' => $user,
        ], 200)->header('Access-Control-Allow-Origin', '*');
    }

    public function loginMobile(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Attempt to log in with the provided credentials
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $role = $user->role;

            // Return a JSON response based on the user's role
            return response()->json([
                'user' => $user,
                'role' => $role
            ], 200);
        }

        // If authentication fails, return an error response
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/loginget');
    }

    public function userDetails()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        if ($user) {
            // You can fetch additional data based on the user ID
            $userData = User::find($user->id); // Assuming your user model is named 'User'

            // Check if user data is found
            if ($userData) {
                return response()->json($userData);
            } else {
                return response()->json(['error' => 'User not found'], 404);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function logoutMobile(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Successfully logged out']);
    }

}
