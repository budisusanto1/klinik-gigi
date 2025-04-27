<?php

namespace App\Controllers;
use App\Models\M_belajar;
use App\Models\M_user;
use App\Models\BookingModel;
use App\Models\PembayaranModel;
use App\Models\LayananModel; 
use Dompdf\Dompdf;
use Dompdf\Options;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Home extends BaseController
{
    // Di dalam Controller Anda
protected $bookingModel;

public function __construct()
{
    // Inisialisasi model booking
    $this->bookingModel = new \App\Models\BookingModel();
      $this->pembayaranModel = new PembayaranModel();
}

    public function index()
    {
        return view('dashboard');
    }
public function log_activity()
{
    $logModel = new M_belajar();
    $data['logs'] = $logModel->getLogs(); // Pastikan mengambil data dari model
    return view('log_activity', $data);
}
public function hai()
{
    $logModel = new M_belajar();

    if (!session()->get('id')) {
        return redirect()->to('home/login')->with('error', 'Silakan login terlebih dahulu.');
    }
    // Cek apakah sesi masih aktif
    $loginTime = session()->get('login_time');
    if (time() - $loginTime > 1800) {
        $logModel->log_activity(session()->get('id'), session()->get('u'), "Sesi berakhir, logout otomatis.");
        return redirect()->to('home/logout')->with('error', 'Sesi Anda telah berakhir. Silakan login kembali.');
    }
    session()->set('login_time', time());
    $logModel->log_activity(session()->get('id'), session()->get('u'), "Mengakses Dashboard");
    $role = session()->get('role');
    $username = session()->get('username'); // GANTI DARI 'nama' KE 'username'
    // Ambil data tambahan berdasarkan role
    $model = new M_belajar();
    $data = [
        'role' => $role,
        'username' => $username
    ];
    if ($role == 'admin') {
        $data['jumlah_dokter'] = $model->getDokter();
        $data['jumlah_pasien'] = $model->getPasien();
        // $data['laporan'] = $model->getLaporanKeuangan();
    } elseif ($role == 'dokter') {
        $data['rekam_medis'] = $model->getRekamMedisByDokter(session()->get('id'));
    } elseif ($role == 'resepsionis') {
        $data['pasien'] = $model->getPasien();
    } elseif ($role == 'pasien') {
        $data['layanan'] = $model->getLayanan();
    }
    // Load view sesuai role
    echo view('header');
    echo view('dashboard_' . $role, $data);
    echo view('footer');
}
    public function login()
    {
        echo view('Login');
    }
  public function register()
    {
        echo view('register');
    }

    public function aksi_register()
{
    $a = $this->request->getPost('email');
    $b = $this->request->getPost('username');
    $c = $this->request->getPost('password');
    $d = $this->request->getPost('role');
    $Joyce = new M_belajar();

    // 🔹 Array untuk menampung pesan error
    $errors = [];

    // 🔹 Kriteria password bertahap
    if (strlen($c) < 8) {
        $errors[] = "⚠️ Password minimal harus 8 karakter.";
    }
    if (!preg_match('/[A-Z]/', $c)) {
        $errors[] = "⚠️ Password harus mengandung minimal 1 huruf besar (A-Z).";
    }
    if (!preg_match('/[a-z]/', $c)) {
        $errors[] = "⚠️ Password harus mengandung minimal 1 huruf kecil (a-z).";
    }
    if (!preg_match('/[0-9]/', $c)) {
        $errors[] = "⚠️ Password harus mengandung minimal 1 angka (0-9).";
    }
    if (!preg_match('/[!@#$%^&*]/', $c)) {
        $errors[] = "⚠️ Password harus mengandung minimal 1 karakter spesial (!@#$%^&*).";
    }

    // 🔹 Jika ada error, tampilkan satu per satu
    if (!empty($errors)) {
        session()->setFlashdata('error', implode('<br>', $errors));
        return redirect()->to('home/register');
    }

    // 🔹 Jika tidak ada error, simpan data
    $data = array(
        "username" => $b,
        "password" => MD5($c),
        "email" => $a,
        "role" => 'pasien'
    );
    $Joyce->input('user', $data);
    $cek = $Joyce->getWhere('user', $data);
    
    if ($cek != null) {
        session()->set('id', $cek->id_user);
        session()->set('u', $cek->username);
        session()->set('role', $cek->role);
        return redirect()->to('home/login');
    } else {
        return redirect()->to('home/login');
    }
}
public function aksi_login()
{
    $userModel = new M_user();
    $logModel = new M_belajar();

    $logModel->log_activity(null, 'Guest', "Percobaan login dimulai");

    // Cek apakah pakai captcha lokal atau Google reCAPTCHA
    $captchaAnswer = $this->request->getPost('captcha_answer');

    if ($captchaAnswer !== null) {
        // Jika offline, pakai captcha tambah
        $correctAnswer = (int)$this->request->getPost('captcha_correct');
        if ((int)$captchaAnswer !== $correctAnswer) {
            $logModel->log_activity(null, 'Guest', "Login gagal: Jawaban captcha salah (lokal)");
            return redirect()->to('home/login')->withInput()->with('error', 'Jawaban captcha salah.');
        }
    } else {
        // Jika online, pakai Google reCAPTCHA
        $recaptcha_secret = "6Ldv9-gqAAAAAEqZ-a3-TylnkOkUzpCBRlbnKDCO";
        $recaptcha_response = $this->request->getPost('g-recaptcha-response');

        if (!$recaptcha_response) {
            $logModel->log_activity(null, 'Guest', "Login gagal: reCAPTCHA kosong");
            return redirect()->to('home/login')->with('error', 'Mohon isi reCAPTCHA.');
        }

        $verify_url = "https://www.google.com/recaptcha/api/siteverify";
        $response = file_get_contents($verify_url . "?secret=" . $recaptcha_secret . "&response=" . $recaptcha_response);
        $response_keys = json_decode($response, true);

        if (!isset($response_keys["success"]) || $response_keys["success"] !== true) {
            $logModel->log_activity(null, 'Guest', "Login gagal: reCAPTCHA tidak valid");
            return redirect()->to('home/login')->with('error', 'Verifikasi reCAPTCHA gagal. Coba lagi.');
        }
    }

    // Validasi user
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('pswd');
    $user = $userModel->cek_login($email, $password); // Harus ada di M_user

    if ($user) {
        session()->set([
            'id' => $user['id_user'],
            'u' => $user['email'],
            'role' => $user['role'],
            'Username' => $user['Username'],
            'login_time' => time()
        ]);

        $logModel->log_activity($user['id_user'], $user['email'], "Login berhasil");
        return redirect()->to('home/hai');
    } else {
        $logModel->log_activity(null, $email, "Login gagal: Email atau password salah");
        return redirect()->to('home/login')->with('error', 'Email atau Password salah.');
    }
}

public function logout()
{
    $logModel = new M_belajar(); // Model untuk log activity

    // Cek apakah user sedang login
    $userId = session()->get('id');
    $username = session()->get('u') ?? 'Guest';

    // 🔥 Log aktivitas logout
    $logModel->log_activity($userId, $username, "Logout berhasil");

    // Hapus session
    session()->destroy();

    return redirect()->to('home/login');
}
public function layanan1()
{
    $model = new M_belajar;
    $data['layanan'] = $model->getAll('layanan');  // Ambil semua layanan
    echo view('header');
    echo view('layanan_klinik', $data);
    echo view('footer');
}

public function pembayaran()
{
    $bookingModel = new BookingModel();
    $layananModel = new LayananModel(); // Pastikan sudah ada model untuk tabel layanan

    // Ambil data booking yang statusnya sudah selesai dan belum dibayar
    $bookings = $bookingModel->where('status_pembayaran', 'belum bayar')->findAll();

    // Looping melalui setiap booking untuk menambahkan harga layanan
    foreach ($bookings as &$booking) {
        // Pastikan id_layanan ada pada booking
        if (isset($booking['id_layanan'])) {
            // Ambil data layanan berdasarkan id_layanan
            $layanan = $layananModel->find($booking['id_layanan']);

            // Jika layanan ditemukan, tambahkan harga layanan ke booking
            if ($layanan) {
                $booking['total_biaya'] = $layanan['harga'];
            } else {
                // Jika layanan tidak ditemukan, set total_biaya ke 0
                $booking['total_biaya'] = 0;
            }
        } else {
            // Jika id_layanan tidak ada pada booking, set total_biaya ke 0
            $booking['total_biaya'] = 0;
        }
    }

    echo view('header');
    echo view('pembayaran_pasien', ['bookings' => $bookings]);
    echo view('footer');
}
public function proses_pembayaran()
{
    $m_belajar = new \App\Models\M_belajar();

    // Ambil data dari form
    $id_booking = $this->request->getPost('id_booking');
    $metode_pembayaran = $this->request->getPost('metode_pembayaran');
    $total = $this->request->getPost('total');
    $uang_diberikan = $this->request->getPost('uang_diberikan');

    // Hitung kembalian
    $kembalian = $uang_diberikan - $total;

    // Validasi dasar
    if (!$id_booking || !$metode_pembayaran || !$total || !$uang_diberikan) {
        return redirect()->back()->with('error', 'Mohon lengkapi semua data.');
    }

    // Cek apakah booking ada
    $booking = $m_belajar->getWhere('booking', ['id_booking' => $id_booking]); // Pastikan ini sesuai dengan metode yang ada
    if (empty($booking)) { // Cek apakah data booking ditemukan
        return redirect()->back()->with('error', 'Data booking tidak ditemukan.');
    }

    // Data pembayaran
    $data_pembayaran = [
        'id_booking' => $id_booking,
        'metode_pembayaran' => $metode_pembayaran,
        'total' => $total,
        'uang_diberikan' => $uang_diberikan,
        'kembalian' => $kembalian,
        'tanggal_pembayaran' => date('Y-m-d H:i:s'),
        'status' => 'terbayar'
    ];

    // Simpan data pembayaran
    $isSaved = $m_belajar->simpan_data('pembayaran', $data_pembayaran); // Memastikan simpan_data berfungsi

    if ($isSaved) {
        // Update status booking
        $m_belajar->updateData('booking', ['id_booking' => $id_booking], ['status_pembayaran' => 'sudah bayar']);

        // Redirect sukses
        return redirect()->to('home/riwayat_pembayaran')->with('success', 'Pembayaran berhasil diproses.');
    }

    // Jika simpan data gagal
    return redirect()->back()->with('error', 'Gagal menyimpan data pembayaran.');
}

public function riwayat_pembayaran()
{
    $pembayaranModel = new \App\Models\M_belajar(); // Model untuk menggunakan join2

    // Menggunakan join2 untuk mendapatkan data pembayaran dan status pembayaran yang terbayar
    $riwayat_pembayaran = $pembayaranModel->join2(
        'pembayaran',           // Tabel pertama (pembayaran)
        'booking',              // Tabel kedua (booking)
        'pembayaran.id_booking = booking.id_booking', // Kondisi JOIN
        ['booking.status_pembayaran' => 'terbayar']  // Kondisi WHERE (hanya yang terbayar)
    );

    // Mengecek apakah data ada
    if ($riwayat_pembayaran->getNumRows() > 0) {
        $riwayat_pembayaran = $riwayat_pembayaran->getResultArray();
    } else {
        $riwayat_pembayaran = [];
    }

    // Kirim data riwayat pembayaran ke view
    echo view('header');
    echo view('riwayat_pembayaran', ['riwayat_pembayaran' => $riwayat_pembayaran]);
    echo view('footer');
}

    private function log_aktivitas($message)
    {
        // Tambahkan kode untuk mencatat log aktivitas di sistem Anda
        // Misalnya, simpan log ke database atau file log
        log_message('info', $message);
    }
public function booking($id_layanan)
{
    $sim = new M_belajar();

    // Ambil data layanan
    $layanan = $sim->getWhere('layanan', ['id_layanan' => $id_layanan]);

    if (!$layanan) {
        return redirect()->to(base_url('home'))->with('error', 'Layanan tidak ditemukan!');
    }

    // Ambil semua jadwal aktif
    $jadwal_query = $sim->join2('jadwal', 'dokter', 'jadwal.id_dokter = dokter.id_dokter');

    if ($jadwal_query) {
        $jadwal = $jadwal_query->getResult();
    } else {
        $jadwal = [];
    }

    echo view('header');
    echo view('booking', [
        'layanan' => $layanan,
        'jadwal' => $jadwal
    ]);
    echo view('footer');
}


public function simpan_booking()
{
    $sim = new M_belajar(); // Pastikan model sudah benar

    $id_pasien = session()->get('id_user'); // Mengambil id_pasien dari session
    $id_layanan = $this->request->getPost('id_layanan');
    $tanggal = $this->request->getPost('tanggal_kunjungan');
    $jam = $this->request->getPost('jam_kunjungan');
    $keluhan = $this->request->getPost('keluhan');
    $id_jadwal = $this->request->getPost('id_jadwal');

    // Ambil data jadwal berdasarkan id_jadwal
    $jadwal = $sim->getWhere('jadwal', ['id_jadwal' => $id_jadwal]); // Mengambil data jadwal pertama

    if (!$jadwal) {
        return redirect()->back()->with('error', 'Jadwal tidak ditemukan!');
    }

    // Data yang akan disimpan
    $data = [
        'id_pasien' => 1, // Menggunakan session untuk id_pasien
        'id_dokter' => $jadwal->id_dokter, // Menambahkan id_dokter dari jadwal
        'id_layanan' => $id_layanan,
        'tanggal_kunjungan' => $tanggal,
        'jam_kunjungan' => $jam,
        'status' => 'Menunggu Konfirmasi',
        'status_pembayaran' => 'belum bayar', // Status default
        'keluhan' => $keluhan,
        'id_jadwal' => $id_jadwal
    ];

    // Masukkan data booking ke database
    $sim->input('booking', $data); // Pastikan model punya metode insert atau input sesuai

    return redirect()->to(base_url('home/jadwal_kunjungan'))->with('success', 'Booking berhasil disimpan!');
}
public function jadwal_kunjungan()
{
    // Cek apakah user sedang login dan rolenya pasien
    if (session()->has('role') && session()->get('role') == 'pasien') {
        $model = new M_belajar();    // Model untuk query database
        $logModel = new M_belajar(); // Model untuk log aktivitas

        $id_pasien = session()->get('id_user');  // Ambil ID pasien dari session

        // Ambil data jadwal kunjungan
    $data['kunjungan'] = $model->join5(
    'booking',
    'layanan',
    'dokter',
    'jadwal',
    'pasien',
    'booking.id_layanan = layanan.id_layanan',
    'booking.id_dokter = dokter.id_dokter',
    'booking.id_jadwal = jadwal.id_jadwal',
    'booking.id_pasien = pasien.id_pasien',
    ['booking.id_pasien' => $id_pasien], // ✅ Ganti dari 1 ke session
    'booking.id_booking',
    'DESC'
);


        // Kirim juga role ke view supaya bisa dicek di tampilan
        $data['role'] = session()->get('role');

        // Log aktivitas akses halaman jadwal kunjungan
        $logModel->log_activity($id_pasien, session()->get('email') ?? 'Guest', "Mengakses halaman Jadwal Kunjungan");

        // Load tampilan
        echo view('header');
        echo view('jadwal_kunjungan', $data);
        echo view('footer');

    } else {
        return redirect()->to('home/login');
    }
}
  
public function konfirmasiKedatangan($id_booking)
{
    // Pastikan hanya pasien yang bisa konfirmasi
    if (session()->get('role') != 'pasien') {
        return redirect()->back()->with('error', 'Anda tidak memiliki akses!');
    }

    // Ambil status yang dipilih dari form
    $status = $this->request->getPost('status');

    // Validasi status konfirmasi
    if (!$status || !in_array($status, ['Akan Datang', 'Batal Datang'])) {
        return redirect()->back()->with('error', 'Status tidak valid!');
    }

    // Cek apakah booking yang dimaksud ada di database
    $booking = $this->bookingModel->find($id_booking);
    if (!$booking) {
        return redirect()->back()->with('error', 'Booking tidak ditemukan!');
    }

    // Perbarui konfirmasi kedatangan
    $updateData = [
        'konfirmasi_kedatangan' => $status
    ];

    // Jika pasien memilih 'Akan Datang', ubah status booking menjadi 'Diterima'
    if ($status == 'Akan Datang') {
        $updateData['status'] = 'Diterima'; // Update status booking menjadi 'Diterima'
    }
    // Jika pasien memilih 'Batal Datang', ubah status booking menjadi 'Dibatalkan'
    elseif ($status == 'Batal Datang') {
        $updateData['status'] = 'Dibatalkan'; // Update status booking menjadi 'Dibatalkan'
    }

    // Update data booking di database menggunakan model
    $this->bookingModel->updateData($id_booking, $updateData);

    // Tambahkan log aktivitas jika perlu
    $this->log_aktivitas('Konfirmasi kedatangan oleh pasien: ' . session()->get('Username'));

    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with('success', 'Konfirmasi kedatangan berhasil dikirim!');
}
public function rekamMedisSaya()
{
    // Cek apakah user sedang login dan rolenya pasien atau dokter
    if (session()->has('role') && (session()->get('role') == 'pasien' || session()->get('role') == 'dokter')) {
        $model = new M_belajar();    // Model untuk query database
        $logModel = new M_belajar(); // Model untuk log aktivitas

        $id_user = session()->get('id_user');  // Ambil ID user dari session
        $role = session()->get('role');

        // Ambil data rekam medis
        if ($role === 'pasien') {
            // Join dengan user untuk ambil nama dokter dan nama pasien
            $data['rekam_medis'] = $model->join2(
                'rekam_medis', 
                'user as dokter', 
                'rekam_medis.id_dokter = dokter.id_user',
                'rekam_medis.id_pasien = ' . $id_user
            );
        } elseif ($role === 'dokter') {
            // Join dengan user untuk ambil nama pasien dan nama dokter
            $data['rekam_medis'] = $model->join2(
                'rekam_medis', 
                'user as pasien', 
                'rekam_medis.id_pasien = pasien.id_user',
                'rekam_medis.id_dokter = ' . $id_user
            );
        }

        // Kirim data ke view
        $data['role'] = $role;

        // Log aktivitas akses halaman rekam medis
        $logModel->log_activity($id_user, session()->get('email') ?? 'Guest', "Mengakses halaman Rekam Medis");

        // Load tampilan
        echo view('header');
        echo view('rekam_medis_saya', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/login');
    }
}
public function rekamMedisTambah()
{
    if (session()->has('role') && session()->get('role') == 'dokter') {
        $model = new M_belajar();
        $data['pasien'] = $model->getPasienList(); // Ensure this returns an array or object

        // Check if the pasien data is empty or invalid
        if (empty($data['pasien'])) {
            $data['pasien'] = []; // Make sure we pass an empty array if no pasien found
        }

        echo view('header');
        echo view('rekam_medistambah', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/login');
    }
}
public function rekammedissimpan()
{
    $logModel = new M_belajar();
    $Sim = new M_belajar();

$id_pasien = $this->request->getPost('id_pasien');
    $diagnosa = $this->request->getPost('diagnosa');
    $catatan = $this->request->getPost('catatan');
    $tanggal_periksa = date('Y-m-d');
    $id = $this->request->getPost('id');

    $wece = array('id_rekam' => $id);
 $data = [
    'id_pasien' => $this->request->getPost('id_pasien'),
    'id_dokter' => session()->get('id_user'),
    'diagnosa' => $this->request->getPost('diagnosa'),
    'catatan' => $this->request->getPost('catatan'),
    'tanggal_periksa' => $this->request->getPost('tanggal_periksa'),
];


    $Sim->input('rekam_medis', $data, $wece);

    // 🔥 Log aktivitas simpan user
    $userId = session()->get('id');
    $email = session()->get('email') ?? 'Guest';
    $logModel->log_activity($userId, $email, "Menyimpan data User dengan email $d");

    return redirect()->to('home/rekamMedisSaya');
}

public function laporankeuangan()
{
    $logModel = new M_belajar(); // Model untuk log activity

    // Cek user yang sedang login
    $userId = session()->get('id');
    $email = session()->get('email') ?? 'Guest';

    // 🔥 Log aktivitas akses halaman laporan keuangan
    $logModel->log_activity($userId, $email, "Mengakses halaman Laporan Keuangan");

    echo view('header');
    echo view('laporankeuangan');
    echo view('footer');
}

public function excellapor_keuangan()
{
    $logModel = new M_belajar(); // Model untuk log activity
    $Sim = new M_belajar(); // Model untuk database

    // Ambil inputan tanggal dari form
    $a = $this->request->getPost('tanggal_awal');
    $b = $this->request->getPost('tanggal_akhir');

    // Ambil data berdasarkan filter tanggal
    $yap['ss'] = $Sim->filter(
        'pembayaran',  // Tabel utama
        'orders',      // Join dengan orders
        'pembayaran.id_order = orders.id_order', // Kondisi join
        'tanggal_pembayaran', // Kolom tanggal untuk filter
        'tanggal_pembayaran', // Kolom tanggal untuk order
        $a, // Tanggal awal
        $b  // Tanggal akhir
    );

    // 🔥 Log aktivitas unduh laporan keuangan
    $userId = session()->get('id');
    $email = session()->get('email') ?? 'Guest';
    $logModel->log_activity($userId, $email, "Mengunduh Laporan Keuangan dari $a hingga $b");

    echo view('excellapor_keuangan', $yap);
}

    // public function pembayaran()
    // {
    //     echo view('header');
    //     echo view('pembayaran');
    //     echo view('footer');
    // }
    
public function user()
{
    if (session()->get('id')) {
        $model = new M_belajar();

        $data['es1'] = $model->tampil_active_no_sort('user', 'id_user');
        $data['deleted_items'] = $model->get_deleted_items_no_sort('user', 'id_user');

        // Log aktivitas akses halaman user
        $userId = session()->get('id');
        $email = session()->get('email') ?? 'Guest';
        $model->log_activity($userId, $email, "Mengakses halaman User");

        echo view('header');
        echo view('tampilanuser', $data);
        echo view('footer');
    } else if (session()->get('role')) {
        return redirect()->to('/error');
    } else {
        return redirect()->to('home/login');
    }
}


public function tambahuser()
{
    $logModel = new M_belajar();
    $userId = session()->get('id');
    $email = session()->get('email') ?? 'Guest';

    // 🔥 Log aktivitas akses halaman tambah user
    $logModel->log_activity($userId, $email, "Mengakses halaman Tambah User");

    echo view('header');
    echo view('tambahuser');
    echo view('footer');
}

public function restore_user($id)
{
    $logModel = new M_belajar();
    $MKasir = new M_belajar();
    $MKasir->restore('user', 'id_user', $id);

    // 🔥 Log aktivitas restore user
    $userId = session()->get('id');
    $email = session()->get('email') ;
    $logModel->log_activity($userId, $email, "Mengembalikan user dengan ID $id");

    return redirect()->to('home/user');
}

public function delete_permanently_user($id)
{
    $logModel = new M_belajar();
    $MKasir = new M_belajar();
    $MKasir->hard_delete('user', 'id_user', $id);

    // 🔥 Log aktivitas hapus permanen user
    $userId = session()->get('id');
    $email = session()->get('email');
    $logModel->log_activity($userId, $email, "Menghapus permanen user dengan ID $id");

    return redirect()->to('home/user');
}

public function edit_user($id)
{
    $logModel = new M_belajar();
    $Sim = new M_belajar();
    $wece = array('id_user' => $id);
    $chichi['es1'] = $Sim->getWhere('user', $wece);

    // 🔥 Log aktivitas edit user
    $userId = session()->get('id');
    $email = session()->get('email') ?? 'Guest';
    $logModel->log_activity($userId, $email, "Mengakses halaman Edit User dengan ID $id");

    echo view('header');
   
    echo view('edituser', $chichi);
    echo view('footer');
}

public function hapus_user($id)
{
    $logModel = new M_belajar();
    $Sim = new M_belajar();
    $Sim->soft_delete('user', 'id_user', $id);

    // 🔥 Log aktivitas hapus user
    $userId = session()->get('id');
    $email = session()->get('email') ?? 'Guest';
    $logModel->log_activity($userId, $email, "Menghapus user dengan ID $id (Soft Delete)");

    return redirect()->to('home/user');
}

public function simpan_user()
{
    $logModel = new M_belajar();
    $Sim = new M_belajar();

    $a = $this->request->getPost('username');
    $b = $this->request->getPost('password');
    $c = $this->request->getPost('role');
    $d = $this->request->getPost('email');
    $id = $this->request->getPost('id');

    $wece = array('id_user' => $id);
    $data = array(
        "username" => $a,
        "password" => MD5($b),
        "role" => $c,
        "email" => $d
    );

    $Sim->input('user', $data, $wece);

    // 🔥 Log aktivitas simpan user
    $userId = session()->get('id');
    $email = session()->get('email') ?? 'Guest';
    $logModel->log_activity($userId, $email, "Menyimpan data User dengan email $d");

    return redirect()->to('home/user');
}
public function dokter()
{
    // Pastikan session ID tersedia (user sudah login)
    if (session()->get('id') > 0) {
        $logModel = new M_belajar();
        $Sim = new M_belajar();

        // Ambil data dokter dengan join tabel dokter dan user
        $chichi['dokter_data'] = $Sim->joinRPL12('dokter', 'user', 'dokter.id_user = user.id_user');
        $chichi['RPL12A'] = $Sim->getAllUsers();

        // 🔥 Log aktivitas mengakses halaman dokter
        $userId = session()->get('id');
        $email = session()->get('email') ?? 'Guest';
        $logModel->log_activity($userId, $email, "Mengakses halaman Dokter");

        // Tampilkan halaman dengan data yang sudah diambil
        echo view('header');
        echo view('tampilandokter', $chichi); // ✅ dokter_data sekarang cocok
        echo view('footer');
    } else {
        // Pengalihan jika tidak ada session ID atau jika level > 0
        if (session()->get('level') > 0) {
            return redirect()->to('/error');
        } else {
            return redirect()->to('home/login');
        }
    }
}


public function simpan_dokter()
{
    $logModel = new M_belajar();
    $Sim = new M_belajar();

    // Ambil data dari form
    $id_user = $this->request->getPost('id_user');
    $no_telepon = $this->request->getPost('no_telepon');
    $nama_dokter = $this->request->getPost('nama_dokter');
    $spesialisasi = $this->request->getPost('spesialisasi');
    $nip = $this->request->getPost('nip');
    $alamat = $this->request->getPost('alamat');

    // Menangani foto dokter
    $foto = '';
    if ($this->request->getFile('foto')->isValid()) {
        $file = $this->request->getFile('foto');
        $foto = $file->getRandomName();
        if ($file->move('uploads', $foto)) {
            // Foto berhasil dipindahkan
        } else {
            // Gagal memindahkan foto
            log_message('error', 'Gagal memindahkan foto');
        }
    }

    // Siapkan data untuk disimpan
    $data = array(
        "id_user" => $id_user,
        "no_telepon" => $no_telepon,
        "nama_dokter" => $nama_dokter,
        "spesialisasi" => $spesialisasi,
        "nip" => $nip,
        "alamat" => $alamat,
        "foto" => $foto // Foto yang sudah diproses
    );

    // Debug log untuk memastikan data yang dikirim ke database
    log_message('debug', 'Data yang akan disimpan: ' . print_r($data, true));

    // Simpan data dokter
    if ($Sim->input('dokter', $data)) {
        // 🔥 Log aktivitas simpan dokter
        $userId = session()->get('id');
        $email = session()->get('email') ?? 'Guest';
        $logModel->log_activity($userId, $email, "Menambahkan dokter dengan ID User $id_user");
    } else {
        log_message('error', 'Gagal menyimpan data ke database');
        echo redirect()->back()->with('error', 'Gagal menyimpan data dokter');
    }

    echo redirect()->to('home/dokter');
}

public function edit_dokter($id)
{
    $model = new M_belajar();
    $data['es1'] = $model->getDokterById($id);
    $data['RPL12A'] = $model->getAllUsers();
    echo view('editdokter', $data);
}

// Menyimpan perubahan data dokter
public function aksi_e_dokter()
{
    $logModel = new M_belajar();
    $Sim = new M_belajar();

    // Ambil data dari form
    $id_dokter = $this->request->getPost('id_dokter');
    $id_user = $this->request->getPost('id_user');
    $no_telepon = $this->request->getPost('no_telepon');
    $nama_dokter = $this->request->getPost('nama_dokter');
    $spesialisasi = $this->request->getPost('spesialisasi');
    $nip = $this->request->getPost('nip');
    $alamat = $this->request->getPost('alamat');

    // Menangani upload foto
    $foto = $this->request->getPost('existing_foto'); // Ambil foto yang sudah ada
    if ($this->request->getFile('foto')->isValid()) {
        $file = $this->request->getFile('foto');
        $foto = $file->getRandomName();
        $file->move('uploads', $foto);
    }

    // Siapkan data untuk update
    $wece = array('id_dokter' => $id_dokter);
    $data = array(
        "id_user" => $id_user,
        "no_telepon" => $no_telepon,
        "nama_dokter" => $nama_dokter,
        "spesialisasi" => $spesialisasi,
        "nip" => $nip,
        "alamat" => $alamat,
        "foto" => $foto // Foto baru jika ada
    );

    // Update data dokter
    if ($Sim->edit('dokter', $data, $wece)) {
        // 🔥 Log aktivitas update dokter
        $userId = session()->get('id');
        $email = session()->get('email') ?? 'Guest';
        $logModel->log_activity($userId, $email, "Memperbarui data dokter ID $id_dokter");
    } else {
        return redirect()->back()->with('error', 'Gagal memperbarui data dokter');
    }

    return redirect()->to('home/dokter');
}

public function tambahdokter()
{
    $Sim = new M_belajar(); // Pastikan menggunakan model yang sesuai
    $data['RPL12A'] = $Sim->getAllUsers(); // Mengambil daftar akun user yang bisa dipilih

    // Mengirim data ke view
    echo view('header');
    echo view('tambahdokter', $data); // Kirimkan data RPL12A ke view
    echo view('footer');
}


public function hapus_dokter($id)
{
    $logModel = new M_belajar();
    $Sim = new M_belajar();
    $Sim->soft_delete('dokter', 'id_dokter', $id);

    // 🔥 Log aktivitas hapus dokter
    $userId = session()->get('id');
    $email = session()->get('email') ?? 'Guest';
    $logModel->log_activity($userId, $email, "Menghapus dokter dengan ID $id (Soft Delete)");

    return redirect()->to('home/dokter');
}
public function jadwal()
{
    if (session()->get('id') > 0) {
        $Sim = new M_belajar;

        // Contoh: menampilkan jadwal dengan join ke dokter
        $chichi['rpl12'] = $Sim->joinRPL12('jadwal', 'dokter', 'jadwal.id_dokter = dokter.id_dokter');

        // Tampilkan view
        echo view('header');
        echo view('tampilanjadwal', $chichi); // Ganti sesuai nama file view jadwal kamu
        echo view('footer');
    } else if (session()->get('level') > 0) {
        return redirect()->to('/error');
    } else {
        return redirect()->to('home/login');
    }
}

public function tambahjadwal()
{
    $Sim = new M_belajar;
    
    // Ambil data dokter, bukan karyawan
    $data['RPL12A'] = $Sim->getAllDokter(); 

    echo view('header');
    echo view('tambahjadwal', $data); 
    echo view('footer');
}

public function simpan_jadwal()
{
    // Ambil data dari form
    $id_dokter   = $this->request->getPost('id_dokter');
    $hari        = $this->request->getPost('hari');
    $jam_mulai   = $this->request->getPost('jam_mulai');
    $jam_selesai = $this->request->getPost('jam_selesai');

    // Siapkan data untuk disimpan
    $data = array(
        "id_dokter"   => $id_dokter,
        "hari"        => $hari,
        "jam_mulai"   => $jam_mulai,
        "jam_selesai" => $jam_selesai,
    );

    // Simpan ke database
    $Sim = new M_belajar;
    $Sim->input('jadwal', $data);

    // Log aktivitas
    $this->log_activity(session()->get('id'), "Menambahkan jadwal untuk dokter ID $id_dokter pada hari $hari");

    // Redirect kembali ke halaman jadwal
    return redirect()->to('home/jadwal');
}


public function edit_jadwal($id)
{
    $Sim = new M_belajar;

    // Ambil data jadwal berdasarkan ID
    $wece = ['id_jadwal' => $id];
    $chichi['jadwal'] = $Sim->getWhere('jadwal', $wece);

    // Ambil semua data dokter untuk select option
    $chichi['RPL12A'] = $Sim->getAllDokter();  // Ubah ke getAllDokter() jika ini adalah method yang benar

    // Tampilkan tampilan edit jadwal
    echo view('header');
    echo view('menu');
    echo view('editjadwal', $chichi); 
    echo view('footer');
}

public function aksi_e_jadwal()
{
    $id_jadwal = $this->request->getPost('id_jadwal');
    $hari = $this->request->getPost('hari');
    $jam_mulai = $this->request->getPost('jam_mulai');
    $jam_selesai = $this->request->getPost('jam_selesai');
    $id_dokter = $this->request->getPost('id_dokter');
    $keterangan = $this->request->getPost('keterangan');

    $data = array(
        "hari" => $hari,
        "jam_mulai" => $jam_mulai,
        "jam_selesai" => $jam_selesai,
        "id_dokter" => $id_dokter,
        "keterangan" => $keterangan
    );

    $Sim = new M_belajar;
    $where = array('id_jadwal' => $id_jadwal);
    $Sim->edit('jadwal', $data, $where);

    // Log aktivitas
    $this->log_activity(session()->get('id'), "Mengedit jadwal dengan ID $id_jadwal");

    return redirect()->to('home/jadwal');
}


public function hapus_jadwal($id)
{
    $Sim = new M_belajar;

    // Validasi ID jadwal
    if (!$id || !is_numeric($id)) {
        return redirect()->back()->with('error', 'ID jadwal tidak valid.');
    }

    // Hapus data jadwal berdasarkan ID
    $where = ['id_jadwal' => $id];
    $berhasil = $Sim->hapus('jadwal', $where);

    // Log aktivitas jika berhasil
    if ($berhasil) {
        $this->log_activity(session()->get('id'), "Menghapus jadwal dengan ID $id");
        return redirect()->to('home/jadwal')->with('success', 'Jadwal berhasil dihapus.');
    } else {
        return redirect()->back()->with('error', 'Gagal menghapus jadwal.');
    }
}
public function pasien()
{
    $Sim = new M_belajar;
    $data['pasien'] = $Sim->getData('pasien'); // Ambil semua data dari tabel layanan

    echo view('header');
    echo view('tampilanpasien', $data); // nama view: layanan.php
    echo view('footer');
}
  public function tambahpasien()
    {
        // Memanggil model M_belajar untuk mendapatkan data user
        $userModel = new M_belajar();

        // Ambil data user dari tabel 'user' dan urutkan berdasarkan id_user
        $data['user'] = $userModel->tampil('user', 'id_user');

        // Siapkan data untuk form pasien (kosongkan field untuk form tambah)
        $data['es1'] = (object)[
            'id_pasien' => '',
            'nama' => '',
            'nik' => '',
            'jenis_kelamin' => '',
            'tanggal_lahir' => '',
            'alamat' => '',
            'no_hp' => '',
            'id_user' => ''
        ];

        // Kirimkan data ke view
        echo view('header');
        echo view('tambahpasien', $data);
        echo view('footer');
    }

    // Method untuk menyimpan data pasien
public function simpan1()
{
    // Ambil data yang dikirim melalui form
    $nama = $this->request->getPost('nama');
    $nik = $this->request->getPost('nik');
    $jenis_kelamin = $this->request->getPost('jenis_kelamin');
    $tanggal_lahir = $this->request->getPost('tanggal_lahir');
    $alamat = $this->request->getPost('alamat');
    $no_hp = $this->request->getPost('no_hp');
    $id_user = $this->request->getPost('id_user');

    // Siapkan data untuk disimpan ke dalam database
    $data = [
        'nama' => $nama,
        'nik' => $nik,
        'jenis_kelamin' => $jenis_kelamin, // Pastikan ini L atau P
        'tanggal_lahir' => $tanggal_lahir,
        'alamat' => $alamat,
        'no_hp' => $no_hp,
        'id_user' => $id_user
    ];

    // Gunakan model untuk menyimpan data
    $pasienModel = new \App\Models\M_belajar(); // Gunakan model M_belajar seperti yang Anda gunakan
    if ($pasienModel->input('pasien', $data)) { // Pastikan nama tabel adalah 'pasien'
        // Jika data berhasil disimpan
        return redirect()->to('/Home/pasien')->with('success', 'Data pasien berhasil disimpan!');
    } else {
        // Jika terjadi kesalahan
        return redirect()->back()->with('error', 'Gagal menyimpan data pasien');
    }
}
public function hapus_pasien($id)
{
    $Sim = new M_belajar;

    // Validasi ID layanan
    if (!$id || !is_numeric($id)) {
        return redirect()->back()->with('error', 'ID layanan tidak valid.');
    }

    // Hapus data layanan berdasarkan ID
    $where = ['id_pasien' => $id];
    $berhasil = $Sim->hapus('pasien', $where);

    // Log aktivitas jika berhasil
    if ($berhasil) {
        $this->log_activity(session()->get('id'), "Menghapus layanan dengan ID $id");
        return redirect()->to('home/pasien')->with('success', 'Layanan berhasil dihapus.');
    } else {
        return redirect()->back()->with('error', 'Gagal menghapus layanan.');
    }
}
public function edit_pasien($id)
{
    $Sim = new M_belajar;

    // Ambil data pasien berdasarkan ID
    $where = ['id_pasien' => $id];
    $data['es1'] = $Sim->getWhere('pasien', $where);

    // Ambil semua data user untuk select option
    $data['RPL12A'] = $Sim->db->table('user')->get()->getResult();
  echo view('header');

    // Tampilkan tampilan edit pasien
    echo view('editpasien', $data);
    echo view('footer');
}public function aksi_e_pasien()
{
    $Sim = new M_belajar;

    // Ambil data dari request
    $data = [
        'id_user' => $this->request->getPost('u'),
        'nama' => $this->request->getPost('nama_pasien'),
        'nik' => $this->request->getPost('nik'),
        'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        'tanggal_lahir' => $this->request->getPost('tgl_lahir'),
        'alamat' => $this->request->getPost('alamat'),
        'no_hp' => $this->request->getPost('no_hp'),
    ];

    // Pastikan id_pasien ada dan valid
    $id_pasien = $this->request->getPost('id_pasien');
    if (empty($id_pasien)) {
        return redirect()->back()->with('error', 'ID Pasien tidak ditemukan.');
    }

    // Update data pasien
    $updated = $Sim->edit('pasien', $data, ['id_pasien' => $id_pasien]);

    if ($updated) {
        return redirect()->to('home/pasien')->with('success', 'Data pasien berhasil diperbarui.');
    } else {
        return redirect()->back()->with('error', 'Gagal memperbarui data pasien.');
    }
}



// Menampilkan data layanan
public function layanan()
{
    $Sim = new M_belajar;
    $data['layanan'] = $Sim->getData('layanan'); // Ambil semua data dari tabel layanan

    echo view('header');
    echo view('tampilanlayanan', $data); // nama view: layanan.php
    echo view('footer');
}
public function tambahlayanan(){
    echo view('header');
    echo view('tambahlayanan');
    echo view('footer');
}public function simpan_layanan()
{
    $db = \Config\Database::connect();
    $builder = $db->table('layanan');

    // Ambil data dari form
    $nama_layanan = $this->request->getPost('nama_layanan');
    $deskripsi = $this->request->getPost('deskripsi');
    $harga = str_replace(['Rp', '.', ','], '', $this->request->getPost('harga'));
    $userId = session()->get('id');
    $username = session()->get('u');

    // Validasi harga
    if (!is_numeric($harga)) {
        return redirect()->back()->with('error', 'Harga harus berupa angka!');
    }

    // Validasi input
    if (empty($nama_layanan) || empty($deskripsi)) {
        return redirect()->back()->with('error', 'Semua field harus diisi');
    }

    // Proses upload foto
    if (!is_dir('uploads/layanan/')) {
        mkdir('uploads/layanan/', 0777, true);
    }

    $foto = $this->request->getFile('foto');
    if ($foto->isValid() && !$foto->hasMoved()) {
        $newName = $foto->getRandomName();
        $foto->move('uploads/layanan/', $newName);
    } else {
        return redirect()->back()->with('error', 'Gagal mengupload foto.');
    }

    // Siapkan data untuk disimpan
    $data = [
        'nama_layanan' => $nama_layanan,
        'deskripsi' => $deskripsi,
        'harga' => $harga,
        'foto' => $newName
    ];

    // Simpan data ke database
    $builder->insert($data);

    // Log aktivitas
    $builderLog = $db->table('log_aktivitas');
    $builderLog->insert([
        'user_id'   => $userId,
        'username'  => $username,
        'aktivitas' => "Menambahkan layanan baru: {$nama_layanan}",
        'waktu'     => date('Y-m-d H:i:s')
    ]);

    return redirect()->to(base_url('home/layanan'))->with('success', 'Layanan berhasil ditambahkan!');
}
public function edit_layanan($id)
{
    $Sim = new M_belajar;

    // Ambil data layanan berdasarkan ID
    $wece = ['id_layanan' => $id];
    $layanan = $Sim->getWhere('layanan', $wece);

    // Cek apakah data layanan ditemukan
    if (empty($layanan)) {
        return redirect()->to(base_url('home/layanan'))->with('error', 'Layanan tidak ditemukan!');
    }

    // Kirim data layanan ke view (akses data dengan ->)
    $data['es1'] = $layanan;  // Langsung assign objek ke view

    echo view('header');
    echo view('editlayanan', $data);  // Kirim ke view editlayanan
    echo view('footer');
}


public function simpan_layanan1()
{
    $db = \Config\Database::connect();
    $builder = $db->table('layanan');

    // Ambil data dari form
    $id_layanan = $this->request->getPost('id');
    $nama_layanan = $this->request->getPost('nama_layanan');
    $deskripsi = $this->request->getPost('deskripsi');
    $harga = str_replace(['Rp', '.', ','], '', $this->request->getPost('harga'));
    
    // Validasi input
    if (empty($nama_layanan) || empty($deskripsi) || empty($harga)) {
        return redirect()->back()->with('error', 'Semua field harus diisi!');
    }

    // Pastikan harga adalah angka
    if (!is_numeric($harga)) {
        return redirect()->back()->with('error', 'Harga harus berupa angka!');
    }

    // Proses upload foto jika ada
    $foto = $this->request->getFile('foto');
    if ($foto && $foto->isValid()) {
        $folderPath = 'uploads/layanan/';
        $fileName = $foto->getRandomName();
        $fotoPath = $folderPath . $fileName;

        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $foto->move($folderPath, $fileName);
    } else {
        $fotoPath = null; // Jika tidak ada foto baru, biarkan null
    }

    // Siapkan data untuk disimpan
    $data = [
        'nama_layanan' => $nama_layanan,
        'deskripsi' => $deskripsi,
        'harga' => $harga,
    ];

    // Jika ada foto baru, tambahkan ke data
    if ($fotoPath) {
        $data['foto'] = $fotoPath;
    }

    // Simpan perubahan ke database
    $builder->update($data, ['id_layanan' => $id_layanan]);

    // Log aktivitas
    $userId = session()->get('id');
    $username = session()->get('u');
    $builderLog = $db->table('log_aktivitas');
    $builderLog->insert([
        'user_id'   => $userId,
        'username'  => $username,
        'aktivitas' => "Mengubah layanan {$nama_layanan} dengan ID {$id_layanan}",
        'waktu'     => date('Y-m-d H:i:s')
    ]);

    return redirect()->to(base_url('home/layanan'))->with('success', 'Layanan berhasil diupdate!');
}
public function hapus_layanan($id)
{
    $Sim = new M_belajar;

    // Validasi ID layanan
    if (!$id || !is_numeric($id)) {
        return redirect()->back()->with('error', 'ID layanan tidak valid.');
    }

    // Hapus data layanan berdasarkan ID
    $where = ['id_layanan' => $id];
    $berhasil = $Sim->hapus('layanan', $where);

    // Log aktivitas jika berhasil
    if ($berhasil) {
        $this->log_activity(session()->get('id'), "Menghapus layanan dengan ID $id");
        return redirect()->to('home/layanan')->with('success', 'Layanan berhasil dihapus.');
    } else {
        return redirect()->back()->with('error', 'Gagal menghapus layanan.');
    }
}

public function pengaturan()
{
    $db = db_connect();
    $pengaturan = $db->table('pengaturan_app')->get()->getRow();

    // Log activity
    $this->log_activity(session()->get('id'), "Melihat pengaturan aplikasi");

    return view('pengaturan', ['pengaturan' => $pengaturan]);
}

public function simpan_pengaturan()
{
    $db = db_connect();
    $builder = $db->table('pengaturan_app');

    $data = [
        'judul' => $this->request->getPost('judul'),
        'owner' => $this->request->getPost('owner'),
        'nama_app' => $this->request->getPost('nama_app'),
    ];

    // Proses Upload Logo
    $logo = $this->request->getFile('logo');
    if ($logo && $logo->isValid() && !$logo->hasMoved()) {
        $newName = $logo->getRandomName();
        $logo->move('uploads/', $newName); // Simpan ke public/uploads/

        // Ambil data pengaturan yang sudah ada
        $pengaturan = $builder->get()->getRow();
        if (!empty($pengaturan->logo) && file_exists('uploads/' . $pengaturan->logo)) {
            unlink('uploads/' . $pengaturan->logo); // Hapus logo lama
        }

        $data['logo'] = $newName;
    }

    // Update atau insert data
    if ($builder->countAll() > 0) {
        $builder->update($data);
    } else {
        $builder->insert($data);
    }

    // Log activity
    $this->log_activity(session()->get('id'), "Menyimpan pengaturan aplikasi");

    return redirect()->to('home/hai')->with('success', 'Pengaturan berhasil disimpan.');
}

public function tabelpt()
{
    $kevin = new M_belajar();
    $a = $this->request->getPost('tanggalawal');
    $b = $this->request->getPost('tanggalakhir');

    $data['chelsica'] = $kevin->filter3($a, $b);

    // Log activity
    $this->log_activity(session()->get('id'), "Melihat tabel PT dengan tanggal dari $a sampai $b");

    return view('tabelpt', $data);
}

public function laporan_transaksi()
{
    // Log activity
    $this->log_activity(session()->get('id'), "Melihat laporan transaksi");

    echo view('header');
    echo view('menu');
    echo view('LPT');
    echo view('footer');
}
public function forgorpass()
    {
        echo view ('forgorpass');
        
    }

public function forgot_password()
{
    $Sim = new M_belajar();
    $email = $this->request->getPost('email');

    // Check if the email exists in the database
    $user = $Sim->getWhere('user', ['email' => $email]);

    if (!$user || !is_object($user)) {
        echo "No user found with this email.";
        return;
    }

    // Generate token and expiry
    $token = bin2hex(random_bytes(16));
    $token_hash = hash("sha256", $token);
    $expiry = date("Y-m-d H:i:s", strtotime("+20 minutes"));

    // Save token to the database
    $Sim->edit('user', [
        'token' => $token_hash,
        'expiry' => $expiry
    ], ['email' => $email]);

    // Reset link
    $resetLink = base_url("/home/reset_password?token=$token");

    // Create email content
    $subject = "Password Reset Request";
    $message = "
    <html>
    <head>
        <title>Password Reset Request</title>
    </head>
    <body>
        <p>Yahoo~,</p>
        <p>Seems like you have requested to reset your password. Click the link below, okay?~:</p>
        <p><a href='$resetLink' style='color: blue;'>Reset Password</a></p>
        <p>If you did not request this, ignore this email!</p>
        <p>Sincerely,</p>
        <p>Elysia <3</p>
    </body>
    </html>
    ";

    // Send the email using PHPMailer
   // Menggunakan PHPMailer untuk mengirim email
$mail = new PHPMailer(true);
try {
    // Set up SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // SMTP server Gmail
    $mail->SMTPAuth   = true;
    $mail->Username   = 'budijesen44@gmail.com'; // Alamat email Anda
    $mail->Password   = 'cuxy rumc gxab rsda';  // App Password Anda
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Pengirim dan penerima
    $mail->setFrom('youremail@gmail.com', 'Your Website');
    $mail->addAddress($email);  

    // Isi email
    $mail->isHTML(true);                                 
    $mail->Subject = $subject;
    $mail->Body    = $message;

    // Kirim email
    $mail->send();

    $data['message'] = "A password reset link has been sent to your email.";
    $data['type'] = "success";
    return view('status_view', $data); // Render success view
} catch (Exception $e) {
    $data['message'] = "Failed to send email. Error: {$mail->ErrorInfo}";
    $data['type'] = "error";
    return view('status_view', $data); // Render error view
}

}

public function reset_password()
{
    $Sim = new M_belajar();
    $token = $_GET['token'] ?? '';
    $token_hash = hash('sha256', $token); // Hash the token from the URL

    // Validate the token
    $reset = $Sim->getWhere('user', ['token' => $token_hash]);

    if (!$reset || !is_object($reset) || strtotime($reset->expiry) < time()) {
        $data['message'] = "Invalid or expired token.";
        return view('error_view', $data); // Render an error view
    }

    // Pass token to the view for the form
    $data['token'] = $token;
    return view('reset_password_view', $data); // Render the reset password view
}

public function update_password()
{
    $Sim = new M_belajar();
    $token = $_GET['token'] ?? '';
    $token_hash = hash('sha256', $token); // Ensure token is hashed consistently
    $password = $this->request->getPost('password');
    $confirmPassword = $this->request->getPost('confirm_password');

    if ($password !== $confirmPassword) {
        $data['message'] = "Passwords do not match.";
        $data['type'] = "error";
        return view('status_view', $data); // Render error view
    }

    // Set the correct timezone for comparison
    date_default_timezone_set('Asia/Jakarta');

    // Validate the token
    $reset = $Sim->getWhere('user', ['token' => $token_hash]);

    if (!$reset || !is_object($reset) || strtotime($reset->expiry) < time()) {
        $data['message'] = "Invalid or expired token.";
        $data['type'] = "error";
        return view('status_view', $data); // Render error view
    }

    // Hash the new password
    $hashedPassword = md5($password);

    // Update the user's password
    $Sim->edit('user', ['password' => $hashedPassword], ['email' => $reset->emil]);

    // Delete the reset token
    $Sim->edit('user', ['token' => null, 'expiry' => null], ['email' => $reset->email]);

    $data['message'] = "Your password has been updated successfully.";
    $data['type'] = "success";
    return view('status_view', $data); // Render success view
}



}



