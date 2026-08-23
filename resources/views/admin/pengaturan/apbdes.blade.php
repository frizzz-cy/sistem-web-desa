@extends('layouts.admin', ['activePage' => 'pengaturan-apbdes'])

@section('title', 'Transparansi APBDes')

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
    </style>
@endsection

@section('content')
    <div class="admin-box">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
            <div>
                <h1 style="margin: 0; font-size: 22px; color: var(--biru-tua); font-weight: 800;">💰 Transparansi Anggaran (APBDes)</h1>
                <p style="margin: 4px 0 0; font-size: 13px; color: var(--teks-muted);">Kelola data transparansi APBDes multi-tahun, rincian pendapatan, belanja, dan pembiayaan desa.</p>
            </div>
            <div style="display: flex; gap: 10px; align-items: center;">
                <button type="button" class="btn btn-secondary" onclick="tambahTahunApbdes()" style="font-size: 13px; padding: 9px 16px; background: #E0F2FE; color: #0369A1; border: 1px solid #BAE6FD; font-weight: 700;">
                    + Tambah Tahun Anggaran Baru
                </button>
                <a href="/#modal-informasi" class="btn btn-secondary" target="_blank">Lihat di Web ↗</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="/admin/pengaturan/apbdes" method="POST">
            @csrf

            <div class="setting-section">
                <div class="section-header" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:8px;">
                    <span>Daftar Tahun Anggaran &amp; Rincian Pos APBDes</span>
                    <span style="font-size: 12px; font-weight: normal; color: var(--teks-muted); text-transform: none;">Tahun terbaru otomatis diurutkan paling atas</span>
                </div>

                <div id="apbdes-years-container" style="display:flex; flex-direction:column; gap:28px;">
                    @php $ap_list = $data_apbdes ?? []; @endphp
                    @foreach($ap_list as $thnKey => $ap)
                        @php $yearIdx = $loop->index; @endphp
                        <div class="apbdes-year-card" data-year-idx="{{ $yearIdx }}" style="border: 1.5px solid #CBD5E1; border-radius: 12px; padding: 20px; background: #F8FAFC; position: relative;">
                            <!-- Header Tahun -->
                            <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px; margin-bottom:16px; border-bottom:1px solid #E2E8F0; padding-bottom:12px;">
                                <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                                    <span style="background:var(--biru-tua); color:#fff; font-size:12px; font-weight:800; padding:4px 10px; border-radius:6px; letter-spacing:0.5px;">TAHUN ANGGARAN</span>
                                    <input type="text" name="apbdes_tahun[]" value="{{ $ap['tahun'] ?? $thnKey }}" style="width:100px; font-weight:800; font-size:15px; text-align:center; padding:5px 8px; border:1.5px solid #94A3B8; border-radius:6px; background:#FFF;" required placeholder="Contoh: 2026">
                                    
                                    <select name="apbdes_status[]" style="font-size:12.5px; padding:6px 10px; border-radius:6px; border:1px solid #CBD5E1; font-weight:600; background:#FFF; color:#334155;">
                                        <option value="Murni (Tahun Berjalan)" {{ ($ap['status'] ?? '') === 'Murni (Tahun Berjalan)' || ($ap['status'] ?? '') === 'Murni (Berjalan)' ? 'selected' : '' }}>🟢 Murni (Tahun Berjalan)</option>
                                        <option value="Laporan Realisasi / LPJ" {{ ($ap['status'] ?? '') === 'Laporan Realisasi / LPJ' ? 'selected' : '' }}>🔵 Laporan Realisasi / LPJ</option>
                                        <option value="Perubahan (P-APBDes)" {{ ($ap['status'] ?? '') === 'Perubahan (P-APBDes)' ? 'selected' : '' }}>🟠 Perubahan (P-APBDes)</option>
                                    </select>
                                </div>
                                <button type="button" onclick="hapusTahunApbdes(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; padding:6px 12px; font-size:12px; font-weight:700; cursor:pointer;">
                                    Hapus Tahun Ini
                                </button>
                            </div>

                            <!-- 1. PENDAPATAN DESA -->
                            <div style="background:#FFF; border:1px solid #BAE6FD; border-left:4px solid #0284C7; border-radius:8px; padding:16px; margin-bottom:16px;">
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; flex-wrap:wrap; gap:8px;">
                                    <h4 style="margin:0; font-size:14px; color:#0369A1;">1. Pendapatan Desa &amp; Sumber Dana</h4>
                                    <button type="button" onclick="tambahItemBox('pendapatan', {{ $yearIdx }})" style="font-size:11.5px; padding:4px 10px; background:#E0F2FE; color:#0369A1; border:1px solid #BAE6FD; border-radius:6px; font-weight:700; cursor:pointer;">
                                        + Tambah Pos Pendapatan
                                    </button>
                                </div>

                                <div class="form-group" style="margin-bottom:12px;">
                                    <label style="font-size:12px; font-weight:700; color:#0369A1;">Total Pendapatan Desa (Header Total)</label>
                                    <input type="text" name="apbdes_pendapatan_total[]" value="{{ $ap['pendapatan_total'] ?? 'Rp 0,00' }}" required>
                                </div>

                                <div class="item-boxes-container" id="container-pendapatan-{{ $yearIdx }}" style="display:flex; flex-direction:column; gap:8px; margin-bottom:12px;">
                                    @php $p_items = $ap['pendapatan_items'] ?? []; @endphp
                                    @foreach($p_items as $item)
                                        <div class="dynamic-item-row" style="background:#FFF; border:1px solid #E2E8F0; border-radius:8px; padding:10px 12px;">
                                            <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px;">
                                                <input type="text" name="apbdes_pendapatan_label_{{ $yearIdx }}[]" value="{{ $item['label'] ?? '' }}" placeholder="Nama Pos Utama (Tulisan Besar)" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                                                <input type="text" name="apbdes_pendapatan_nilai_{{ $yearIdx }}[]" value="{{ $item['nilai'] ?? '' }}" placeholder="Nominal (misal: Rp 0,00)" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:700;" required>
                                                <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
                                            </div>
                                            <div style="display:flex; align-items:center; gap:6px;">
                                                <span style="font-size:11px; color:#64748B; font-weight:700; white-space:nowrap;">↳ Sub-keterangan (opsional):</span>
                                                <input type="text" name="apbdes_pendapatan_sub_{{ $yearIdx }}[]" value="{{ $item['sub'] ?? '' }}" placeholder="Tulisan kecil di bawah judul (opsional / boleh dikosongkan)" style="flex:1; font-size:11.5px; padding:5px 8px; border:1px dashed #CBD5E1; border-radius:4px; color:#475569; background:#FAFAFA;">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group" style="margin-bottom:0;">
                                    <label style="font-size:12px;">Catatan Keterangan Sumber Dana Pendapatan</label>
                                    <textarea name="apbdes_keterangan_pendapatan[]" rows="2" required placeholder="Jelaskan dari mana saja dana pendapatan desa berasal...">{{ $ap['keterangan_pendapatan'] ?? '' }}</textarea>
                                </div>
                            </div>

                            <!-- 2. BELANJA DESA -->
                            <div style="background:#FFF; border:1px solid #FECACA; border-left:4px solid #EF4444; border-radius:8px; padding:16px; margin-bottom:16px;">
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; flex-wrap:wrap; gap:8px;">
                                    <h4 style="margin:0; font-size:14px; color:#B91C1C;">2. Belanja Desa &amp; Alokasi Bidang</h4>
                                    <button type="button" onclick="tambahItemBox('belanja', {{ $yearIdx }})" style="font-size:11.5px; padding:4px 10px; background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; font-weight:700; cursor:pointer;">
                                        + Tambah Pos Belanja
                                    </button>
                                </div>

                                <div class="form-group" style="margin-bottom:12px;">
                                    <label style="font-size:12px; font-weight:700; color:#B91C1C;">Total Belanja Desa (Header Total)</label>
                                    <input type="text" name="apbdes_belanja_total[]" value="{{ $ap['belanja_total'] ?? 'Rp 0,00' }}" required>
                                </div>

                                <div class="item-boxes-container" id="container-belanja-{{ $yearIdx }}" style="display:flex; flex-direction:column; gap:8px; margin-bottom:12px;">
                                    @php $b_items = $ap['belanja_items'] ?? []; @endphp
                                    @foreach($b_items as $item)
                                        <div class="dynamic-item-row" style="background:#FFF; border:1px solid #E2E8F0; border-radius:8px; padding:10px 12px;">
                                            <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px;">
                                                <input type="text" name="apbdes_belanja_label_{{ $yearIdx }}[]" value="{{ $item['label'] ?? '' }}" placeholder="Nama Pos Belanja (Tulisan Besar)" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                                                <input type="text" name="apbdes_belanja_nilai_{{ $yearIdx }}[]" value="{{ $item['nilai'] ?? '' }}" placeholder="Nominal (misal: Rp 0,00)" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:700;" required>
                                                <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
                                            </div>
                                            <div style="display:flex; align-items:center; gap:6px;">
                                                <span style="font-size:11px; color:#64748B; font-weight:700; white-space:nowrap;">↳ Sub-keterangan (opsional):</span>
                                                <input type="text" name="apbdes_belanja_sub_{{ $yearIdx }}[]" value="{{ $item['sub'] ?? '' }}" placeholder="Tulisan kecil di bawah judul (opsional / boleh dikosongkan)" style="flex:1; font-size:11.5px; padding:5px 8px; border:1px dashed #CBD5E1; border-radius:4px; color:#475569; background:#FAFAFA;">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group" style="margin-bottom:0;">
                                    <label style="font-size:12px;">Catatan Keterangan Alokasi Belanja</label>
                                    <textarea name="apbdes_keterangan_belanja[]" rows="2" required placeholder="Jelaskan untuk apa saja alokasi belanja diprioritaskan...">{{ $ap['keterangan_belanja'] ?? '' }}</textarea>
                                </div>
                            </div>

                            <!-- 3. PEMBIAYAAN DESA -->
                            <div style="background:#FFF; border:1px solid #A7F3D0; border-left:4px solid #10B981; border-radius:8px; padding:16px;">
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; flex-wrap:wrap; gap:8px;">
                                    <h4 style="margin:0; font-size:14px; color:#047857;">3. Pembiayaan Desa (Netto &amp; SiLPA)</h4>
                                    <button type="button" onclick="tambahItemBox('pembiayaan', {{ $yearIdx }})" style="font-size:11.5px; padding:4px 10px; background:#D1FAE5; color:#047857; border:1px solid #A7F3D0; border-radius:6px; font-weight:700; cursor:pointer;">
                                        + Tambah Pos Pembiayaan
                                    </button>
                                </div>

                                <div class="form-group" style="margin-bottom:12px;">
                                    <label style="font-size:12px; font-weight:700; color:#047857;">Total Pembiayaan Netto (Header Total)</label>
                                    <input type="text" name="apbdes_pembiayaan_total[]" value="{{ $ap['pembiayaan_total'] ?? 'Rp 0,00' }}" required>
                                </div>

                                <div class="item-boxes-container" id="container-pembiayaan-{{ $yearIdx }}" style="display:flex; flex-direction:column; gap:8px; margin-bottom:12px;">
                                    @php $pb_items = $ap['pembiayaan_items'] ?? []; @endphp
                                    @foreach($pb_items as $item)
                                        <div class="dynamic-item-row" style="background:#FFF; border:1px solid #E2E8F0; border-radius:8px; padding:10px 12px;">
                                            <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px;">
                                                <input type="text" name="apbdes_pembiayaan_label_{{ $yearIdx }}[]" value="{{ $item['label'] ?? '' }}" placeholder="Nama Pos Pembiayaan (Tulisan Besar)" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                                                <input type="text" name="apbdes_pembiayaan_nilai_{{ $yearIdx }}[]" value="{{ $item['nilai'] ?? '' }}" placeholder="Nominal (misal: Rp 0,00)" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:700;" required>
                                                <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
                                            </div>
                                            <div style="display:flex; align-items:center; gap:6px;">
                                                <span style="font-size:11px; color:#64748B; font-weight:700; white-space:nowrap;">↳ Sub-keterangan (opsional):</span>
                                                <input type="text" name="apbdes_pembiayaan_sub_{{ $yearIdx }}[]" value="{{ $item['sub'] ?? '' }}" placeholder="Tulisan kecil di bawah judul (opsional / boleh dikosongkan)" style="flex:1; font-size:11.5px; padding:5px 8px; border:1px dashed #CBD5E1; border-radius:4px; color:#475569; background:#FAFAFA;">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group" style="margin-bottom:0;">
                                    <label style="font-size:12px;">Catatan Keterangan Pembiayaan</label>
                                    <textarea name="apbdes_keterangan_pembiayaan[]" rows="2" required placeholder="Jelaskan asal usul penerimaan pembiayaan...">{{ $ap['keterangan_pembiayaan'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Submit Floating Bar / Bottom Action -->
            <div style="background: #F8FAFC; border: 1.5px solid var(--border); padding: 18px 24px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-top: 10px;">
                <span style="font-size: 13px; color: var(--teks-muted);">Periksa kembali rincian angka sebelum menyimpan.</span>
                <button type="submit" class="btn btn-primary" style="padding: 12px 28px; font-size: 14.5px;">
                    Simpan Perubahan APBDes
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

        function tambahItemBox(kategori, yearIdx) {
            const container = document.getElementById('container-' + kategori + '-' + yearIdx);
            if (!container) return;

            let placeholderLabel = "Nama Pos Anggaran";
            if (kategori === 'pendapatan') placeholderLabel = "Nama Pos Pendapatan (misal: Bantuan Keuangan)";
            else if (kategori === 'belanja') placeholderLabel = "Nama Pos Belanja (misal: Pembangunan Irigasi)";
            else if (kategori === 'pembiayaan') placeholderLabel = "Nama Pos Pembiayaan (misal: SiLPA Tahun Lalu)";

            const div = document.createElement('div');
            div.className = 'dynamic-item-row';
            div.style = 'background:#FFF; border:1px solid #E2E8F0; border-radius:8px; padding:10px 12px;';
            div.innerHTML = `
                <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px;">
                    <input type="text" name="apbdes_${kategori}_label_${yearIdx}[]" placeholder="${placeholderLabel}" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                    <input type="text" name="apbdes_${kategori}_nilai_${yearIdx}[]" placeholder="Nominal (misal: Rp 0,00)" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:700;" required>
                    <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
                </div>
                <div style="display:flex; align-items:center; gap:6px;">
                    <span style="font-size:11px; color:#64748B; font-weight:700; white-space:nowrap;">↳ Sub-keterangan (opsional):</span>
                    <input type="text" name="apbdes_${kategori}_sub_${yearIdx}[]" placeholder="Tulisan kecil di bawah judul (opsional / boleh dikosongkan)" style="flex:1; font-size:11.5px; padding:5px 8px; border:1px dashed #CBD5E1; border-radius:4px; color:#475569; background:#FAFAFA;">
                </div>
            `;
            container.appendChild(div);
        }

        function hapusTahunApbdes(btn) {
            if (confirm('Apakah Anda yakin ingin menghapus seluruh data APBDes tahun anggaran ini?')) {
                const card = btn.closest('.apbdes-year-card');
                if (card) {
                    card.remove();
                }
            }
        }

        function tambahTahunApbdes() {
            const container = document.getElementById('apbdes-years-container');
            const newYear = prompt('Masukkan Tahun Anggaran Baru (Contoh: 2027):');
            if (!newYear || !newYear.trim()) return;

            const existingCards = container.querySelectorAll('.apbdes-year-card');
            const nextIdx = existingCards.length;

            const card = document.createElement('div');
            card.className = 'apbdes-year-card';
            card.dataset.yearIdx = nextIdx;
            card.style = 'border: 1.5px solid #CBD5E1; border-radius: 12px; padding: 20px; background: #F8FAFC; position: relative;';

            card.innerHTML = `
                <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px; margin-bottom:16px; border-bottom:1px solid #E2E8F0; padding-bottom:12px;">
                    <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                        <span style="background:var(--biru-tua); color:#fff; font-size:12px; font-weight:800; padding:4px 10px; border-radius:6px; letter-spacing:0.5px;">TAHUN ANGGARAN</span>
                        <input type="text" name="apbdes_tahun[]" value="${newYear.trim()}" style="width:100px; font-weight:800; font-size:15px; text-align:center; padding:5px 8px; border:1.5px solid #94A3B8; border-radius:6px; background:#FFF;" required>
                        <select name="apbdes_status[]" style="font-size:12.5px; padding:6px 10px; border-radius:6px; border:1px solid #CBD5E1; font-weight:600; background:#FFF; color:#334155;">
                            <option value="Murni (Tahun Berjalan)">🟢 Murni (Tahun Berjalan)</option>
                            <option value="Laporan Realisasi / LPJ">🔵 Laporan Realisasi / LPJ</option>
                            <option value="Perubahan (P-APBDes)">🟠 Perubahan (P-APBDes)</option>
                        </select>
                    </div>
                    <button type="button" onclick="hapusTahunApbdes(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; padding:6px 12px; font-size:12px; font-weight:700; cursor:pointer;">
                        Hapus Tahun Ini
                    </button>
                </div>

                <!-- 1. PENDAPATAN -->
                <div style="background:#FFF; border:1px solid #BAE6FD; border-left:4px solid #0284C7; border-radius:8px; padding:16px; margin-bottom:16px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; flex-wrap:wrap; gap:8px;">
                        <h4 style="margin:0; font-size:14px; color:#0369A1;">1. Pendapatan Desa &amp; Sumber Dana</h4>
                        <button type="button" onclick="tambahItemBox('pendapatan', ${nextIdx})" style="font-size:11.5px; padding:4px 10px; background:#E0F2FE; color:#0369A1; border:1px solid #BAE6FD; border-radius:6px; font-weight:700; cursor:pointer;">
                            + Tambah Pos Pendapatan
                        </button>
                    </div>
                    <div class="form-group" style="margin-bottom:12px;">
                        <label style="font-size:12px; font-weight:700; color:#0369A1;">Total Pendapatan Desa (Header Total)</label>
                        <input type="text" name="apbdes_pendapatan_total[]" value="Rp 0,00" required>
                    </div>
                    <div class="item-boxes-container" id="container-pendapatan-${nextIdx}" style="display:flex; flex-direction:column; gap:8px; margin-bottom:12px;"></div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label style="font-size:12px;">Catatan Keterangan Sumber Dana Pendapatan</label>
                        <textarea name="apbdes_keterangan_pendapatan[]" rows="2" required placeholder="Jelaskan dari mana saja dana pendapatan desa berasal..."></textarea>
                    </div>
                </div>

                <!-- 2. BELANJA -->
                <div style="background:#FFF; border:1px solid #FECACA; border-left:4px solid #EF4444; border-radius:8px; padding:16px; margin-bottom:16px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; flex-wrap:wrap; gap:8px;">
                        <h4 style="margin:0; font-size:14px; color:#B91C1C;">2. Belanja Desa &amp; Alokasi Bidang</h4>
                        <button type="button" onclick="tambahItemBox('belanja', ${nextIdx})" style="font-size:11.5px; padding:4px 10px; background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; font-weight:700; cursor:pointer;">
                            + Tambah Pos Belanja
                        </button>
                    </div>
                    <div class="form-group" style="margin-bottom:12px;">
                        <label style="font-size:12px; font-weight:700; color:#B91C1C;">Total Belanja Desa (Header Total)</label>
                        <input type="text" name="apbdes_belanja_total[]" value="Rp 0,00" required>
                    </div>
                    <div class="item-boxes-container" id="container-belanja-${nextIdx}" style="display:flex; flex-direction:column; gap:8px; margin-bottom:12px;"></div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label style="font-size:12px;">Catatan Keterangan Alokasi Belanja</label>
                        <textarea name="apbdes_keterangan_belanja[]" rows="2" required placeholder="Jelaskan untuk apa saja alokasi belanja diprioritaskan..."></textarea>
                    </div>
                </div>

                <!-- 3. PEMBIAYAAN -->
                <div style="background:#FFF; border:1px solid #A7F3D0; border-left:4px solid #10B981; border-radius:8px; padding:16px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; flex-wrap:wrap; gap:8px;">
                        <h4 style="margin:0; font-size:14px; color:#047857;">3. Pembiayaan Desa (Netto &amp; SiLPA)</h4>
                        <button type="button" onclick="tambahItemBox('pembiayaan', ${nextIdx})" style="font-size:11.5px; padding:4px 10px; background:#D1FAE5; color:#047857; border:1px solid #A7F3D0; border-radius:6px; font-weight:700; cursor:pointer;">
                            + Tambah Pos Pembiayaan
                        </button>
                    </div>
                    <div class="form-group" style="margin-bottom:12px;">
                        <label style="font-size:12px; font-weight:700; color:#047857;">Total Pembiayaan Netto (Header Total)</label>
                        <input type="text" name="apbdes_pembiayaan_total[]" value="Rp 0,00" required>
                    </div>
                    <div class="item-boxes-container" id="container-pembiayaan-${nextIdx}" style="display:flex; flex-direction:column; gap:8px; margin-bottom:12px;"></div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label style="font-size:12px;">Catatan Keterangan Pembiayaan</label>
                        <textarea name="apbdes_keterangan_pembiayaan[]" rows="2" required placeholder="Jelaskan asal usul penerimaan pembiayaan..."></textarea>
                    </div>
                </div>
            `;

            container.insertBefore(card, container.firstChild);
        }
    </script>
@endsection
