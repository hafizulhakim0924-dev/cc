<?php
/* ================= SHOW ERROR ================= */
error_reporting(E_ALL);
ini_set('display_errors', 1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

/* ================= SESSION ================= */
session_start();

/* ================= CONFIG DB ================= */
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

/* ================= HELPER ================= */
function esc($s){
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

$page = $_GET['page'] ?? 'welcome';

/* ================= WELCOME - PILIH ROLE ================= */
if($page == 'welcome'){
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Padang Creative Center</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                max-width: 600px;
                margin: 50px auto;
                padding: 20px;
                background: #f5f5f5;
            }
            .container {
                background: white;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                text-align: center;
            }
            h1 {
                color: #333;
                margin-bottom: 30px;
            }
            .role-buttons {
                display: flex;
                gap: 20px;
                justify-content: center;
                margin-top: 30px;
            }
            .role-btn {
                padding: 20px 40px;
                font-size: 18px;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                text-decoration: none;
                display: inline-block;
                transition: all 0.3s;
            }
            .role-btn.user {
                background: #4CAF50;
                color: white;
            }
            .role-btn.user:hover {
                background: #45a049;
                transform: translateY(-2px);
            }
            .role-btn.admin {
                background: #2196F3;
                color: white;
            }
            .role-btn.admin:hover {
                background: #0b7dda;
                transform: translateY(-2px);
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Padang Creative Center</h1>
            <h2>Pilih Login Sebagai:</h2>
            <div class="role-buttons">
                <a href="?page=login&role=user" class="role-btn user">User</a>
                <a href="?page=login&role=admin" class="role-btn admin">Admin</a>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}

/* ================= LOGIN ================= */
if($page == 'login'){
    $selected_role = esc($_GET['role'] ?? '');
    
    if(isset($_POST['login'])){
        $u = esc($_POST['username']);
        $p = md5($_POST['password']);
        $role = esc($_POST['role']);

        $q = $conn->query("
            SELECT * FROM users
            WHERE username='$u' AND password='$p' AND role='$role'
        ");

        if($q && $q->num_rows == 1){
            $_SESSION['user'] = $q->fetch_assoc();
            // Jika user, langsung ke halaman pilih lomba
            if($role == 'user'){
                header("Location:?page=lomba");
            } else {
            header("Location:?page=home");
            }
            exit;
        } else {
            $error = "Login gagal. Pastikan username, password, dan role sesuai.";
        }
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Login - Padang Creative Center</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                max-width: 400px;
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
            h2 {
                color: #333;
                text-align: center;
                margin-bottom: 20px;
            }
            .role-badge {
                display: inline-block;
                padding: 5px 15px;
                border-radius: 20px;
                margin-bottom: 20px;
                font-weight: bold;
            }
            .role-badge.user {
                background: #4CAF50;
                color: white;
            }
            .role-badge.admin {
                background: #2196F3;
                color: white;
            }
            input[type="text"],
            input[type="password"] {
                width: 100%;
                padding: 10px;
                margin: 8px 0;
                border: 1px solid #ddd;
                border-radius: 5px;
                box-sizing: border-box;
            }
            button {
                width: 100%;
                padding: 12px;
                background: #333;
                color: white;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
                margin-top: 10px;
            }
            button:hover {
                background: #555;
            }
            .error {
                color: red;
                text-align: center;
                margin-bottom: 15px;
            }
            .back-link {
                text-align: center;
                margin-top: 15px;
            }
            .back-link a {
                color: #666;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="container">
    <h2>Padang Creative Center</h2>
            <?php if(isset($error)): ?>
                <p class="error"><?= $error ?></p>
            <?php endif; ?>
            <?php if($selected_role): ?>
                <div style="text-align: center;">
                    <span class="role-badge <?= $selected_role ?>">
                        Login sebagai <?= strtoupper($selected_role) ?>
                    </span>
                </div>
            <?php endif; ?>
    <form method="post">
                <input type="hidden" name="role" value="<?= $selected_role ?>">
        Username<br>
                <input type="text" name="username" required><br><br>
        Password<br>
        <input type="password" name="password" required><br><br>
        <button name="login">Login</button>
    </form>
            <div class="back-link">
                <a href="?page=welcome">← Kembali pilih role</a>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}

/* ================= AUTH ================= */
if(!isset($_SESSION['user'])){
    header("Location:?page=welcome");
    exit;
}
$user = $_SESSION['user'];

/* ================= NAV ================= */
function nav(){
    echo "<hr>
    <a href='?page=home'>Home</a> | 
    <a href='?page=lomba'>Ikuti Lomba</a> | 
    <a href='?page=leaderboard'>Leaderboard</a> | 
    <a href='?page=logout'>Logout</a>
    <hr>";
}

/* ================= HOME ================= */
if($page == 'home'){
    nav();
    echo "<h3>Dashboard</h3>";
    echo "Nama : {$user['nama']}<br>";
    echo "Kelas : {$user['kelas']}<br>";
    echo "Sekolah : {$user['sekolah']}<br>";
    echo "Status : {$user['status_terakhir']}<br>";
    echo "<b>Rank : {$user['rank']}</b><br>";

    if($user['role'] == 'admin'){
        echo "<hr><b>ADMIN</b><br>
        <a href='?page=admin'>Admin Panel</a>";
    }
}

/* ================= LOMBA ================= */
if($page == 'lomba'){
    // Cek apakah user sudah login dan role user
    if($user['role'] != 'user'){
        header("Location:?page=home");
        exit;
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Pilih Lomba - Padang Creative Center</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                max-width: 900px;
                margin: 20px auto;
                padding: 20px;
                background: #f5f5f5;
            }
            .header {
                background: white;
                padding: 20px;
                border-radius: 10px;
                margin-bottom: 20px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }
            .header h2 {
                margin: 0;
                color: #333;
            }
            .nav {
                background: white;
                padding: 15px;
                border-radius: 10px;
                margin-bottom: 20px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }
            .nav a {
                margin-right: 15px;
                text-decoration: none;
                color: #2196F3;
            }
            .nav a:hover {
                text-decoration: underline;
            }
            .lomba-container {
                background: white;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }
            .lomba-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 15px;
                margin-top: 20px;
            }
            .lomba-card {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                padding: 20px;
                border-radius: 8px;
                text-align: center;
                transition: transform 0.3s, box-shadow 0.3s;
                cursor: pointer;
            }
            .lomba-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            }
            .lomba-card a {
                color: white;
                text-decoration: none;
                font-weight: bold;
                font-size: 16px;
                display: block;
            }
            .lomba-card.ipa {
                background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            }
            .lomba-card.ips {
                background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            }
            .lomba-card.mtk {
                background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            }
            .lomba-card.fisika {
                background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            }
            .lomba-card.robotik {
                background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            }
            .lomba-card.coding {
                background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);
            }
        </style>
    </head>
    <body>
        <div class="header">
            <h2>Padang Creative Center</h2>
        </div>
        <div class="nav">
            <a href='?page=home'>Home</a>
            <a href='?page=lomba'>Ikuti Lomba</a>
            <a href='?page=leaderboard'>Leaderboard</a>
            <a href='?page=logout'>Logout</a>
        </div>
        <div class="lomba-container">
            <h3>Pilih Lomba yang Tersedia</h3>
            <p>Silakan pilih kategori dan tingkat lomba yang ingin Anda ikuti:</p>
            <div class="lomba-grid">
    <?php
    $lomba = [
        "IPA"=>["SD","SMP","SMA"],
        "IPS"=>["SD","SMP","SMA"],
        "MTK"=>["SD","SMP","SMA"],
        "Fisika"=>["SMP","SMA"],
        "Robotik"=>["SD","SMP","SMA"],
        "Coding"=>["SD","SMP","SMA"]
    ];

    foreach($lomba as $k=>$tingkat){
        foreach($tingkat as $t){
            $class = strtolower($k);
            echo "<div class='lomba-card $class'>
                    <a href='?page=soal&kategori=$k&tingkat=$t'>$k $t</a>
                  </div>";
        }
    }
    ?>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}

/* ================= SOAL ================= */
if($page == 'soal'){
    // Cek apakah user sudah login dan role user
    if($user['role'] != 'user'){
        header("Location:?page=home");
        exit;
    }
    
    $kategori = esc($_GET['kategori']);
    $tingkat  = esc($_GET['tingkat']);

    $cek = $conn->query("
        SELECT 1 FROM jawaban
        WHERE user_id={$user['id']} AND soal_id IN (
            SELECT id FROM soal WHERE kategori='$kategori' AND tingkat='$tingkat'
        )
        LIMIT 1
    ");

    if($cek->num_rows > 0){
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Sudah Mengerjakan - Padang Creative Center</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    max-width: 600px;
                    margin: 50px auto;
                    padding: 20px;
                    background: #f5f5f5;
                }
                .container {
                    background: white;
                    padding: 30px;
                    border-radius: 10px;
                    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                    text-align: center;
                }
                .error {
                    color: #f5576c;
                    font-size: 18px;
                    margin-bottom: 20px;
                }
                .btn {
                    display: inline-block;
                    padding: 10px 20px;
                    background: #2196F3;
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                    margin-top: 10px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <p class="error">Kamu sudah pernah mengerjakan soal ini.</p>
                <a href="?page=lomba" class="btn">Kembali ke Pilih Lomba</a>
            </div>
        </body>
        </html>
        <?php
        exit;
    }

    if(isset($_POST['submit'])){
        // Cek ulang apakah user sudah mengerjakan
        $cek_ulang = $conn->query("
            SELECT 1 FROM jawaban
            WHERE user_id={$user['id']} AND soal_id IN (
                SELECT id FROM soal WHERE kategori='$kategori' AND tingkat='$tingkat'
            )
            LIMIT 1
        ");
        
        if($cek_ulang->num_rows > 0){
            header("Location:?page=soal&kategori=$kategori&tingkat=$tingkat");
            exit;
        }
        
        $nilai = 0;
        $total_soal = 0;
        $errors = [];

        // Validasi semua jawaban ada
        $q_soal = $conn->query("
            SELECT id, jawaban FROM soal
            WHERE kategori='$kategori' AND tingkat='$tingkat'
        ");
        
        $soal_ids = [];
        while($s = $q_soal->fetch_assoc()){
            $soal_ids[] = $s['id'];
        }
        
        // Mulai transaksi
        $conn->begin_transaction();
        
        try {
        foreach($_POST['jawaban'] as $soal_id=>$jawab){
                $soal_id = (int)$soal_id;
                
                // Validasi soal_id ada dalam daftar
                if(!in_array($soal_id, $soal_ids)){
                    continue;
                }
                
                $total_soal++;
                
                // Ambil kunci jawaban
            $q = $conn->query("SELECT jawaban FROM soal WHERE id=$soal_id");
                if(!$q || $q->num_rows == 0){
                    continue;
                }
                
            $kunci = $q->fetch_assoc()['jawaban'];
                $benar = (strtolower(trim($jawab)) == strtolower(trim($kunci))) ? 1 : 0;
            if($benar) $nilai++;

                // Insert jawaban
                $jawab_esc = esc($jawab);
                $insert = $conn->query("
                    INSERT INTO jawaban(user_id,soal_id,jawaban,benar)
                    VALUES({$user['id']},$soal_id,'$jawab_esc',$benar)
                    ON DUPLICATE KEY UPDATE jawaban='$jawab_esc', benar=$benar
                ");
                
                if(!$insert){
                    throw new Exception("Error inserting jawaban: " . $conn->error);
                }
            }

            // Update rank user
            $update = $conn->query("
            UPDATE users
            SET rank = rank + $nilai,
                status_terakhir='Selesai $kategori $tingkat'
            WHERE id={$user['id']}
        ");

            if(!$update){
                throw new Exception("Error updating rank: " . $conn->error);
            }
            
            // Commit transaksi
            $conn->commit();
            
        } catch (Exception $e) {
            // Rollback jika ada error
            $conn->rollback();
            die("Error: " . $e->getMessage());
        }

        // Ambil rank terbaru
        $q_rank = $conn->query("SELECT rank FROM users WHERE id={$user['id']}");
        $rank_sekarang = $q_rank->fetch_assoc()['rank'];
        
        $persentase = $total_soal > 0 ? round(($nilai / $total_soal) * 100, 1) : 0;
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Hasil - Padang Creative Center</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    max-width: 700px;
                    margin: 50px auto;
                    padding: 20px;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    min-height: 100vh;
                }
                .container {
                    background: white;
                    padding: 40px;
                    border-radius: 15px;
                    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                    text-align: center;
                }
                .success-icon {
                    font-size: 80px;
                    margin-bottom: 20px;
                }
                h2 {
                    color: #333;
                    margin-bottom: 10px;
                }
                .kategori-info {
                    color: #666;
                    margin-bottom: 30px;
                    font-size: 18px;
                }
                .score-container {
                    background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
                    color: white;
                    padding: 30px;
                    border-radius: 10px;
                    margin: 30px 0;
                }
                .score {
                    font-size: 64px;
                    font-weight: bold;
                    margin: 10px 0;
                }
                .score-detail {
                    font-size: 20px;
                    margin: 10px 0;
                }
                .persentase {
                    font-size: 24px;
                    margin-top: 10px;
                }
                .rank-info {
                    background: #f0f8ff;
                    padding: 20px;
                    border-radius: 10px;
                    margin: 20px 0;
                    border-left: 4px solid #2196F3;
                }
                .rank-info h3 {
                    margin: 0 0 10px 0;
                    color: #2196F3;
                }
                .rank-value {
                    font-size: 32px;
                    font-weight: bold;
                    color: #2196F3;
                }
                .btn-group {
                    margin-top: 30px;
                    display: flex;
                    gap: 15px;
                    justify-content: center;
                    flex-wrap: wrap;
                }
                .btn {
                    display: inline-block;
                    padding: 12px 30px;
                    background: #2196F3;
                    color: white;
                    text-decoration: none;
                    border-radius: 8px;
                    font-weight: bold;
                    transition: all 0.3s;
                }
                .btn:hover {
                    background: #0b7dda;
                    transform: translateY(-2px);
                    box-shadow: 0 5px 15px rgba(33, 150, 243, 0.4);
                }
                .btn-secondary {
                    background: #4CAF50;
                }
                .btn-secondary:hover {
                    background: #45a049;
                    box-shadow: 0 5px 15px rgba(76, 175, 80, 0.4);
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="success-icon">✅</div>
                <h2>Selamat! Anda telah menyelesaikan lomba</h2>
                <div class="kategori-info"><?= $kategori ?> <?= $tingkat ?></div>
                
                <div class="score-container">
                    <div class="score"><?= $nilai ?>/<?= $total_soal ?></div>
                    <div class="score-detail">Jawaban Benar</div>
                    <div class="persentase"><?= $persentase ?>%</div>
                </div>
                
                <div class="rank-info">
                    <h3>Rank Anda Sekarang</h3>
                    <div class="rank-value"><?= $rank_sekarang ?></div>
                    <p style="margin: 10px 0 0 0; color: #666;">Rank Anda telah diperbarui!</p>
                </div>
                
                <div class="btn-group">
                    <a href="?page=lomba" class="btn">Kembali ke Pilih Lomba</a>
                    <a href="?page=leaderboard" class="btn btn-secondary">Lihat Leaderboard</a>
                    <a href="?page=home" class="btn">Dashboard</a>
                </div>
            </div>
        </body>
        </html>
        <?php
        exit;
    }

    $q = $conn->query("
        SELECT * FROM soal
        WHERE kategori='$kategori' AND tingkat='$tingkat'
    ");

    if($q->num_rows == 0){
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Soal Belum Tersedia - Padang Creative Center</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    max-width: 600px;
                    margin: 50px auto;
                    padding: 20px;
                    background: #f5f5f5;
                }
                .container {
                    background: white;
                    padding: 30px;
                    border-radius: 10px;
                    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                    text-align: center;
                }
                .btn {
                    display: inline-block;
                    padding: 10px 20px;
                    background: #2196F3;
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                    margin-top: 10px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <p>Soal belum tersedia untuk kategori dan tingkat ini.</p>
                <a href="?page=lomba" class="btn">Kembali ke Pilih Lomba</a>
            </div>
        </body>
        </html>
        <?php
        exit;
    }

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Kerjakan Soal - Padang Creative Center</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                max-width: 900px;
                margin: 20px auto;
                padding: 20px;
                background: #f5f5f5;
            }
            .header {
                background: white;
                padding: 20px;
                border-radius: 10px;
                margin-bottom: 20px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }
            .header h2 {
                margin: 0;
                color: #333;
            }
            .nav {
                background: white;
                padding: 15px;
                border-radius: 10px;
                margin-bottom: 20px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }
            .nav a {
                margin-right: 15px;
                text-decoration: none;
                color: #2196F3;
            }
            .soal-container {
                background: white;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }
            .soal-item {
                margin-bottom: 30px;
                padding: 20px;
                background: #f9f9f9;
                border-radius: 8px;
                border-left: 4px solid #2196F3;
            }
            .soal-item p {
                font-weight: bold;
                font-size: 16px;
                margin-bottom: 15px;
                color: #333;
            }
            .option {
                display: block;
                padding: 10px;
                margin: 8px 0;
                background: white;
                border: 2px solid #ddd;
                border-radius: 5px;
                cursor: pointer;
                transition: all 0.3s;
            }
            .option:hover {
                border-color: #2196F3;
                background: #f0f8ff;
            }
            .option input[type="radio"] {
                margin-right: 10px;
            }
            .submit-btn {
                width: 100%;
                padding: 15px;
                background: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                font-size: 18px;
                font-weight: bold;
                cursor: pointer;
                margin-top: 20px;
            }
            .submit-btn:hover {
                background: #45a049;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <h2>Padang Creative Center</h2>
        </div>
        <div class="nav">
            <a href='?page=home'>Home</a>
            <a href='?page=lomba'>Ikuti Lomba</a>
            <a href='?page=leaderboard'>Leaderboard</a>
            <a href='?page=logout'>Logout</a>
        </div>
        <div class="soal-container">
            <h3><?= $kategori ?> <?= $tingkat ?></h3>
            <p>Silakan jawab semua pertanyaan di bawah ini:</p>
            <form method='post'>
    <?php
    $no = 1;
    while($s = $q->fetch_assoc()){
        echo "<div class='soal-item'>
                <p>$no. {$s['soal']}</p>
                <label class='option'>
                    <input type='radio' name='jawaban[{$s['id']}]' value='a' required> 
                    A. {$s['a']}
                </label>
                <label class='option'>
                    <input type='radio' name='jawaban[{$s['id']}]' value='b'> 
                    B. {$s['b']}
                </label>
                <label class='option'>
                    <input type='radio' name='jawaban[{$s['id']}]' value='c'> 
                    C. {$s['c']}
                </label>
                <label class='option'>
                    <input type='radio' name='jawaban[{$s['id']}]' value='d'> 
                    D. {$s['d']}
                </label>
              </div>";
        $no++;
    }
    ?>
                <button name='submit' class='submit-btn'>Kirim Jawaban</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}

/* ================= LEADERBOARD ================= */
if($page == 'leaderboard'){
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Leaderboard - Padang Creative Center</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                max-width: 1000px;
                margin: 20px auto;
                padding: 20px;
                background: #f5f5f5;
            }
            .header {
                background: white;
                padding: 20px;
                border-radius: 10px;
                margin-bottom: 20px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }
            .header h2 {
                margin: 0;
                color: #333;
            }
            .nav {
                background: white;
                padding: 15px;
                border-radius: 10px;
                margin-bottom: 20px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }
            .nav a {
                margin-right: 15px;
                text-decoration: none;
                color: #2196F3;
            }
            .nav a:hover {
                text-decoration: underline;
            }
            .leaderboard-container {
                background: white;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }
            .leaderboard-container h3 {
                margin-top: 0;
                color: #333;
                text-align: center;
                font-size: 28px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 15px;
                text-align: left;
                font-weight: bold;
            }
            td {
                padding: 12px 15px;
                border-bottom: 1px solid #eee;
            }
            tr:hover {
                background: #f9f9f9;
            }
            .rank-badge {
                display: inline-block;
                width: 40px;
                height: 40px;
                line-height: 40px;
                text-align: center;
                border-radius: 50%;
                font-weight: bold;
                color: white;
            }
            .rank-1 {
                background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            }
            .rank-2 {
                background: linear-gradient(135deg, #C0C0C0 0%, #808080 100%);
            }
            .rank-3 {
                background: linear-gradient(135deg, #CD7F32 0%, #8B4513 100%);
            }
            .rank-other {
                background: #2196F3;
            }
            .score {
                font-weight: bold;
                color: #4CAF50;
                font-size: 18px;
            }
            .user-name {
                font-weight: bold;
                color: #333;
            }
            .user-school {
                color: #666;
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <h2>Padang Creative Center</h2>
        </div>
        <div class="nav">
            <a href='?page=home'>Home</a>
            <a href='?page=lomba'>Ikuti Lomba</a>
            <a href='?page=leaderboard'>Leaderboard</a>
            <a href='?page=logout'>Logout</a>
        </div>
        <div class="leaderboard-container">
            <h3>🏆 Leaderboard 🏆</h3>
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Nama</th>
                        <th>Sekolah</th>
                        <th>Skor</th>
                    </tr>
                </thead>
                <tbody>
    <?php
    $q = $conn->query("
        SELECT nama,sekolah,rank
        FROM users
        WHERE role='user'
        ORDER BY rank DESC
        LIMIT 100
    ");
    
    $rank = 1;
    while($r = $q->fetch_assoc()){
        $rank_class = 'rank-other';
        if($rank == 1) $rank_class = 'rank-1';
        elseif($rank == 2) $rank_class = 'rank-2';
        elseif($rank == 3) $rank_class = 'rank-3';
        
        echo "<tr>
                <td>
                    <span class='rank-badge $rank_class'>$rank</span>
                </td>
                <td>
                    <div class='user-name'>{$r['nama']}</div>
                </td>
                <td>
                    <div class='user-school'>{$r['sekolah']}</div>
                </td>
                <td>
                    <span class='score'>{$r['rank']}</span>
                </td>
              </tr>";
        $rank++;
    }
    
    if($rank == 1){
        echo "<tr><td colspan='4' style='text-align:center; padding:30px; color:#999;'>Belum ada data leaderboard</td></tr>";
    }
    ?>
                </tbody>
            </table>
        </div>
    </body>
    </html>
    <?php
    exit;
}

/* ================= ADMIN ================= */
if($page == 'admin' && $user['role'] == 'admin'){
    nav();
    echo "<h3>Admin Panel</h3>
    <a href='?page=adduser'>Tambah User</a><br>
    <a href='?page=addsoal'>Tambah Soal</a><br>
    <a href='?page=stat'>Statistik</a>";
}

/* ================= ADD USER ================= */
if($page == 'adduser' && $user['role'] == 'admin'){
    nav();
    if(isset($_POST['save'])){
        $conn->query("
            INSERT INTO users(username,password,nama,kelas,nis,sekolah)
            VALUES(
                '{$_POST['username']}',
                MD5('{$_POST['password']}'),
                '{$_POST['nama']}',
                '{$_POST['kelas']}',
                '{$_POST['nis']}',
                '{$_POST['sekolah']}'
            )
        ");
        echo "User berhasil dibuat";
    }
    ?>
    <form method="post">
        Nama<input name="nama"><br>
        Kelas<input name="kelas"><br>
        NIS<input name="nis"><br>
        Sekolah<input name="sekolah"><br>
        Username<input name="username"><br>
        Password<input name="password"><br>
        <button name="save">Simpan</button>
    </form>
    <?php
}

/* ================= ADD SOAL ================= */
if($page == 'addsoal' && $user['role'] == 'admin'){
    nav();
    if(isset($_POST['save'])){
        $conn->query("
            INSERT INTO soal(kategori,tingkat,soal,a,b,c,d,jawaban)
            VALUES(
                '{$_POST['kategori']}',
                '{$_POST['tingkat']}',
                '{$_POST['soal']}',
                '{$_POST['a']}',
                '{$_POST['b']}',
                '{$_POST['c']}',
                '{$_POST['d']}',
                '{$_POST['jawaban']}'
            )
        ");
        echo "Soal berhasil ditambahkan";
    }
    ?>
    <form method="post">
        Kategori<input name="kategori"><br>
        Tingkat<input name="tingkat"><br>
        Soal<textarea name="soal"></textarea><br>
        A<input name="a"><br>
        B<input name="b"><br>
        C<input name="c"><br>
        D<input name="d"><br>
        Jawaban<input name="jawaban"><br>
        <button name="save">Simpan</button>
    </form>
    <?php
}

/* ================= STAT ================= */
if($page == 'stat' && $user['role'] == 'admin'){
    nav();
    $q = $conn->query("SELECT COUNT(DISTINCT user_id) total FROM jawaban");
    $r = $q->fetch_assoc();
    echo "Jumlah user sudah mengerjakan soal: <b>{$r['total']}</b>";
}

/* ================= LOGOUT ================= */
if($page == 'logout'){
    session_destroy();
    header("Location:?page=welcome");
    exit;
}
?>
