<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.user.index', compact('users'));
    }

    // Menampilkan form tambah user
    public function create()
    {
        return view('admin.user.create');
    }

    // Menyimpan user pengelola baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email'    => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
            ],
            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.regex' => 'Format email tidak valid. Email harus menyertakan domain lengkap (contoh: nama@domain.com).'
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect('/admin/user')->with('success', 'User pengelola baru berhasil ditambahkan!');
    }

    // Menampilkan form edit user
    public function edit(User $user)
    {
        // Proteksi: User non-SuperAdmin tidak boleh mengedit akun Super Admin
        if ($this->isProtectedSuperAdmin($user) && !$this->isCurrentSuperAdmin()) {
            return redirect('/admin/user')->with('error', 'DITOLAK! Anda tidak memiliki izin untuk mengedit akun Super Administrator.');
        }

        return view('admin.user.edit', compact('user'));
    }

    // Memperbarui data user pengelola
    public function update(Request $request, User $user)
    {
        // Proteksi: User non-SuperAdmin tidak boleh memperbarui akun Super Admin
        if ($this->isProtectedSuperAdmin($user) && !$this->isCurrentSuperAdmin()) {
            return redirect('/admin/user')->with('error', 'DITOLAK! Anda tidak memiliki izin untuk mengubah data Super Administrator.');
        }

        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email'    => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
            ],
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'email.regex' => 'Format email tidak valid. Email harus menyertakan domain lengkap (contoh: nama@domain.com).'
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect('/admin/user')->with('success', 'Data user pengelola berhasil diperbarui!');
    }

    // Menghapus user pengelola
    public function destroy(User $user)
    {
        // 1. Proteksi: Akun Super Admin TIDAK BISA dihapus oleh siapapun
        if ($this->isProtectedSuperAdmin($user)) {
            return back()->with('error', 'DITOLAK! Akun Super Administrator dilindungi dan TIDAK DAPAT dihapus oleh siapapun.');
        }

        // 2. Proteksi: Hanya Super Admin yang boleh menghapus user lain
        if (!$this->isCurrentSuperAdmin()) {
            return back()->with('error', 'DITOLAK! Hanya Super Administrator yang memiliki kewenangan menghapus user pengelola.');
        }

        // 3. Proteksi agar admin tidak menghapus dirinya sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Gagal! Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif.');
        }

        $user->delete();

        return redirect('/admin/user')->with('success', 'User pengelola berhasil dihapus!');
    }

    /**
     * Helper cek apakah target user adalah Super Admin yang dilindungi
     */
    protected function isProtectedSuperAdmin(User $user): bool
    {
        return $user->username === 'adm_mnk_9472_x9' || $user->id === 1;
    }

    /**
     * Helper cek apakah user yang sedang login adalah Super Admin
     */
    protected function isCurrentSuperAdmin(): bool
    {
        $current = auth()->user();
        return $current && ($current->username === 'adm_mnk_9472_x9' || $current->id === 1);
    }
}
