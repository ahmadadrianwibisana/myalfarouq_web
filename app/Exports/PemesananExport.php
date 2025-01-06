<?php

namespace App\Exports;

use App\Models\Pemesanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PemesananExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pemesanan::with(['user', 'openTrip', 'privateTrip', 'dataAdministrasi', 'pembayaran'])
            ->where('status', 'terkonfirmasi')
            ->whereHas('dataAdministrasi', function($query) {
                $query->where('status', 'approved');
            })
            ->whereHas('pembayaran', function($query) {
                $query->where('status_pembayaran', 'success');
            })
            ->get()->map(function($item, $index) {
                // Ambil data administrasi yang relevan
                $dataAdministrasi = $item->dataAdministrasi->map(function($data) {
                    return $data->status; // Ambil status dari data administrasi
                })->implode(', '); // Gabungkan status menjadi string

                return [
                    'No' => $index + 1, // Penomoran dimulai dari 1
                    'user' => $item->user->name ?? 'N/A',
                    'trip_type' => ucfirst($item->trip_type),
                    'nama_trip' => $item->trip_type == 'private_trip' ? ($item->privateTrip->nama_trip ?? 'N/A') : ($item->openTrip->nama_paket ?? 'N/A'),
                    'status' => ucfirst($item->status),
                    'tanggal_pemesanan' => date('d M Y', strtotime($item->tanggal_pemesanan)),
                    'total_pembayaran' => $item->total_pembayaran, // Simpan sebagai numerik
                    'status_pembayaran' => ucfirst($item->pembayaran->status_pembayaran ?? 'Belum Dibayar'), // Status pembayaran
                    'data_administrasi' => $dataAdministrasi ?: 'N/A', // Status data administrasi
                ];
            });
    }

    public function headings(): array
    {
        return [
            'No',
            'User ',
            'Trip Type',
            'Nama Trip',
            'Status',
            'Tanggal Pemesanan',
            'Total Pembayaran',
            'Status Pembayaran',
            'Data Administrasi',
        ];
    }
}