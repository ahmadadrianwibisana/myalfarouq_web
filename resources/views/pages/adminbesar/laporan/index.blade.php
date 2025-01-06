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
                <form method="GET" action="{{ route('adminbesar.laporan.index') }}">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="month" class="font-weight-bold" style="color: #276f5f;">Bulan:</label>
                            <select id="month" name="month" class="form-control form-control-sm">
                                <option value="">Semua</option>
                                @foreach(range(1, 12) as $month)
                                    <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="year" class="font-weight-bold" style="color: #276f5f;">Tahun:</label>
                            <select id="year" name="year" class="form-control form-control-sm">
                                <option value="">Semua</option>
                                @foreach(range(2020, 2030) as $year)
                                    <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="trip_type" class="font-weight-bold" style="color: #276f5f;">Jenis Trip:</label>
                            <select id="trip_type" name="trip_type" class="form-control form-control-sm">
                                <option value="">Semua</option>
                                <option value="openTrip" {{ request('trip_type') == 'openTrip' ? 'selected' : '' }}>Open Trip</option>
                                <option value="privateTrip" {{ request('trip_type') == 'privateTrip' ? 'selected' : '' }}>Private Trip</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="status" class="font-weight-bold" style="color: #276f5f;">Status:</label>
                            <select id="status" name="status" class="form-control form-control-sm">
                                <option value="">Semua</option>
                                <option value="terkonfirmasi" {{ request('status') == 'terkonfirmasi' ? 'selected' : '' }}>Terkonfirmasi</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="user_name" class="font-weight-bold" style="color: #276f5f;">Nama User:</label>
                            <input type="text" id="user_name" name="user_name" class="form-control form-control-sm" value="{{ request('user_name') }}" placeholder="Cari Nama User">
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                    </div>
                </form>

                <!-- Tabel Pemesanan -->
                <div class="table-responsive mt-4"> 
                    <table class="table table-bordered table-hover"> 
                        <thead class="thead-dark">
                            <tr> 
                                <th>No</th> 
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

                <div>
                    <a href="{{ route('adminbesar.laporan.export.excel') }}" class="btn btn-success btn-sm">Unduh Excel</a>
                </div>

                <!-- Total Pendapatan -->
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="text-primary font-weight-bold" style="color: #276f5f;">Total Pendapatan</h4>
                    <div class="form-group mb-0">
                        <label for="filterPendapatan" class="font-weight-bold" style="color: #276f5f;">Filter Pendapatan:</label>
                        <select id="filterPendapatan" class="form-control form-control-sm" onchange="filterPendapatan(this.value)">
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

        const month = document.getElementById('month').value;
        const year = document.getElementById('year').value;

        if (type === 'bulanan') {
            if (month) {
                total = totalPendapatan['bulanan'][`${year}-${month.padStart(2, '0')}`] || 0;
            } else {
                total = Object.values(totalPendapatan['bulanan']).reduce((a, b) => a + b, 0);
            }
        } else if (type === 'tahunan') {
            if (year) {
                total = totalPendapatan['tahunan'][year] || 0;
            } else {
                total = Object.values(total Pendapatan['tahunan']).reduce((a, b) => a + b, 0);
            }
        }

        document.getElementById('totalPendapatan').textContent = `Total Pendapatan: Rp ${new Intl.NumberFormat('id-ID', { minimumFractionDigits: 2 }).format(total)}`;
    }

    function filterByMonthYear() {
        const month = document.getElementById('month').value;
        const year = document.getElementById('year').value;
        const tripType = document.getElementById('trip_type').value;
        const status = document.getElementById('status').value;
        const userName = document.getElementById('user_name').value;

        const filteredData = pemesananData.filter(item => {
            const date = new Date(item.tanggal_pemesanan);
            const monthMatch = month ? (date.getMonth() + 1 == month) : true; // If month is not selected, match all
            const yearMatch = year ? (date.getFullYear() == year) : true; // If year is not selected, match all
            const tripTypeMatch = tripType ? (item.trip_type == tripType) : true; // If trip type is not selected, match all
            const statusMatch = status ? (item.status == status) : true; // If status is not selected, match all
            const userNameMatch = userName ? (item.user?.name.toLowerCase().includes(userName.toLowerCase())) : true; // If user name is not selected, match all
            return monthMatch && yearMatch && tripTypeMatch && statusMatch && userNameMatch;
        });

        const tableBody = document.getElementById('pemesananTable');
        tableBody.innerHTML = '';

        let totalPendapatanFiltered = 0; // Initialize filtered total revenue

        if (filteredData.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="7" class="text-center">Data Pemesanan Kosong</td></tr>';
        } else {
            filteredData.forEach((item, index) => {
                const row = `
                    <tr class="text-center">
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
                totalPendapatanFiltered += item.total_pembayaran; // Add to total revenue
            });
        }

        // Update total revenue
        document.getElementById('totalPendapatan').textContent = `Total Pendapatan: Rp ${new Intl.NumberFormat('id-ID', { minimumFractionDigits: 2 }).format(totalPendapatanFiltered)}`;
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