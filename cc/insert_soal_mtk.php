<?php
/* ================= INSERT SOAL MTK SMP ================= */
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

// Soal MTK SMP (50 soal)
$soal_mtk = [
    [
        'soal' => 'Hasil dari 15 + (-8) adalah...',
        'a' => '7',
        'b' => '-7',
        'c' => '23',
        'd' => '-23',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Hasil dari (-12) - (-5) adalah...',
        'a' => '-17',
        'b' => '-7',
        'c' => '7',
        'd' => '17',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Hasil dari 6 × (-4) adalah...',
        'a' => '24',
        'b' => '-24',
        'c' => '10',
        'd' => '-10',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Hasil dari (-18) ÷ 3 adalah...',
        'a' => '6',
        'b' => '-6',
        'c' => '15',
        'd' => '-15',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Bentuk sederhana dari 2/3 + 1/4 adalah...',
        'a' => '3/7',
        'b' => '11/12',
        'c' => '3/12',
        'd' => '5/12',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Hasil dari 3/5 × 2/3 adalah...',
        'a' => '5/8',
        'b' => '6/15',
        'c' => '2/5',
        'd' => '1/5',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Nilai dari 2³ adalah...',
        'a' => '6',
        'b' => '8',
        'c' => '9',
        'd' => '16',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Hasil dari √144 adalah...',
        'a' => '12',
        'b' => '14',
        'c' => '16',
        'd' => '18',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Bentuk desimal dari 3/4 adalah...',
        'a' => '0.25',
        'b' => '0.5',
        'c' => '0.75',
        'd' => '0.8',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Bentuk persen dari 0.6 adalah...',
        'a' => '6%',
        'b' => '60%',
        'c' => '600%',
        'd' => '0.6%',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Jika x + 5 = 12, maka nilai x adalah...',
        'a' => '7',
        'b' => '17',
        'c' => '-7',
        'd' => '5',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Jika 2x - 3 = 7, maka nilai x adalah...',
        'a' => '2',
        'b' => '5',
        'c' => '10',
        'd' => '20',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Penyelesaian dari 3x + 2 = 2x + 8 adalah...',
        'a' => 'x = 6',
        'b' => 'x = 4',
        'c' => 'x = 2',
        'd' => 'x = 10',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Keliling persegi dengan sisi 8 cm adalah...',
        'a' => '16 cm',
        'b' => '32 cm',
        'c' => '64 cm',
        'd' => '24 cm',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Luas persegi dengan sisi 6 cm adalah...',
        'a' => '12 cm²',
        'b' => '24 cm²',
        'c' => '36 cm²',
        'd' => '48 cm²',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Keliling persegi panjang dengan panjang 10 cm dan lebar 5 cm adalah...',
        'a' => '15 cm',
        'b' => '30 cm',
        'c' => '50 cm',
        'd' => '25 cm',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Luas persegi panjang dengan panjang 8 cm dan lebar 4 cm adalah...',
        'a' => '12 cm²',
        'b' => '24 cm²',
        'c' => '32 cm²',
        'd' => '48 cm²',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Luas segitiga dengan alas 10 cm dan tinggi 6 cm adalah...',
        'a' => '16 cm²',
        'b' => '30 cm²',
        'c' => '60 cm²',
        'd' => '120 cm²',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Keliling lingkaran dengan jari-jari 7 cm adalah... (π = 22/7)',
        'a' => '22 cm',
        'b' => '44 cm',
        'c' => '154 cm',
        'd' => '88 cm',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Luas lingkaran dengan jari-jari 7 cm adalah... (π = 22/7)',
        'a' => '44 cm²',
        'b' => '88 cm²',
        'c' => '154 cm²',
        'd' => '308 cm²',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Volume kubus dengan rusuk 5 cm adalah...',
        'a' => '25 cm³',
        'b' => '125 cm³',
        'c' => '150 cm³',
        'd' => '250 cm³',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Volume balok dengan panjang 6 cm, lebar 4 cm, dan tinggi 3 cm adalah...',
        'a' => '13 cm³',
        'b' => '72 cm³',
        'c' => '48 cm³',
        'd' => '24 cm³',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Faktor dari 24 adalah...',
        'a' => '1, 2, 3, 4, 6, 8, 12, 24',
        'b' => '1, 2, 3, 4, 6, 12',
        'c' => '2, 3, 4, 6, 8, 12',
        'd' => '1, 3, 6, 8, 12, 24',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'FPB dari 18 dan 24 adalah...',
        'a' => '2',
        'b' => '3',
        'c' => '6',
        'd' => '12',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'KPK dari 6 dan 8 adalah...',
        'a' => '12',
        'b' => '24',
        'c' => '48',
        'd' => '14',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Bilangan prima antara 10 dan 20 adalah...',
        'a' => '11, 13, 15, 17, 19',
        'b' => '11, 13, 17, 19',
        'c' => '11, 12, 13, 17, 19',
        'd' => '13, 15, 17, 19',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Rata-rata dari 5, 7, 9, 11, 13 adalah...',
        'a' => '8',
        'b' => '9',
        'c' => '10',
        'd' => '11',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Median dari data 3, 5, 7, 9, 11 adalah...',
        'a' => '5',
        'b' => '7',
        'c' => '9',
        'd' => '11',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Modus dari data 2, 3, 3, 4, 5, 3, 6 adalah...',
        'a' => '2',
        'b' => '3',
        'c' => '4',
        'd' => '5',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Perbandingan 2 : 3 sama dengan...',
        'a' => '4 : 5',
        'b' => '4 : 6',
        'c' => '6 : 9',
        'd' => '8 : 12',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Jika 5 buku harganya Rp 25.000, maka harga 8 buku adalah...',
        'a' => 'Rp 30.000',
        'b' => 'Rp 35.000',
        'c' => 'Rp 40.000',
        'd' => 'Rp 45.000',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Skala 1 : 500 berarti 1 cm pada peta sama dengan...',
        'a' => '5 m',
        'b' => '50 m',
        'c' => '500 m',
        'd' => '5000 m',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Jika jarak pada peta 4 cm dengan skala 1 : 100.000, maka jarak sebenarnya adalah...',
        'a' => '4 km',
        'b' => '40 km',
        'c' => '400 km',
        'd' => '4000 km',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Besar sudut siku-siku adalah...',
        'a' => '45°',
        'b' => '90°',
        'c' => '180°',
        'd' => '360°',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Jumlah sudut dalam segitiga adalah...',
        'a' => '90°',
        'b' => '180°',
        'c' => '270°',
        'd' => '360°',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Jumlah sudut dalam segiempat adalah...',
        'a' => '180°',
        'b' => '270°',
        'c' => '360°',
        'd' => '450°',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Garis yang membagi sudut menjadi dua bagian sama besar disebut...',
        'a' => 'Garis bagi',
        'b' => 'Garis berat',
        'c' => 'Garis sumbu',
        'd' => 'Garis tinggi',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Koordinat titik (3, 4) berada di kuadran...',
        'a' => 'I',
        'b' => 'II',
        'c' => 'III',
        'd' => 'IV',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Koordinat titik (-2, 5) berada di kuadran...',
        'a' => 'I',
        'b' => 'II',
        'c' => 'III',
        'd' => 'IV',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Gradien garis y = 2x + 3 adalah...',
        'a' => '2',
        'b' => '3',
        'c' => '5',
        'd' => '6',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Persamaan garis yang melalui titik (0, 0) dan (2, 4) adalah...',
        'a' => 'y = x',
        'b' => 'y = 2x',
        'c' => 'y = 3x',
        'd' => 'y = 4x',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Hasil dari (x + 3)(x + 2) adalah...',
        'a' => 'x² + 5x + 6',
        'b' => 'x² + 6x + 5',
        'c' => 'x² + 5x + 5',
        'd' => 'x² + 6x + 6',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Faktor dari x² - 9 adalah...',
        'a' => '(x - 3)(x - 3)',
        'b' => '(x + 3)(x - 3)',
        'c' => '(x + 3)(x + 3)',
        'd' => '(x - 9)(x + 1)',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Hasil dari (2x + 1)² adalah...',
        'a' => '4x² + 1',
        'b' => '4x² + 4x + 1',
        'c' => '2x² + 4x + 1',
        'd' => '4x² + 2x + 1',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Penyelesaian dari x² - 5x + 6 = 0 adalah...',
        'a' => 'x = 2 atau x = 3',
        'b' => 'x = -2 atau x = -3',
        'c' => 'x = 1 atau x = 6',
        'd' => 'x = -1 atau x = -6',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Bentuk sederhana dari 2x + 3y - x + 5y adalah...',
        'a' => 'x + 8y',
        'b' => '3x + 8y',
        'c' => 'x + 2y',
        'd' => '3x + 2y',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Jika f(x) = 2x + 3, maka f(4) adalah...',
        'a' => '8',
        'b' => '11',
        'c' => '14',
        'd' => '15',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Domain dari fungsi f(x) = 1/(x - 2) adalah...',
        'a' => 'Semua bilangan real',
        'b' => 'x ≠ 0',
        'c' => 'x ≠ 2',
        'd' => 'x > 2',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Sistem persamaan linear 2x + y = 7 dan x - y = 2 memiliki penyelesaian...',
        'a' => 'x = 3, y = 1',
        'b' => 'x = 3, y = -1',
        'c' => 'x = 1, y = 3',
        'd' => 'x = -1, y = 3',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Pertidaksamaan 2x + 3 > 7 memiliki penyelesaian...',
        'a' => 'x > 2',
        'b' => 'x > 5',
        'c' => 'x < 2',
        'd' => 'x < 5',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Peluang munculnya angka pada pelemparan sebuah koin adalah...',
        'a' => '1/4',
        'b' => '1/3',
        'c' => '1/2',
        'd' => '2/3',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Peluang munculnya mata dadu genap pada pelemparan sebuah dadu adalah...',
        'a' => '1/6',
        'b' => '1/3',
        'c' => '1/2',
        'd' => '2/3',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Jika sebuah dadu dilempar sekali, peluang munculnya angka lebih dari 4 adalah...',
        'a' => '1/6',
        'b' => '1/3',
        'c' => '1/2',
        'd' => '2/3',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Barisan aritmetika dengan suku pertama 3 dan beda 4, suku ke-5 adalah...',
        'a' => '15',
        'b' => '19',
        'c' => '23',
        'd' => '27',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Barisan geometri dengan suku pertama 2 dan rasio 3, suku ke-4 adalah...',
        'a' => '18',
        'b' => '24',
        'c' => '54',
        'd' => '162',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Jumlah 5 suku pertama dari barisan 2, 4, 6, 8, ... adalah...',
        'a' => '20',
        'b' => '30',
        'c' => '40',
        'd' => '50',
        'jawaban' => 'b'
    ]
];

// Insert soal MTK SMP
echo "Memasukkan 50 soal MTK SMP...\n";
$count_mtk = 0;
foreach($soal_mtk as $soal) {
    $soal_text = esc($soal['soal']);
    $a = esc($soal['a']);
    $b = esc($soal['b']);
    $c = esc($soal['c']);
    $d = esc($soal['d']);
    $jawaban = esc($soal['jawaban']);
    
    $sql = "INSERT INTO soal(kategori,tingkat,soal,a,b,c,d,jawaban) 
            VALUES('MTK','SMP','$soal_text','$a','$b','$c','$d','$jawaban')";
    
    if($conn->query($sql)) {
        $count_mtk++;
    } else {
        echo "Error: " . $conn->error . "\n";
    }
}
echo "Berhasil memasukkan $count_mtk soal MTK SMP\n\n";

echo "Selesai! Total soal yang dimasukkan: $count_mtk soal\n";
$conn->close();
?>

