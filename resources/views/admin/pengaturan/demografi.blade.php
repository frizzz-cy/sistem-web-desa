@extends('layouts.admin', ['activePage' => 'pengaturan-demografi'])

@section('title', 'Data Demografi & Monografi')

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
        .demo-category-box {
            background: #F8FAFC;
            border: 1.5px solid #CBD5E1;
            border-radius: 10px;
            padding: 18px;
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="admin-box">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
            <div>
                <h1 style="margin: 0; font-size: 22px; color: var(--biru-tua); font-weight: 800;">📊 Data Demografi &amp; Kependudukan</h1>
                <p style="margin: 4px 0 0; font-size: 13px; color: var(--teks-muted);">Kelola indikator monografi penduduk, kelompok usia, mata pencaharian, kesejahteraan, dan sarana desa.</p>
            </div>
            <a href="/#modal-demografi" class="btn btn-secondary" target="_blank">Lihat di Web ↗</a>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="/admin/pengaturan/demografi" method="POST">
            @csrf

            <div class="setting-section">
                <div class="section-header">
                    <span>Indikator Statistik Kependudukan (Form Pasangan Nama &amp; Nilai)</span>
                </div>
                <p style="margin-top:0; margin-bottom:20px; font-size:12.5px; color:var(--teks-muted);">Anda dapat menambah atau mengurangi indikator secara fleksibel pada setiap kelompok kategori.</p>

                @php $dm = $data_demografi ?? []; @endphp

                <!-- 1. DATA POKOK KEPENDUDUKAN -->
                <div class="demo-category-box">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                        <h4 style="margin:0; font-size:14px; color:var(--biru-tua); font-weight:800;">1. Data Pokok Kependudukan (4 Kartu Utama)</h4>
                        <button type="button" onclick="tambahDemoRow('pokok')" style="font-size:11.5px; padding:5px 12px; background:#E0F2FE; color:#0369A1; border:1px solid #BAE6FD; border-radius:6px; font-weight:700; cursor:pointer;">
                            + Tambah Indikator
                        </button>
                    </div>
                    <div id="container-demo-pokok" style="display:flex; flex-direction:column; gap:8px;">
                        @foreach($dm['pokok'] ?? [] as $item)
                            <div class="dynamic-item-row" style="display:flex; align-items:center; gap:8px;">
                                <input type="text" name="demo_pokok_label[]" value="{{ $item['label'] ?? '' }}" placeholder="Nama Indikator (misal: Total Penduduk)" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px;" required>
                                <input type="text" name="demo_pokok_nilai[]" value="{{ $item['nilai'] ?? '' }}" placeholder="Nilai (misal: 2.113)" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                                <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 2. KOMPOSISI KELOMPOK USIA -->
                <div class="demo-category-box">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                        <h4 style="margin:0; font-size:14px; color:#0B3B60; font-weight:800;">2. Komposisi Kelompok Usia Penduduk</h4>
                        <button type="button" onclick="tambahDemoRow('usia')" style="font-size:11.5px; padding:5px 12px; background:#E0F2FE; color:#0369A1; border:1px solid #BAE6FD; border-radius:6px; font-weight:700; cursor:pointer;">
                            + Tambah Kelompok Usia
                        </button>
                    </div>
                    <div id="container-demo-usia" style="display:flex; flex-direction:column; gap:8px;">
                        @foreach($dm['usia'] ?? [] as $item)
                            <div class="dynamic-item-row" style="display:flex; align-items:center; gap:8px;">
                                <input type="text" name="demo_usia_label[]" value="{{ $item['label'] ?? '' }}" placeholder="Rentang Usia (misal: Usia Balita 0 - 4 Thn)" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px;" required>
                                <input type="text" name="demo_usia_nilai[]" value="{{ $item['nilai'] ?? '' }}" placeholder="Jumlah (misal: 145 Orang)" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                                <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 3. MATA PENCAHARIAN & KETENAGAKERJAAN -->
                <div class="demo-category-box">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                        <h4 style="margin:0; font-size:14px; color:#1668A3; font-weight:800;">3. Mata Pencaharian &amp; Ketenagakerjaan</h4>
                        <button type="button" onclick="tambahDemoRow('pekerjaan')" style="font-size:11.5px; padding:5px 12px; background:#E0F2FE; color:#0369A1; border:1px solid #BAE6FD; border-radius:6px; font-weight:700; cursor:pointer;">
                            + Tambah Pekerjaan
                        </button>
                    </div>
                    <div id="container-demo-pekerjaan" style="display:flex; flex-direction:column; gap:8px;">
                        @foreach($dm['pekerjaan'] ?? [] as $item)
                            <div class="dynamic-item-row" style="display:flex; align-items:center; gap:8px;">
                                <input type="text" name="demo_pekerjaan_label[]" value="{{ $item['label'] ?? '' }}" placeholder="Profesi / Bidang Ketenagakerjaan" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px;" required>
                                <input type="text" name="demo_pekerjaan_nilai[]" value="{{ $item['nilai'] ?? '' }}" placeholder="Jumlah Jiwa (misal: 986 Orang)" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                                <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 4. TINGKAT KESEJAHTERAAN KELUARGA (KK) -->
                <div class="demo-category-box">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                        <h4 style="margin:0; font-size:14px; color:#D4A017; font-weight:800;">4. Tingkat Kesejahteraan Keluarga (KK)</h4>
                        <button type="button" onclick="tambahDemoRow('kesejahteraan')" style="font-size:11.5px; padding:5px 12px; background:#FEF3C7; color:#B45309; border:1px solid #FDE68A; border-radius:6px; font-weight:700; cursor:pointer;">
                            + Tambah Kategori KK
                        </button>
                    </div>
                    <div id="container-demo-kesejahteraan" style="display:flex; flex-direction:column; gap:8px;">
                        @foreach($dm['kesejahteraan'] ?? [] as $item)
                            <div class="dynamic-item-row" style="display:flex; align-items:center; gap:8px;">
                                <input type="text" name="demo_kesejahteraan_label[]" value="{{ $item['label'] ?? '' }}" placeholder="Tingkat Kesejahteraan (misal: KK Prasejahtera)" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px;" required>
                                <input type="text" name="demo_kesejahteraan_nilai[]" value="{{ $item['nilai'] ?? '' }}" placeholder="Jumlah KK (misal: 450 KK)" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                                <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 5. SARANA, PENDIDIKAN, AGAMA & PETERNAKAN -->
                <div class="demo-category-box">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                        <h4 style="margin:0; font-size:14px; color:#047857; font-weight:800;">5. Sarana, Pendidikan, Agama &amp; Peternakan</h4>
                        <button type="button" onclick="tambahDemoRow('pendidikan_ternak')" style="font-size:11.5px; padding:5px 12px; background:#D1FAE5; color:#047857; border:1px solid #A7F3D0; border-radius:6px; font-weight:700; cursor:pointer;">
                            + Tambah Data Fasilitas / Ternak
                        </button>
                    </div>
                    <div id="container-demo-pendidikan_ternak" style="display:flex; flex-direction:column; gap:8px;">
                        @foreach($dm['pendidikan_ternak'] ?? [] as $item)
                            <div class="dynamic-item-row" style="display:flex; align-items:center; gap:8px;">
                                <input type="text" name="demo_pendidikan_ternak_label[]" value="{{ $item['label'] ?? '' }}" placeholder="Fasilitas / Agama / Ternak" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px;" required>
                                <input type="text" name="demo_pendidikan_ternak_nilai[]" value="{{ $item['nilai'] ?? '' }}" placeholder="Jumlah / Populasi (misal: 450 Ekor)" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                                <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Submit Floating Bar / Bottom Action -->
            <div style="background: #F8FAFC; border: 1.5px solid var(--border); padding: 18px 24px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-top: 10px;">
                <span style="font-size: 13px; color: var(--teks-muted);">Periksa kembali angka statistik sebelum menyimpan.</span>
                <button type="submit" class="btn btn-primary" style="padding: 12px 28px; font-size: 14.5px;">
                    Simpan Data Demografi
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function hapusItemBox(btn) {
            const row = btn.closest('.dynamic-item-row');
            if (row) {
                row.remove();
            }
        }

        function tambahDemoRow(category) {
            const container = document.getElementById('container-demo-' + category);
            if (!container) return;

            let placeholderLabel = "Nama Indikator";
            let placeholderNilai = "Jumlah / Nilai";

            if (category === 'pokok') {
                placeholderLabel = "Nama Indikator (misal: Total Balita)";
                placeholderNilai = "Nilai (misal: 145 Jiwa)";
            } else if (category === 'usia') {
                placeholderLabel = "Kelompok Usia (misal: Usia 15 - 24 Thn)";
                placeholderNilai = "Jumlah (misal: 250 Orang)";
            } else if (category === 'pekerjaan') {
                placeholderLabel = "Jenis Pekerjaan (misal: Wiraswasta)";
                placeholderNilai = "Jumlah Jiwa (misal: 80 Orang)";
            } else if (category === 'kesejahteraan') {
                placeholderLabel = "Kategori Kesejahteraan (misal: KK Mandiri)";
                placeholderNilai = "Jumlah KK (misal: 120 KK)";
            } else if (category === 'pendidikan_ternak') {
                placeholderLabel = "Fasilitas / Agama / Hewan Ternak";
                placeholderNilai = "Jumlah / Populasi (misal: 100 Ekor)";
            }

            const div = document.createElement('div');
            div.className = 'dynamic-item-row';
            div.style = 'display:flex; align-items:center; gap:8px;';
            div.innerHTML = `
                <input type="text" name="demo_${category}_label[]" placeholder="${placeholderLabel}" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px;" required>
                <input type="text" name="demo_${category}_nilai[]" placeholder="${placeholderNilai}" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
            `;
            container.appendChild(div);
        }
    </script>
@endsection
