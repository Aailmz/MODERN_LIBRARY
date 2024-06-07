<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function tableSiswa()
    {
        $students = User::where('role', 'siswa')->get();
        return view('example', ['students' => $students]);
    }

    public function adminSiswa()
    {
        $students = User::where('role', 'siswa')->get();
        return view('adminstudent', ['students' => $students]);
    }

    public function tablePetugas()
    {
        $employees = User::where('role', 'petugas')->get();
        return view('tablepetugas', ['employees' => $employees]);
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        
        // Update student data
        $user->name = $request->name;
        $user->email = $request->email;
        
        $user->save();
        
        return response()->json(['success' => 'User updated successfully']);
    }


    public function delete(Request $request)
    {
        $user = User::find($request->id);
        
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        
        $user->delete();
        
        return response()->json(['success' => 'User deleted successfully']);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        return response()->json(['success' => 'User created successfully']);
    }

    //MOBILE

}
