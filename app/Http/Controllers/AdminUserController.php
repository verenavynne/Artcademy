<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Lecturer;
use App\Models\Admin;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->userStatus == 'active') {
            $query->where('userStatus', 'active');
        } elseif ($request->userStatus == 'inactive') {
            $query->where('userStatus', 'inactive');
        } 

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->input('perPage', 5);

        $users = $query->orderBy('created_at', 'desc')
                        ->paginate($perPage)
                        ->appends($request->query());
        return view('admin.user.userList', compact('users'));
    }

    public function userStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role'           => ['required', 'in:lecturer,admin'],
            'name'           => ['required', 'string', 'min:5', 'max:20'],
            'email'          => ['required', 'email', 'max:255', 'unique:users,email'],
            'phoneNumber'    => ['required', 'regex:/^\+[0-9]{12,16}$/'],
            'password'       => ['required', 'string', 'min:8', 'confirmed'],
            'specialization' => ['required', 'string'],
            'profilePicture'          => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048','required_if:role,lecturer'],
        ], [
            'role.required' => 'Role wajib dipilih.',
            'name.required' => 'Nama wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'phoneNumber.regex' => 'Nomor telepon harus diawali + dan berisi 13–16 karakter angka.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'specialization.required' => 'Keahlian wajib diisi.',
            'profilePicture.image' => 'File harus berupa gambar (jpg/jpeg/png).',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $originalName = $request->file('profilePicture')->getClientOriginalName();
        $filePath = $request->file('profilePicture')->storeAs('profile_pictures', $originalName, 'public');

        $data = [
            'name'        => $request->name,
            'email'       => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'password'    => Hash::make($request->password),
            'role'        => $request->role,
        ];
 
        if ($request->hasFile('profilePicture')) {
            $data['profilePicture'] = $filePath;
        }

        $user = User::create($data);


        if ($request->role === 'lecturer') {
            Lecturer::create([
                'id' => $user->id,
                'specialization' => $request->specialization,
            ]);
        } elseif ($request->role === 'admin') {
            Admin::create([
                'id' => $user->id,
            ]);
        }

        return response()->json([
            'message' => 'Pengguna berhasil ditambahkan!',
            'data' => $user
        ], 201);
    }

    public function detail($userId)
    {
        $user = User::with('lecturer')->findOrFail($userId);
        return view('admin.user.detail-user', compact('user'));
    }

    public function toggleStatus($userId)
    {
        $user = User::findOrFail($userId);

        $user->userStatus = $user->userStatus === 'active' ? 'inactive' : 'active';
        $user->save();

        return response()->json([
            'status' => 'success',
            'newStatus' => $user->userStatus
        ]);
    }
}
