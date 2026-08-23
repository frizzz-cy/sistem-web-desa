@extends('layouts.admin', ['activePage' => 'pengaturan-potensi'])

@section('title', 'Potensi Ekonomi Desa')

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
        .commodity-card {
            border: 1.5px solid #E2E8F0;
            border-radius: 10px;
            padding: 22px;
            background: #F8FAFC;
            margin-bottom: 24px;
        }
    </style>
@endsection

@section('content')
    <div class="admin-box">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
            <div>
                <h1 style="margin: 0; font-size: 22px; color: var(--biru-tua); font-weight: 800;">🌾 Potensi Ekonomi &amp; Komoditas Desa</h1>
                <p style="margin: 4px 0 0; font-size: 13px; color: var(--teks-muted);">Kelola informasi komoditas hasil bumi desa, manfaat, produk turunan, dan langkah pengolahan pada halaman Peta &amp; Potensi.</p>
            </div>
            <a href="/peta" class="btn btn-secondary" target="_blank">Lihat di Web Peta ↗</a>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="/admin/pengaturan/potensi" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="setting-section">
                <div class="section-header">3 Komoditas Utama Desa Munungkerep</div>
                <p style="margin-top:0; margin-bottom:20px; font-size:12.5px; color:var(--teks-muted);">Sesuaikan data penjelasan, manfaat, produk olahan, dan foto untuk masing-masing komoditas.</p>
                
                @foreach(['tembakau' => 'Tembakau', 'pandan' => 'Pandan', 'padi' => 'Padi'] as $key => $label)
                    @php $item = $data_potensi[$key] ?? []; @endphp
                    <div class="commodity-card">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:18px; border-bottom:1px solid #E2E8F0; padding-bottom:12px; flex-wrap:wrap; gap:8px;">
                            <div style="background:var(--biru-tua); color:#fff; font-size:12px; font-weight:800; padding:6px 14px; border-radius:6px; text-transform:uppercase; letter-spacing:0.5px;">KOMODITAS: {{ $label }}</div>
                            <span style="font-size:12px; color:var(--teks-muted);">Kode Identifier: <code>{{ $key }}</code></span>
                        </div>
                        
                        <input type="hidden" name="potensi_keys[]" value="{{ $key }}">
                        
                        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:16px; margin-bottom:14px;">
                            <div class="form-group" style="margin-bottom:0;">
                                <label style="font-size:12.5px;">Judul Komoditas</label>
                                <input type="text" name="potensi_judul[]" value="{{ $item['judul'] ?? '' }}" required placeholder="Contoh: Tembakau">
                            </div>
                            <div class="form-group" style="margin-bottom:0;">
                                <label style="font-size:12.5px;">Tag / Kategori Label</label>
                                <input type="text" name="potensi_tag[]" value="{{ $item['tag'] ?? '' }}" required placeholder="Contoh: Komoditas Utama">
                            </div>
                        </div>

                        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:16px; margin-bottom:14px;">
                            <div class="form-group" style="margin-bottom:0;">
                                <label style="font-size:12.5px;">Upload Foto Komoditas (Opsional)</label>
                                <div style="display: flex; gap: 8px; align-items: center;">
                                    <input type="file" name="potensi_foto_{{ $key }}" accept="image/*" style="font-size:12px; flex:1;">
                                    <button type="button" class="btn btn-secondary" onclick="pilihFotoPotensiDariMedia('{{ $key }}', this)" style="font-size: 11px; padding: 6px 10px; white-space: nowrap;">
                                        📁 Media
                                    </button>
                                </div>
                                <input type="hidden" name="potensi_foto_media_{{ $key }}" id="potensi_media_{{ $key }}">
                                <div id="preview_box_{{ $key }}" style="margin-top:6px; font-size:11.5px; color:var(--teks-muted);">
                                    @if(!empty($item['foto'][0]))
                                        Foto saat ini: <a href="{{ $item['foto'][0] }}" target="_blank" style="color:var(--biru); text-decoration:underline; font-weight:600;">Lihat Foto ↗</a>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom:0;">
                                <label style="font-size:12.5px;">Catatan Data Tambahan (Opsional)</label>
                                <input type="text" name="potensi_catatan[]" value="{{ $item['catatan'] ?? '' }}" placeholder="Contoh: Luas lahan, titik sebaran...">
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom:14px;">
                            <label style="font-size:12.5px;">Deskripsi / Narasi Ringkasan Komoditas</label>
                            <textarea name="potensi_isi[]" rows="3" required placeholder="Tulis deskripsi penjelasan komoditas...">{{ $item['isi'] ?? '' }}</textarea>
                        </div>

                        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:16px; margin-bottom:14px;">
                            <div class="form-group" style="margin-bottom:0;">
                                <label style="font-size:12.5px;">Daftar Manfaat (Tulis 1 poin per baris)</label>
                                <textarea name="potensi_manfaat[]" rows="5" required placeholder="Poin 1&#10;Poin 2&#10;Poin 3...">{{ isset($item['manfaat']) ? implode("\n", $item['manfaat']) : '' }}</textarea>
                            </div>
                            <div class="form-group" style="margin-bottom:0;">
                                <label style="font-size:12.5px;">Langkah / Cara Pengolahan (Tulis 1 langkah per baris)</label>
                                <textarea name="potensi_cara[]" rows="5" required placeholder="Langkah 1&#10;Langkah 2&#10;Langkah 3...">{{ isset($item['cara']) ? implode("\n", $item['cara']) : '' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom:0;">
                            <label style="font-size:12.5px;">Daftar Produk Olahan / Turunan (Pisahkan dengan tanda koma)</label>
                            <input type="text" name="potensi_produk[]" value="{{ isset($item['produk']) ? implode(", ", $item['produk']) : '' }}" placeholder="Contoh: Rajangan, Cerutu, Lintingan, Pupuk Kompos" required>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Submit Floating Bar / Bottom Action -->
            <div style="background: #F8FAFC; border: 1.5px solid var(--border); padding: 18px 24px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-top: 10px;">
                <span style="font-size: 13px; color: var(--teks-muted);">Periksa kembali formulir komoditas sebelum menyimpan.</span>
                <button type="submit" class="btn btn-primary" style="padding: 12px 28px; font-size: 14.5px;">
                    Simpan Potensi Ekonomi
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function pilihFotoPotensiDariMedia(key, btn) {
            window.openMediaPicker({
                onSelect: function(item) {
                    document.getElementById('potensi_media_' + key).value = item.url;
                    const previewBox = document.getElementById('preview_box_' + key);
                    if (previewBox) {
                        previewBox.innerHTML = `<span style="color: #16A34A; font-weight:700;">✓ Terpilih:</span> <a href="${item.url}" target="_blank" style="color:var(--biru); text-decoration:underline;">${item.name} ↗</a>`;
                    }
                    const fileInput = btn.parentElement.querySelector('input[type="file"]');
                    if (fileInput) fileInput.value = '';
                }
            });
        }
    </script>
@endsection
