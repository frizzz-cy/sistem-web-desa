@extends('layouts.admin', ['activePage' => 'user'])

@section('title', 'Tambah User')

@section('content')
    <div class="admin-box" style="max-width: 600px; margin: 0 auto;">
        <h2 style="margin-top:0; margin-bottom: 20px; color: var(--biru-tua); font-weight: 800;">Tambah User Pengelola</h2>
        <form action="/admin/user" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Budi Santoso">
                @error('name') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Username (Digunakan untuk login)</label>
                <input type="text" name="username" value="{{ old('username') }}" required placeholder="Contoh: budi123">
                @error('username') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="Contoh: budi@munungkerep.desa.id">
                @error('email') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Peran Pengguna (Role / Hak Akses)</label>
                <select name="role" required style="width: 100%; padding: 10px 14px; border: 1.5px solid #CBD5E1; border-radius: 6px; font-family: inherit; font-size: 13.5px; background: #fff;">
                    <option value="kontributor" {{ old('role', 'kontributor') == 'kontributor' ? 'selected' : '' }}>
                        ✍️ Kontributor / Pemuda (Hanya Berita, Galeri Kegiatan, UMKM, & Media)
                    </option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                        👑 Administrator Desa (Akses Penuh Seluruh Sistem & Pengaturan)
                    </option>
                </select>
                <small style="color: #64748B; display: block; margin-top: 4px;">Akun kontributor cocok untuk pemuda/karang taruna yang bertugas mengisi rilis berita dan foto kegiatan.</small>
                @error('role') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Password (Minimal 6 karakter)</label>
                <input type="password" name="password" required placeholder="Masukkan password pengelola">
                @error('password') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required placeholder="Ketik ulang password">
            </div>
            
            <div style="margin-top: 28px; display: flex; gap: 10px;">
                <a href="/admin/user" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan User</button>
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
