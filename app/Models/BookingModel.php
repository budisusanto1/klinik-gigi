<?php namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    // Nama tabel yang digunakan
    protected $table = 'booking';

    // Nama kolom yang dapat diisi
    protected $allowedFields = ['id_booking', 'tanggal_kunjungan', 'nama_layanan', 'nama_dokter', 'status', 'konfirmasi_kedatangan', 'jam_kunjungan'];

    // Gunakan if you want to automatically handle timestamps
    protected $useTimestamps = true;

    // Tentukan primary key
    protected $primaryKey = 'id_booking';

    // Set validasi yang ingin Anda terapkan
    protected $validationRules = [
        'tanggal_kunjungan' => 'required|valid_date',
        'nama_layanan' => 'required|string',
        'nama_dokter' => 'required|string',
        'status' => 'required|string',
        'konfirmasi_kedatangan' => 'permit_empty|string',
    ];
     // Nama tabel yang digunakan
   

    // Fungsi untuk memperbarui data booking
   public function updateData($id, $data)
{
    return $this->db->table('booking')
        ->where('id_booking', $id)
        ->update($data);
}
// App/Models/PembayaranModel.php
public function updateData1($id_booking, $data)
{
    return $this->db->table('pembayaran')
        ->where('id_booking', $id_booking)
        ->update($data);
}



  public function getBookingsByStatus($status)
    {
        return $this->where('status', $status)->findAll();
    }
}
