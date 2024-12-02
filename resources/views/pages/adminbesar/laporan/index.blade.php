@extends('layouts.adminbesar.main') 
@section('title', 'Admin Besar Laporan Pemesanan') 

@section('content') 
<div class="main-content"> 
    <section class="section"> 
        <div class="section-header"> 
            <h1 style="color: #276f5f;">LAPORAN</h1> 
            <div class="section-header-breadcrumb"> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('adminbesar.dashboard') }}" style="color: #276f5f;">Dashboard</a>
                </div> 
                <div class="breadcrumb-item" style="color: #276f5f;">LAPORAN</div> 
            </div> 
        </div> 

        <div class="card mt-3 shadow-sm">
            <div class="card-body"> 
                <!-- Filter Pemesanan -->
                <h4 class="text-primary font-weight-bold" style="color: #276f5f;">Filter Pemesanan</h4>
                <div class="row">
                    <div class="col-md-6">
                        <label for="month" class="font-weight-bold" style="color: #276f5f;">Bulan:</label>
                        <select id="month" class="form-control form-control-sm" onchange="filterByMonthYear()">
                            @foreach(range(1, 12) as $month)
                                <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="year" class="font-weight-bold" style="color: #276f5f;">Tahun:</label>
                        <select id="year" class="form-control form-control-sm" onchange="filterByMonthYear()">
                            @foreach(range(date('Y'), date('Y') - 5) as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Tabel Pemesanan -->
                <div class="table-responsive mt-4"> 
                    <table class="table table-bordered table-hover"> 
                        <thead class="thead-dark">
                            <tr> 
                                <th>#</th> 
                                <th>User</th> 
                                <th>Trip Type</th> 
                                <th>Status</th> 
                                <th>Tanggal Pemesanan</th> 
                                <th>Total Pembayaran</th>
                                <th>Action</th> 
                            </tr> 
                        </thead>
                        <tbody id="pemesananTable">
                            @php 
                                $no = 0;
                            @endphp
                            @forelse ($pemesanan as $item) 
                                <tr class="text-center"> 
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
                                    <td>Rp {{ number_format($item->total_pembayaran, 2, ',', '.') }}</td>
                                    <td> 
                                        <a href="{{ route('adminbesar.laporan.show', $item->id) }}" class="btn btn-info btn-sm" style="background-color: #276f5f; border-color: #276f5f;">
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
                </div> 

                <!-- Total Pendapatan -->
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="text-primary font-weight-bold" style="color: #276f5f;">Total Pendapatan</h4>
                    <div class="form-group mb-0">
                        <label for="filterPendapatan" class="font-weight-bold" style="color: #276f5f;">Filter Pendapatan:</label>
                        <select id="filterPendapatan" class="form-control form-control-sm" onchange="filterPendapatan(this.value)">
                            <option value="harian">Harian</option>
                            <option value="mingguan">Mingguan</option>
                            <option value="bulanan" selected>Bulanan</option>
                            <option value="tahunan">Tahunan</option>
                        </select>
                    </div>
                </div>
                <div class="alert alert-info mt-3" id="totalPendapatan" style="background-color: #276f5f; color: white;">
                    <strong>Total Pendapatan:</strong> Rp {{ number_format(array_sum($totalPendapatan['bulanan']), 2, ',', '.') }}
                </div>
            </div> 
        </div>
    </section> 
</div>

<script>
    let pemesananData = @json($pemesanan);
    let totalPendapatan = @json($totalPendapatan);

    function filterPendapatan(type) {
        let total = 0;

        switch (type) {
            case 'harian':
                total = Object.values(totalPendapatan['harian']).reduce((a, b) => a + b, 0);
                break;
            case 'mingguan':
                total = Object.values(totalPendapatan['mingguan']).reduce((a, b) => a + b, 0);
                break;
            case 'bulanan':
                total = Object.values(totalPendapatan['bulanan']).reduce((a, b) => a + b, 0);
                break;
            case 'tahunan':
                total = Object.values(totalPendapatan['tahunan']).reduce((a, b) => a + b, 0);
                break;
        }

        document.getElementById('totalPendapatan').textContent = `Total Pendapatan: Rp ${new Intl.NumberFormat('id-ID', { minimumFractionDigits: 2 }).format(total)}`;
    }

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
                            <a href="/adminbesar/laporan/${item.id}" class="btn btn-info btn-sm" style="background-color: #276f5f; border-color: #276f5f;">
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
</script>
@endsection
