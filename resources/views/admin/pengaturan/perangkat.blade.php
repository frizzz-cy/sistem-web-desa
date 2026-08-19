@extends('layouts.admin', ['activePage' => 'pengaturan-perangkat'])

@section('title', 'Struktur Perangkat Desa')

@section('styles')
    <style>
        .setting-section {
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            padding: 24px;
            background: #FFF;
            margin-bottom: 28px;
        }
        .section-header {
            font-size: 15px;
            font-weight: 800;
            color: var(--biru-tua);
            margin-top: 0;
            margin-bottom: 18px;
            border-bottom: 2px solid var(--border);
            padding-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .perangkat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }
        .perangkat-card {
            border: 1.5px solid #E2E8F0;
            border-radius: 10px;
            padding: 20px;
            background: #F8FAFC;
        }
    </style>
@endsection

@section('content')
    <div class="admin-box">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
            <div>
                <h1 style="margin: 0; font-size: 22px; color: var(--biru-tua); font-weight: 800;">👥 Struktur Organisasi &amp; Perangkat Desa</h1>
                <p style="margin: 4px 0 0; font-size: 13px; color: var(--teks-muted);">Kelola nama pejabat, foto resmi, jabatan, dan uraian tugas 12 posisi perangkat desa untuk bagan organogram.</p>
            </div>
            <a href="/profil-desa#pemerintahan" class="btn btn-secondary" target="_blank">Lihat Organogram Web ↗</a>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="/admin/pengaturan/perangkat" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="setting-section">
                <div class="section-header">12 Posisi Aparatur Pemerintahan Desa</div>
                <p style="margin-top:0; margin-bottom:20px; font-size:12.5px; color:var(--teks-muted);">Perubahan foto dan data di bawah ini akan langsung mengupdate bagan struktur organisasi di halaman Profil Desa secara otomatis.</p>
                
                <div class="perangkat-grid">
                    @foreach($data_perangkat as $key => $item)
                        <div class="perangkat-card">
                            <input type="hidden" name="perangkat_keys[]" value="{{ $key }}">
                            <div style="display:flex; align-items:center; gap:12px; margin-bottom:14px;">
                                <img src="{{ $item['foto'] ?? '/images/perangkat/avatar.png' }}" style="width:54px; height:54px; border-radius:50%; object-fit:cover; border:2px solid var(--biru-tua);" alt="Foto {{ $item['nama'] }}">
                                <div>
                                    <span style="font-size:10.5px; font-weight:800; background:#E0F2FE; color:#0369A1; padding:3px 8px; border-radius:4px; text-transform:uppercase;">POSISI: {{ strtoupper($key) }}</span>
                                    <h4 style="margin:4px 0 0; font-size:13.5px; color:var(--biru-tua);">{{ $item['jabatan'] }}</h4>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <label style="font-size:12px;">Jabatan Resmi</label>
                                <input type="text" name="perangkat_jabatan[]" value="{{ old('perangkat_jabatan.'.$loop->index, $item['jabatan']) }}" required>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <label style="font-size:12px;">Nama Lengkap Pejabat</label>
                                <input type="text" name="perangkat_nama[]" value="{{ old('perangkat_nama.'.$loop->index, $item['nama']) }}" required>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <label style="font-size:12px;">Upload Foto Pejabat (Opsional)</label>
                                <input type="file" name="perangkat_foto_{{ $key }}" accept="image/*" style="font-size:12px;">
                            </div>

                            <div class="form-group" style="margin-bottom:0;">
                                <label style="font-size:12px;">Profil Singkat / Uraian Tugas Pokok</label>
                                <textarea name="perangkat_note[]" rows="3" required placeholder="Tulis profil singkat atau deskripsi tugas...">{{ old('perangkat_note.'.$loop->index, $item['note']) }}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Submit Floating Bar / Bottom Action -->
            <div style="background: #F8FAFC; border: 1.5px solid var(--border); padding: 18px 24px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-top: 10px;">
                <span style="font-size: 13px; color: var(--teks-muted);">Periksa kembali data perangkat sebelum menyimpan.</span>
                <button type="submit" class="btn btn-primary" style="padding: 12px 28px; font-size: 14.5px;">
                    Simpan Struktur Perangkat
                </button>
            </div>
        </form>
    </div>
@endsection
