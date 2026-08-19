@extends('layouts.admin', ['activePage' => 'produk'])

@section('title', 'Kelola Produk UMKM')

@section('content')
    <div class="admin-box">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
            <h1 style="margin: 0; font-size: 24px; color: var(--biru-tua); font-weight: 800;">Kelola Produk UMKM</h1>
            <div>
                <a href="/" class="btn btn-secondary" target="_blank">Lihat Web</a>
                <a href="/admin/produk/create" class="btn btn-primary">+ Tambah Produk</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <style>
            .switch-toggle {
                position: relative; display: inline-block; width: 38px; height: 20px; vertical-align: middle;
            }
            .switch-toggle input { opacity: 0; width: 0; height: 0; }
            .switch-slider {
                position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0;
                background-color: #CBD5E1; transition: .2s; border-radius: 20px;
            }
            .switch-slider:before {
                position: absolute; content: ""; height: 14px; width: 14px; left: 3px; bottom: 3px;
                background-color: white; transition: .2s; border-radius: 50%;
            }
            input:checked + .switch-slider { background-color: #16A34A; }
            input:checked + .switch-slider:before { transform: translateX(18px); }
        </style>

        <div style="overflow-x: auto; -webkit-overflow-scrolling: touch; width: 100%; margin-top: 10px;">
            <table>
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama Produk</th>
                        <th>Penjual</th>
                        <th>Harga</th>
                        <th>Status Tayang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produks as $item)
                    <tr>
                        <td>
                            <img src="{{ $item->foto_produk ? asset('storage/'.$item->foto_produk) : 'https://placehold.co/100' }}" width="60" style="border-radius: 6px; object-fit: cover; aspect-ratio: 1/1; display: block;">
                        </td>
                        <td><b>{{ $item->nama_produk }}</b><br><small style="color:#64748B;">{{ $item->kategori }} &bull; Status: {{ $item->status_stok }}</small></td>
                        <td>{{ $item->nama_penjual }}</td>
                        <td>{{ $item->harga }}</td>
                        <td>
                            @if(auth()->user()->isAdmin())
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <label class="switch-toggle" title="Klik untuk sembunyikan/tampilkan dari publik">
                                        <input type="checkbox" onchange="handleVisibilityToggle('/admin/produk/{{ $item->id }}/toggle-visibility', this)" {{ !$item->is_hidden ? 'checked' : '' }}>
                                        <span class="switch-slider"></span>
                                    </label>
                                    <span class="status-label" style="font-size: 11.5px; font-weight: 700; color: {{ !$item->is_hidden ? '#16A34A' : '#DC2626' }};">
                                        {{ !$item->is_hidden ? 'Tayang' : 'Disembunyikan' }}
                                    </span>
                                </div>
                            @else
                                <span style="font-size: 11.5px; font-weight: 700; color: {{ !$item->is_hidden ? '#16A34A' : '#DC2626' }};">
                                    {{ !$item->is_hidden ? '🟢 Tayang' : '🔴 Disembunyikan' }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <a href="/admin/produk/{{ $item->id }}/edit" class="btn btn-warning" style="padding: 6px 12px; font-size: 12.5px;">Edit</a>
                            @if(auth()->user()->isAdmin() || ($item->user_id && $item->user_id === auth()->id()))
                            <form action="/admin/produk/{{ $item->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size: 12.5px;">Hapus</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: #64748B; padding: 30px;">Belum ada produk yang didaftarkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        async function handleVisibilityToggle(url, checkbox) {
            const row = checkbox.closest('tr');
            const labelEl = row.querySelector('.status-label');
            const originalChecked = !checkbox.checked;

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                const res = await response.json();
                if (res.status === 'success') {
                    if (res.is_hidden) {
                        labelEl.textContent = 'Disembunyikan';
                        labelEl.style.color = '#DC2626';
                    } else {
                        labelEl.textContent = 'Tayang';
                        labelEl.style.color = '#16A34A';
                    }
                    if (window.showAdminToast) window.showAdminToast(res.message, 'success');
                } else {
                    checkbox.checked = originalChecked;
                    alert(res.message || 'Gagal mengubah status visibilitas.');
                }
            } catch (err) {
                console.error(err);
                checkbox.checked = originalChecked;
                alert('Terjadi kesalahan jaringan.');
            }
        }
    </script>
@endsection