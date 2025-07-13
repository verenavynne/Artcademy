<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Lecturer;
use App\Models\Student;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectTo()
    {
        $role = auth()->user()->role;
        if ($role === 'student') {
            return '/student/home';
        } elseif ($role === 'lecturer') {
            return '/lecturer/home';
        } elseif ($role === 'admin') {
            return '/admin/home';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:5', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phoneNumber' => [
                'required',
                'regex:/^\+[0-9]{12,16}$/'
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:lecturer,student'],
            'specialization' => ['required_if:role,lecturer'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.min' => 'Nama minimal 5 karakter.',
            'name.max' => 'Nama maksimal 20 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',

            'phoneNumber.required' => 'Nomor Telepon wajib diisi.',
            'phoneNumber.regex' => 'Nomor Telepon harus diawali + dan sisanya angka, total minimal 13 karakter dan maksimal 16 karakter.',

            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',

            'role.required' => 'Role wajib dipilih.',
            'specialization.required_if' => 'Keahlian wajib dipilih',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'phoneNumber' => $data['phoneNumber'],
        ]);

        if ($data['role'] === 'lecturer') {
            Lecturer::create([
                'id' => $user->id,
                'specialization' => $data['specialization'],
            ]);
        } elseif ($data['role'] === 'student') {
            Student::create([
                'id' => $user->id,
            ]);
        }

        return $user;
    }
}
