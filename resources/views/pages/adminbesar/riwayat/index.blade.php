@extends('layouts.adminbesar.main')

@section('title', 'Admin Besar Riwayat Pemesanan')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 style="color: #276f5f;"><i class="fas fa-clipboard-list"></i> Riwayat Pemesanan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('adminbesar.dashboard') }}" style="color: #276f5f;"><i class="fas fa-home"></i> Dashboard</a>
                </div>
                <div class="breadcrumb-item" style="color: #276f5f;"><i class="fas fa-clipboard-list"></i> Riwayat</div>
            </div>
        </div>

        <div class="card mt-3 shadow">
            <div class="card-body">
                <!-- Filter Pemesanan -->
                <h4 class="font-weight-bold" style="color: #276f5f;">Filter Pemesanan</h4>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="month" class="font-weight-bold" style="color: #276f5f;">Bulan:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="background-color: #276f5f; color: #fff;"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <select id="month" class="form-control form-control-sm" onchange="filterByMonthYear()">
                                @foreach(range(1, 12) as $month)
                                    <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="year" class="font-weight-bold" style="color: #276f5f;">Tahun:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="background-color: #276f5f; color: #fff;"><i class="fas fa-calendar"></i></span>
                            </div>
                            <select id="year" class="form-control form-control-sm" onchange="filterByMonthYear()">
                                @foreach(range(date('Y'), date('Y') - 5) as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Tabel Pemesanan -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead style="background-color: #fff; color: #fff;">
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Trip Type</th>
                                <th>Status</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="pemesananTable">
                            @php
                                $no = 0;
                            @endphp
                            @forelse ($pemesanan as $item)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $item->user->name ?? 'N/A' }}</td>
                                    <td>{{ ucfirst($item->trip_type) }}</td>
                                    <td>
                                        @php
                                            $statusColor = match($item->status) {
                                                'approved' => 'success',
                                                'pending' => 'warning',
                                                'rejected' => 'danger',
                                                default => 'secondary'
                                            };
                                        @endphp
                                        <span class="badge badge-{{ $statusColor }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td>{{ date('d M Y', strtotime($item->tanggal_pemesanan)) }}</td>
                                    <td>
                                        <a href="{{ route('adminbesar.riwayat.show', $item->id) }}" class="btn btn-sm" style="background-color: #276f5f; color: #fff;">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-secondary">Data Pemesanan Kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                      <!-- Pagination -->
                      <div class="mt-3 d-flex justify-content-center">
                        <!-- Previous Page Link -->
                        @if ($pemesanan->onFirstPage())
                            <span class="page-link disabled box">Sebelumnya</span>
                        @else
                            <a href="{{ $pemesanan->previousPageUrl() }}" class="page-link prev-next box">Sebelumnya</a>
                        @endif

                        <!-- Pagination Links -->
                        <ul class="pagination">
                            @foreach ($pemesanan->getUrlRange(1, $pemesanan->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $pemesanan->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Next Page Link -->
                        @if ($pemesanan->hasMorePages())
                            <a href="{{ $pemesanan->nextPageUrl() }}" class="page-link prev-next box">Selanjutnya</a>
                        @else
                            <span class="page-link disabled box">Selanjutnya</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const pemesananData = @json($pemesanan);

        function filterByMonthYear() {
            const month = document.getElementById('month').value;
            const year = document.getElementById('year').value;

            const filteredData = pemesananData.filter(item => {
                const date = new Date(item.tanggal_pemesanan);
                return date.getMonth() + 1 == month && date.getFullYear() == year;
            });

            const tableBody = document.getElementById('pemesananTable');
            tableBody.innerHTML = '';

            if (filteredData.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="7" class="text-center">Data Pemesanan Kosong</td></tr>';
            } else {
                filteredData.forEach((item, index) => {
                    const row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.user?.name || 'N/A'}</td>
                            <td>${item.trip_type.charAt(0).toUpperCase() + item.trip_type.slice(1)}</td>
                            <td>
                                <span class="badge badge-${getStatusColor(item.status)}">
                                    ${item.status.charAt(0).toUpperCase() + item.status.slice(1)}
                                </span>
                            </td>
                            <td>${new Date(item.tanggal_pemesanan).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' })}</td>
                            <td>Rp ${new Intl.NumberFormat('id-ID', { minimumFractionDigits: 2 }).format(item.total_pembayaran)}</td>
                            <td>
                                <a href="/adminbesar/riwayat/${item.id}" class="btn btn-sm" style="background-color: #276f5f; color: #fff;">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    `;
                    tableBody.innerHTML += row;
                });
            }
        }

        function getStatusColor(status) {
            switch (status) {
                case 'approved':
                    return 'success';
                case 'pending':
                    return 'warning';
                case 'rejected':
                    return 'danger';
                default:
                    return 'secondary';
            }
        }

        window.filterByMonthYear = filterByMonthYear;
    });
</script>
@endsection
