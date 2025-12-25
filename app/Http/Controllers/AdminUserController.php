<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Lecturer;
use App\Models\Admin;
use App\Models\MembershipTransaction;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()
            ->where('id', '!=', auth()->id());

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

        $activeTab = $request->userStatus ?? 'all';
        return view('admin.user.userList', compact('users','activeTab'));
    }

    public function userStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role'           => ['required', 'in:lecturer,admin'],
            'name'           => ['required', 'string', 'min:5', 'max:20'],
            'email'          => ['required', 'email', 'max:255', 'unique:users,email'],
            'phoneNumber'    => ['required', 'regex:/^\+[0-9]{12,16}$/'],
            'password'       => ['required', 'string', 'min:8', 'confirmed'],
            'specialization' => ['required_if:role,lecturer', 'string'],
            'profilePicture'          => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048','required_if:role,lecturer'],
        ], [
            'role.required' => 'Role wajib dipilih.',
            'role.in' => 'Role tidak valid.',

            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.min' => 'Nama minimal 5 karakter.',
            'name.max' => 'Nama maksimal 20 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'email.unique' => 'Email sudah terdaftar.',

            'phoneNumber.required' => 'Nomor telepon wajib diisi.',
            'phoneNumber.regex' => 'Nomor telepon harus diawali + dan berisi 13–16 karakter angka.',

            'password.required' => 'Kata sandi wajib diisi.',
            'password.string' => 'Kata sandi harus berupa teks.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',

            'specialization.required_if' => 'Keahlian wajib diisi untuk role tutor.',
            'specialization.string' => 'Keahlian harus berupa teks.',

            'profilePicture.required_if' => 'Foto profil wajib diunggah untuk role tutor.',
            'profilePicture.image' => 'File harus berupa gambar.',
            'profilePicture.mimes' => 'Format gambar harus jpg, jpeg, atau png.',
            'profilePicture.max' => 'Ukuran gambar maksimal 2 MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $filePath = null;
        $originalName = null;

        if ($request->role === 'lecturer') {
            $originalName = $request->file('profilePicture')->getClientOriginalName();

            $filePath = $request->file('profilePicture')->storeAs(
                'profile_pictures',
                time() . '_' . $originalName,
                's3'
            );
        }

        $data = [
            'name'        => $request->name,
            'email'       => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'password'    => Hash::make($request->password),
            'role'        => $request->role,
            'userStatus'  => 'active',
            'profilePicture' => $filePath,
        ];

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

        return redirect()->back()->with('success', 'Berhasil menambahkan pengguna!');
    }

    public function detail($userId)
    {
        $user = User::with('lecturer')->findOrFail($userId);
        $membershipTransaction = MembershipTransaction::where('studentId', $user->id)
            ->where('membershipStatus', 'active')
            ->with('membership')
            ->first();

        $membershipStatus = $membershipTransaction?->membershipStatus ?? 'belum berlangganan';

        return view('admin.user.detail-user', compact('user', 'membershipTransaction', 'membershipStatus'));
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
