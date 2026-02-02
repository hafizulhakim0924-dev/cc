<?php
/* ================= GENERATE LEADERBOARD - 2000 PESERTA ================= */
error_reporting(E_ALL);
ini_set('display_errors', 1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli(
        "localhost",
        "ypikhair_cc",
        "Hakim123!",
        "ypikhair_cc"
    );
    $conn->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    die("DB ERROR: " . $e->getMessage());
}

function esc($s){
    return mysqli_real_escape_string($GLOBALS['conn'], $s);
}

// Data dummy untuk generate
$nama_depan = ['Ahmad', 'Budi', 'Citra', 'Dewi', 'Eko', 'Fajar', 'Gita', 'Hadi', 'Indra', 'Joko', 
               'Kartika', 'Lina', 'Maya', 'Nina', 'Oki', 'Putri', 'Rina', 'Sari', 'Tono', 'Udin',
               'Vina', 'Wati', 'Yoga', 'Zaki', 'Ayu', 'Bayu', 'Cinta', 'Dani', 'Eka', 'Fani',
               'Gina', 'Hani', 'Ika', 'Jaya', 'Kiki', 'Lia', 'Mira', 'Nita', 'Odi', 'Puji',
               'Rani', 'Sinta', 'Tina', 'Umi', 'Vera', 'Wira', 'Yani', 'Zara', 'Ade', 'Bima'];

$nama_belakang = ['Santoso', 'Wijaya', 'Kurniawan', 'Prasetyo', 'Sari', 'Putra', 'Sari', 'Kusuma', 
                  'Rahayu', 'Saputra', 'Lestari', 'Hidayat', 'Nugroho', 'Sari', 'Purnama',
                  'Wibowo', 'Sari', 'Maulana', 'Sari', 'Pratama', 'Sari', 'Ramadhan', 'Sari',
                  'Sari', 'Sari', 'Sari', 'Sari', 'Sari', 'Sari', 'Sari'];

$sekolah = [
    'SMP Negeri 1 Padang', 'SMP Negeri 2 Padang', 'SMP Negeri 3 Padang', 'SMP Negeri 4 Padang',
    'SMP Negeri 5 Padang', 'SMP Negeri 6 Padang', 'SMP Negeri 7 Padang', 'SMP Negeri 8 Padang',
    'SMP Negeri 9 Padang', 'SMP Negeri 10 Padang', 'SMP Negeri 11 Padang', 'SMP Negeri 12 Padang',
    'SMP Swasta Al-Azhar', 'SMP Swasta Muhammadiyah', 'SMP Swasta Yayasan', 'SMP Swasta Islam',
    'SMP Swasta Katolik', 'SMP Swasta Kristen', 'SMP Swasta Terpadu', 'SMP Swasta Plus',
    'SMP Negeri 1 Bukittinggi', 'SMP Negeri 2 Bukittinggi', 'SMP Negeri 1 Payakumbuh',
    'SMP Negeri 1 Pariaman', 'SMP Negeri 1 Solok', 'SMP Negeri 1 Sawahlunto',
    'SMP Negeri 1 Padang Panjang', 'SMP Negeri 1 Lubuk Basung', 'SMP Negeri 1 Painan',
    'SMP Negeri 1 Muara', 'SMP Negeri 1 Sijunjung', 'SMP Negeri 1 Tanah Datar',
    'SMP Negeri 1 Agam', 'SMP Negeri 1 Lima Puluh Kota', 'SMP Negeri 1 Pasaman',
    'SMP Negeri 1 Pesisir Selatan', 'SMP Negeri 1 Kepulauan Mentawai', 'SMP Negeri 1 Dharmasraya',
    'SMP Negeri 1 Solok Selatan', 'SMP Negeri 1 Padang Pariaman'
];

$kelas_list = ['VII A', 'VII B', 'VII C', 'VIII A', 'VIII B', 'VIII C', 'IX A', 'IX B', 'IX C'];

// Cek apakah ada parameter clear
$clear_old = isset($_GET['clear']) && $_GET['clear'] == '1';

// Jika clear old data
if($clear_old){
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Clear Data - Padang Creative Center</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                max-width: 800px;
                margin: 50px auto;
                padding: 20px;
                background: #f5f5f5;
            }
            .container {
                background: white;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h1>Membersihkan Data Lama</h1>";
    
    // Hapus jawaban dulu (foreign key)
    // Ambil dulu semua user_id
    $q_user_ids = $conn->query("SELECT id FROM users WHERE role='user' AND username LIKE 'peserta%'");
    $user_ids = [];
    while($row = $q_user_ids->fetch_assoc()){
        $user_ids[] = $row['id'];
    }
    
    if(count($user_ids) > 0){
        $user_ids_str = implode(',', $user_ids);
        $conn->query("DELETE FROM jawaban WHERE user_id IN ($user_ids_str)");
    }
    
    // Hapus user
    $result = $conn->query("DELETE FROM users WHERE role='user' AND username LIKE 'peserta%'");
    $deleted = $conn->affected_rows;
    
    echo "<p>Data lama telah dihapus: $deleted user</p>";
    echo "<p><a href='generate_leaderboard.php'>Kembali ke Generate</a></p>";
    echo "</div></body></html>";
    $conn->close();
    exit;
}

echo "<!DOCTYPE html>
<html>
<head>
    <title>Generate Leaderboard - Padang Creative Center</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
        }
        .progress {
            background: #f0f0f0;
            border-radius: 10px;
            padding: 10px;
            margin: 10px 0;
        }
        .progress-bar {
            background: #4CAF50;
            height: 20px;
            border-radius: 10px;
            text-align: center;
            color: white;
            line-height: 20px;
        }
        .success {
            color: #4CAF50;
            font-weight: bold;
        }
        .error {
            color: #f5576c;
        }
        .warning {
            background: #fff3cd;
            border: 1px solid #ffc107;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #2196F3;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px;
        }
        .btn-danger {
            background: #f5576c;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h1>Generate Leaderboard - 2000 Peserta</h1>";

// Cek apakah sudah ada data peserta
$q_check = $conn->query("SELECT COUNT(*) as total FROM users WHERE role='user' AND username LIKE 'peserta%'");
$existing = $q_check->fetch_assoc()['total'];

if($existing > 0){
    echo "<div class='warning'>
            <strong>Peringatan!</strong> Sudah ada $existing peserta dengan username 'peserta%' di database.
            <br><br>
            <a href='generate_leaderboard.php?clear=1' class='btn btn-danger' onclick='return confirm(\"Yakin ingin menghapus data lama?\")'>Hapus Data Lama</a>
            <a href='generate_leaderboard.php?generate=1' class='btn'>Lanjutkan Generate (Akan Duplikat)</a>
          </div>";
    
    if(!isset($_GET['generate'])){
        echo "</div></body></html>";
        $conn->close();
        exit;
    }
}

echo "<p>Memulai proses generate peserta...</p>";

$total_peserta = 2000;
$berhasil = 0;
$gagal = 0;
$batch_size = 100; // Insert dalam batch untuk performa lebih baik

// Mulai transaksi
$conn->begin_transaction();

try {
    $values = [];
    
    for($i = 1; $i <= $total_peserta; $i++){
        // Generate data random
        $nama_depan_random = $nama_depan[array_rand($nama_depan)];
        $nama_belakang_random = $nama_belakang[array_rand($nama_belakang)];
        $nama = $nama_depan_random . ' ' . $nama_belakang_random . ' ' . $i;
        $username = 'peserta' . $i;
        $password = md5('password123'); // Password default untuk semua
        $sekolah_random = $sekolah[array_rand($sekolah)];
        $kelas_random = $kelas_list[array_rand($kelas_list)];
        $nis = 'NIS' . str_pad($i, 6, '0', STR_PAD_LEFT);
        
        // Generate rank yang bervariasi dengan distribusi normal
        // Semakin tinggi rank, semakin sedikit yang mendapat skor tinggi
        // Distribusi: beberapa dengan skor tinggi, banyak dengan skor sedang, banyak dengan skor rendah
        $random = rand(1, 100);
        
        if($random <= 1){
            // 1% mendapat skor sangat tinggi (450-500)
            $rank = rand(450, 500);
        } elseif($random <= 5){
            // 4% mendapat skor tinggi (400-450)
            $rank = rand(400, 450);
        } elseif($random <= 15){
            // 10% mendapat skor tinggi-sedang (350-400)
            $rank = rand(350, 400);
        } elseif($random <= 35){
            // 20% mendapat skor sedang-tinggi (250-350)
            $rank = rand(250, 350);
        } elseif($random <= 60){
            // 25% mendapat skor sedang (150-250)
            $rank = rand(150, 250);
        } elseif($random <= 85){
            // 25% mendapat skor sedang-rendah (80-150)
            $rank = rand(80, 150);
        } else {
            // 15% mendapat skor rendah (0-80)
            $rank = rand(0, 80);
        }
        
        // Status terakhir bervariasi
        $status_options = [
            'Selesai IPA SMP', 'Selesai IPS SMP', 'Selesai MTK SMP', 
            'Selesai IPA SMA', 'Selesai IPS SMA', 'Selesai MTK SMA',
            'Selesai Fisika SMP', 'Selesai Coding SMP', 'Selesai Robotik SMP'
        ];
        $status_terakhir = $status_options[array_rand($status_options)];
        
        // Escape semua data
        $nama_esc = esc($nama);
        $username_esc = esc($username);
        $sekolah_esc = esc($sekolah_random);
        $kelas_esc = esc($kelas_random);
        $nis_esc = esc($nis);
        $status_esc = esc($status_terakhir);
        
        // Tambahkan ke batch
        $values[] = "('$username_esc', '$password', '$nama_esc', '$kelas_esc', '$nis_esc', '$sekolah_esc', 'user', $rank, '$status_esc')";
        
        // Insert batch setiap $batch_size atau di akhir
        if(count($values) >= $batch_size || $i == $total_peserta){
            $sql = "INSERT INTO users(username, password, nama, kelas, nis, sekolah, role, rank, status_terakhir)
                    VALUES " . implode(', ', $values);
            
            if($conn->query($sql)){
                $berhasil += count($values);
                
                // Progress update
                $progress = ($i / $total_peserta) * 100;
                echo "<div class='progress'>
                        <div class='progress-bar' style='width: $progress%'>$i / $total_peserta ($progress%) - Berhasil: $berhasil</div>
                      </div>";
                flush();
                ob_flush();
            } else {
                $gagal += count($values);
                echo "<p class='error'>Error pada batch $i: " . $conn->error . "</p>";
            }
            
            // Reset batch
            $values = [];
        }
    }
    
    // Commit transaksi
    $conn->commit();
    
    echo "<div class='progress'>
            <div class='progress-bar' style='width: 100%'>Selesai!</div>
          </div>";
    
    echo "<h2 class='success'>✓ Generate Selesai!</h2>";
    echo "<p><strong>Total Peserta:</strong> $total_peserta</p>";
    echo "<p class='success'><strong>Berhasil:</strong> $berhasil peserta</p>";
    if($gagal > 0){
        echo "<p class='error'><strong>Gagal:</strong> $gagal peserta</p>";
    }
    
    // Tampilkan statistik
    $q_total = $conn->query("SELECT COUNT(*) as total FROM users WHERE role='user'");
    $total_user = $q_total->fetch_assoc()['total'];
    
    $q_max = $conn->query("SELECT MAX(rank) as max_rank FROM users WHERE role='user'");
    $max_rank = $q_max->fetch_assoc()['max_rank'];
    
    $q_min = $conn->query("SELECT MIN(rank) as min_rank FROM users WHERE role='user'");
    $min_rank = $q_min->fetch_assoc()['min_rank'];
    
    $q_avg = $conn->query("SELECT AVG(rank) as avg_rank FROM users WHERE role='user'");
    $avg_rank = round($q_avg->fetch_assoc()['avg_rank'], 2);
    
    echo "<hr>";
    echo "<h3>Statistik Leaderboard:</h3>";
    echo "<p><strong>Total User:</strong> $total_user</p>";
    echo "<p><strong>Rank Tertinggi:</strong> $max_rank</p>";
    echo "<p><strong>Rank Terendah:</strong> $min_rank</p>";
    echo "<p><strong>Rank Rata-rata:</strong> $avg_rank</p>";
    
    echo "<hr>";
    echo "<p><a href='index.php?page=leaderboard' style='padding: 10px 20px; background: #2196F3; color: white; text-decoration: none; border-radius: 5px;'>Lihat Leaderboard</a></p>";
    
} catch (Exception $e) {
    $conn->rollback();
    echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
}

echo "</div></body></html>";
$conn->close();
?>

