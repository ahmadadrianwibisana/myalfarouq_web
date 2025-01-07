<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pemesanan</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        @media print {
            @page {
                size: A4;
                margin: 20mm;
            }
            body {
                margin: 0;
                padding: 0;
            }
        }
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #276f5f;
            margin-bottom: 20px;
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .invoice-header img {
            height: 50px;
        }
        .info {
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .info p {
            margin: 5px 0;
        }
        .status {
            font-weight: bold;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .status.success {
            background-color: #28a745; /* Green */
        }
        .status.terkonfirmasi {
            background-color: #28a745; /* Green */
        }
        .status.pending {
            background-color: #ffc107; /* Yellow */
        }
        .status.failed {
            background-color: #dc3545; /* Red */
        }
        .total {
            font-size: 1.4em;
            font-weight: bold;
            color: #276f5f;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
        }
        footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="invoice-header">
            <div>
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/img/logo.png'))) }}" alt="Logo" />
            </div>
            <div>
                <p>Invoice: <strong>#{{ $pemesanan->id }}</strong></p>
                <p>{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}</p>
            </div>
        </div>
        <h1>Bukti Pemesanan</h1>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Nama</th>
                    <td>{{ $pemesanan->user->name }}</td>
                </tr>
                <tr>
                    <th>Nomor Handphone</th>
                    <td>{{ $pemesanan->user->no_telepon }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $pemesanan->user->email }}</td>
                </tr>
            </tbody>
        </table>
        <h2>Detail Pemesanan</h2>
        <div class="info">
            <p><strong>Type Trip:</strong> {{ ucfirst($pemesanan->trip_type) }}</p>
            <p><strong>Nama Trip:</strong> 
                {{ $pemesanan->trip_type === 'open_trip' ? ($pemesanan->openTrip ? $pemesanan->openTrip->nama_paket : 'N/A') : ($pemesanan->privateTrip ? $pemesanan->privateTrip->nama_trip : 'N/A') }}
            </p>
            <p><strong>Status:</strong> <span class="status {{ $pemesanan->status }}">{{ ucfirst($pemesanan->status) }}</span></p>
            <p><strong>Tanggal Pemesanan:</strong> {{ \Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->format('d F Y') }}</p>
            <p><strong>Destinasi:</strong> 
                {{ $pemesanan->trip_type === 'open_trip' ? ($pemesanan->openTrip ? $pemesanan->openTrip->destinasi : 'N/A') : ($pemesanan->privateTrip ? $pemesanan->privateTrip->destinasi : 'N/A') }}
            </p>
            <p><strong>Star Point:</strong> 
                {{ $pemesanan->trip_type === 'open_trip' ? ($pemesanan->openTrip ? $pemesanan->openTrip->star_point : 'N/A') : ($pemesanan->privateTrip ? $pemesanan->privateTrip->star_point : 'N/A') }}
            </p>
            <p><strong>Tanggal Keberangkatan:</strong> 
                {{ $pemesanan->trip_type === 'open_trip' ? ($pemesanan->openTrip ? \Carbon\Carbon::parse($pemesanan->openTrip->tanggal_berangkat)->format('d F Y') : 'N/A') : ($pemesanan->privateTrip ? \Carbon\Carbon::parse($pemesanan->privateTrip->tanggal_pergi)->format('d F Y') : 'N/A') }}
            </p>
            <p><strong>Tanggal Kepulangan:</strong> 
                {{ $pemesanan->trip_type === 'open_trip' ? ($pemesanan->openTrip ? \Carbon\Carbon::parse($pemesanan->openTrip->tanggal_pulang)->format('d F Y') : 'N/A') : ($pemesanan->privateTrip ? \Carbon\Carbon::parse($pemesanan->privateTrip->tanggal_kembali)->format('d F Y') : 'N/A') }}
            </p>
            <p><strong>Deskripsi Trip:</strong> {{ $pemesanan->openTrip->deskripsi_trip ?? $pemesanan->privateTrip->deskripsi_trip ?? 'N/A' }}</p>
        </div>
        <h2>Rincian Pembayaran</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Harga per Peserta</td>
                    <td>
                        @if($pemesanan->trip_type === 'open_trip')
                            Rp {{ number_format($pemesanan->openTrip ? $pemesanan->openTrip->harga : 0, 0, ',', '.') }}
                        @else
                            Rp {{ number_format($pemesanan->privateTrip ? $pemesanan->privateTrip->harga : 0, 0, ',', '.') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Jumlah Peserta</td>
                    <td>{{ $pemesanan->jumlah_peserta }} Peserta</td>
                </tr>
                <tr>
                    <th>Total yang Dibayarkan</th>
                    <th>Rp {{ number_format($pemesanan->total_pembayaran, 0, ',', '.') }}</th>
                </tr>
            </tbody>
        </table>
        <div class="info">
            <p><strong>Status Pembayaran:</strong> <span class="status {{ $pembayaran->status_pembayaran }}">{{ ucfirst($pembayaran->status_pembayaran) }}</span></p>
            <p class="total"><strong>Total Pembayaran:</strong> Rp {{ number_format($pemesanan->total_pembayaran, 0, ',', '.') }}</p>
        </div>
    </div>
    <footer>
        <p>Terima kasih telah melakukan pemesanan dengan kami. Selamat Menikmati Perjalanan Trip Anda.</p>
    </footer>
</body>
</html>