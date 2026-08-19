@extends('layouts.admin', ['activePage' => 'user'])

@section('title', 'Edit User')

@section('content')
    <div class="admin-box" style="max-width: 600px; margin: 0 auto;">
        <h2 style="margin-top:0; margin-bottom: 20px; color: var(--biru-tua); font-weight: 800;">Edit User Pengelola</h2>
        <form action="/admin/user/{{ $user->id }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required placeholder="Contoh: Budi Santoso">
                @error('name') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" required placeholder="Contoh: budi123">
                @error('username') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Alamat Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required placeholder="Contoh: budi@munungkerep.desa.id">
                @error('email') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Peran Pengguna (Role / Hak Akses)</label>
                <select name="role" required style="width: 100%; padding: 10px 14px; border: 1.5px solid #CBD5E1; border-radius: 6px; font-family: inherit; font-size: 13.5px; background: #fff;">
                    <option value="kontributor" {{ old('role', $user->role) == 'kontributor' ? 'selected' : '' }}>
                        ✍️ Kontributor / Pemuda (Hanya Berita, Galeri Kegiatan, UMKM, & Media)
                    </option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                        👑 Administrator Desa (Akses Penuh Seluruh Sistem & Pengaturan)
                    </option>
                </select>
                @if($user->id === auth()->id())
                    <small style="color: #0284C7; display: block; margin-top: 4px;">ℹ️ Anda sedang mengedit akun Anda sendiri yang sedang aktif.</small>
                @endif
                @error('role') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group" style="margin-top: 24px; border-top: 1px dashed #E2E8F0; padding-top: 16px;">
                <label style="margin-bottom: 2px;">Ganti Password</label>
                <span style="font-size: 12px; color: var(--teks-muted); display: block; margin-bottom: 10px;">Biarkan kolom password kosong jika tidak ingin mengganti password lama.</span>
                <input type="password" name="password" placeholder="Masukkan password baru jika ingin diganti">
                @error('password') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" placeholder="Ketik ulang password baru">
            </div>
            
            <div style="margin-top: 28px; display: flex; gap: 10px;">
                <a href="/admin/user" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update User</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <!-- Script Prevent Double Submit -->
    <script>
        document.querySelector('form').addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Menyimpan...';
                submitBtn.style.opacity = '0.7';
                submitBtn.style.cursor = 'not-allowed';
            }
        });
    </script>
@endsection
