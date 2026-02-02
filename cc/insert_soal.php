<?php
/* ================= INSERT SOAL IPA SMP & IPS SMP ================= */
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

// Soal IPA SMP (50 soal)
$soal_ipa = [
    [
        'soal' => 'Organel sel yang berfungsi sebagai tempat respirasi sel adalah...',
        'a' => 'Mitokondria',
        'b' => 'Ribosom',
        'c' => 'Lisosom',
        'd' => 'Vakuola',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Proses fotosintesis pada tumbuhan terjadi di bagian...',
        'a' => 'Akar',
        'b' => 'Batang',
        'c' => 'Daun',
        'd' => 'Bunga',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Sistem peredaran darah manusia termasuk sistem peredaran darah...',
        'a' => 'Terbuka',
        'b' => 'Tertutup',
        'c' => 'Ganda',
        'd' => 'Tunggal',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Enzim yang berfungsi untuk mencerna protein adalah...',
        'a' => 'Amilase',
        'b' => 'Lipase',
        'c' => 'Pepsin',
        'd' => 'Sukrase',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Penyakit yang disebabkan oleh kekurangan vitamin C adalah...',
        'a' => 'Rakitis',
        'b' => 'Sariawan',
        'c' => 'Anemia',
        'd' => 'Rabun senja',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Bagian mata yang berfungsi mengatur banyak sedikitnya cahaya yang masuk adalah...',
        'a' => 'Kornea',
        'b' => 'Iris',
        'c' => 'Retina',
        'd' => 'Lensa',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Sistem saraf pusat terdiri dari...',
        'a' => 'Otak dan sumsum tulang belakang',
        'b' => 'Otak dan saraf tepi',
        'c' => 'Sumsum tulang belakang dan saraf tepi',
        'd' => 'Otak besar dan otak kecil',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Proses pertukaran gas oksigen dan karbon dioksida terjadi di...',
        'a' => 'Trakea',
        'b' => 'Bronkus',
        'c' => 'Alveolus',
        'd' => 'Faring',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Organ ekskresi yang berfungsi menyaring darah adalah...',
        'a' => 'Hati',
        'b' => 'Paru-paru',
        'c' => 'Ginjal',
        'd' => 'Kulit',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Hormon yang dihasilkan oleh pankreas untuk mengatur kadar gula darah adalah...',
        'a' => 'Adrenalin',
        'b' => 'Insulin',
        'c' => 'Tiroksin',
        'd' => 'Estrogen',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Tumbuhan yang berkembang biak dengan umbi batang adalah...',
        'a' => 'Kentang',
        'b' => 'Wortel',
        'c' => 'Singkong',
        'd' => 'Bawang merah',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Bagian bunga yang berfungsi sebagai alat kelamin betina adalah...',
        'a' => 'Benang sari',
        'b' => 'Putik',
        'c' => 'Mahkota',
        'd' => 'Kelopak',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Proses penyerbukan dimana serbuk sari jatuh ke kepala putik bunga yang sama disebut...',
        'a' => 'Penyerbukan silang',
        'b' => 'Penyerbukan sendiri',
        'c' => 'Penyerbukan tetangga',
        'd' => 'Penyerbukan bastar',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Hewan yang termasuk dalam kelompok vertebrata adalah...',
        'a' => 'Cacing tanah',
        'b' => 'Ubur-ubur',
        'c' => 'Ikan',
        'd' => 'Labah-labah',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Ekosistem yang terbentuk secara alami adalah...',
        'a' => 'Sawah',
        'b' => 'Kebun',
        'c' => 'Hutan',
        'd' => 'Tambak',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Rantai makanan yang benar adalah...',
        'a' => 'Rumput → Kelinci → Elang',
        'b' => 'Elang → Kelinci → Rumput',
        'c' => 'Kelinci → Rumput → Elang',
        'd' => 'Rumput → Elang → Kelinci',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Organisme yang berperan sebagai produsen dalam ekosistem adalah...',
        'a' => 'Herbivora',
        'b' => 'Karnivora',
        'c' => 'Tumbuhan hijau',
        'd' => 'Pengurai',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Lapisan atmosfer yang paling dekat dengan bumi adalah...',
        'a' => 'Stratosfer',
        'b' => 'Mesosfer',
        'c' => 'Troposfer',
        'd' => 'Termosfer',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Penyebab terjadinya siang dan malam adalah...',
        'a' => 'Revolusi bumi',
        'b' => 'Rotasi bumi',
        'c' => 'Revolusi bulan',
        'd' => 'Rotasi bulan',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Planet yang paling dekat dengan matahari adalah...',
        'a' => 'Venus',
        'b' => 'Bumi',
        'c' => 'Merkurius',
        'd' => 'Mars',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Zat yang menyebabkan pemanasan global adalah...',
        'a' => 'Oksigen',
        'b' => 'Nitrogen',
        'c' => 'Karbon dioksida',
        'd' => 'Hidrogen',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Sumber energi terbarukan adalah...',
        'a' => 'Batu bara',
        'b' => 'Minyak bumi',
        'c' => 'Energi matahari',
        'd' => 'Gas alam',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Perubahan wujud dari padat menjadi cair disebut...',
        'a' => 'Membeku',
        'b' => 'Mencair',
        'c' => 'Menguap',
        'd' => 'Menyublim',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Alat ukur suhu adalah...',
        'a' => 'Barometer',
        'b' => 'Termometer',
        'c' => 'Hygrometer',
        'd' => 'Anemometer',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Benda yang dapat menghantarkan listrik dengan baik disebut...',
        'a' => 'Isolator',
        'b' => 'Konduktor',
        'c' => 'Semikonduktor',
        'd' => 'Resistor',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Gaya yang bekerja pada benda yang jatuh bebas adalah...',
        'a' => 'Gaya gesek',
        'b' => 'Gaya gravitasi',
        'c' => 'Gaya magnet',
        'd' => 'Gaya listrik',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Satuan SI untuk gaya adalah...',
        'a' => 'Joule',
        'b' => 'Newton',
        'c' => 'Watt',
        'd' => 'Pascal',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Tekanan yang diberikan oleh zat cair disebut...',
        'a' => 'Tekanan udara',
        'b' => 'Tekanan hidrostatis',
        'c' => 'Tekanan atmosfer',
        'd' => 'Tekanan gas',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Alat yang bekerja berdasarkan prinsip hukum Pascal adalah...',
        'a' => 'Kapal selam',
        'b' => 'Dongkrak hidrolik',
        'c' => 'Balon udara',
        'd' => 'Termos',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Cahaya yang dapat dilihat oleh mata manusia disebut...',
        'a' => 'Sinar ultraviolet',
        'b' => 'Sinar inframerah',
        'c' => 'Cahaya tampak',
        'd' => 'Sinar X',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Cermin yang permukaannya melengkung ke dalam disebut...',
        'a' => 'Cermin datar',
        'b' => 'Cermin cembung',
        'c' => 'Cermin cekung',
        'd' => 'Cermin parabola',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Getaran yang merambat melalui medium disebut...',
        'a' => 'Gelombang',
        'b' => 'Frekuensi',
        'c' => 'Amplitudo',
        'd' => 'Perioda',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Bunyi yang frekuensinya di atas 20.000 Hz disebut...',
        'a' => 'Infrasound',
        'b' => 'Ultrasound',
        'c' => 'Audiosound',
        'd' => 'Supersonic',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Muatan listrik yang mengalir dalam rangkaian disebut...',
        'a' => 'Tegangan',
        'b' => 'Arus listrik',
        'c' => 'Hambatan',
        'd' => 'Daya',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Satuan SI untuk arus listrik adalah...',
        'a' => 'Volt',
        'b' => 'Ampere',
        'c' => 'Ohm',
        'd' => 'Watt',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Baterai yang dapat diisi ulang disebut...',
        'a' => 'Baterai primer',
        'b' => 'Baterai sekunder',
        'c' => 'Baterai lithium',
        'd' => 'Baterai alkaline',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Magnet yang dibuat dengan cara mengalirkan arus listrik disebut...',
        'a' => 'Magnet permanen',
        'b' => 'Magnet sementara',
        'c' => 'Elektromagnet',
        'd' => 'Magnet alami',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Reaksi kimia yang menghasilkan energi panas disebut...',
        'a' => 'Reaksi endoterm',
        'b' => 'Reaksi eksoterm',
        'c' => 'Reaksi netral',
        'd' => 'Reaksi reversibel',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Lambang kimia untuk air adalah...',
        'a' => 'H2O',
        'b' => 'CO2',
        'c' => 'O2',
        'd' => 'NaCl',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Zat yang dapat mengubah warna kertas lakmus merah menjadi biru adalah...',
        'a' => 'Asam',
        'b' => 'Basa',
        'c' => 'Garam',
        'd' => 'Air',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'pH netral adalah...',
        'a' => 'pH 0',
        'b' => 'pH 7',
        'c' => 'pH 14',
        'd' => 'pH 10',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Proses pemisahan campuran berdasarkan perbedaan titik didih disebut...',
        'a' => 'Filtrasi',
        'b' => 'Distilasi',
        'c' => 'Sublimasi',
        'd' => 'Kromatografi',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Unsur yang paling banyak terdapat di udara adalah...',
        'a' => 'Oksigen',
        'b' => 'Karbon dioksida',
        'c' => 'Nitrogen',
        'd' => 'Argon',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Logam yang digunakan untuk membuat kabel listrik adalah...',
        'a' => 'Besi',
        'b' => 'Tembaga',
        'c' => 'Aluminium',
        'd' => 'Emas',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Senyawa yang digunakan untuk menetralkan asam lambung adalah...',
        'a' => 'Asam klorida',
        'b' => 'Natrium bikarbonat',
        'c' => 'Asam sulfat',
        'd' => 'Natrium hidroksida',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Proses pembakaran memerlukan...',
        'a' => 'Oksigen',
        'b' => 'Nitrogen',
        'c' => 'Karbon dioksida',
        'd' => 'Hidrogen',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Bahan yang digunakan untuk membuat sabun adalah...',
        'a' => 'Asam dan garam',
        'b' => 'Basa dan minyak',
        'c' => 'Asam dan basa',
        'd' => 'Garam dan air',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Zat yang dapat mempercepat reaksi kimia disebut...',
        'a' => 'Inhibitor',
        'b' => 'Katalis',
        'c' => 'Reaktan',
        'd' => 'Produk',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Molekul yang terdiri dari dua atom disebut...',
        'a' => 'Monoatomik',
        'b' => 'Diatomik',
        'c' => 'Triatomik',
        'd' => 'Poliatomik',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Sifat fisika yang dapat diamati tanpa mengubah komposisi zat adalah...',
        'a' => 'Warna',
        'b' => 'Kemampuan terbakar',
        'c' => 'Kemampuan berkarat',
        'd' => 'Kemampuan bereaksi',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Campuran yang komposisinya tidak seragam disebut...',
        'a' => 'Campuran homogen',
        'b' => 'Campuran heterogen',
        'c' => 'Larutan',
        'd' => 'Suspensi',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Satuan SI untuk massa adalah...',
        'a' => 'Gram',
        'b' => 'Kilogram',
        'c' => 'Pound',
        'd' => 'Ons',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Alat untuk mengukur volume benda tidak beraturan adalah...',
        'a' => 'Gelas ukur',
        'b' => 'Neraca',
        'c' => 'Meteran',
        'd' => 'Termometer',
        'jawaban' => 'a'
    ]
];

// Soal IPS SMP (50 soal)
$soal_ips = [
    [
        'soal' => 'Negara yang terletak di benua Asia adalah...',
        'a' => 'Brasil',
        'b' => 'Indonesia',
        'c' => 'Mesir',
        'd' => 'Australia',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Ibu kota negara Malaysia adalah...',
        'a' => 'Jakarta',
        'b' => 'Bangkok',
        'c' => 'Kuala Lumpur',
        'd' => 'Singapura',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Sungai terpanjang di dunia adalah...',
        'a' => 'Sungai Nil',
        'b' => 'Sungai Amazon',
        'c' => 'Sungai Mississippi',
        'd' => 'Sungai Yangtze',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Gunung tertinggi di dunia adalah...',
        'a' => 'Gunung Kilimanjaro',
        'b' => 'Gunung Everest',
        'c' => 'Gunung Fuji',
        'd' => 'Gunung Merapi',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Lautan terluas di dunia adalah...',
        'a' => 'Samudra Atlantik',
        'b' => 'Samudra Pasifik',
        'c' => 'Samudra Hindia',
        'd' => 'Samudra Arktik',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Kerajaan Hindu-Buddha pertama di Indonesia adalah...',
        'a' => 'Sriwijaya',
        'b' => 'Majapahit',
        'c' => 'Kutai',
        'd' => 'Tarumanegara',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Raja Kerajaan Majapahit yang terkenal adalah...',
        'a' => 'Hayam Wuruk',
        'b' => 'Gajah Mada',
        'c' => 'Ken Arok',
        'd' => 'Raden Wijaya',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Perang Diponegoro terjadi pada tahun...',
        'a' => '1825-1830',
        'b' => '1815-1820',
        'c' => '1830-1835',
        'd' => '1840-1845',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Organisasi pergerakan nasional pertama di Indonesia adalah...',
        'a' => 'Budi Utomo',
        'b' => 'Sarekat Islam',
        'c' => 'Indische Partij',
        'd' => 'Perhimpunan Indonesia',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Proklamasi Kemerdekaan Indonesia dibacakan pada tanggal...',
        'a' => '16 Agustus 1945',
        'b' => '17 Agustus 1945',
        'c' => '18 Agustus 1945',
        'd' => '19 Agustus 1945',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Presiden pertama Republik Indonesia adalah...',
        'a' => 'Mohammad Hatta',
        'b' => 'Soekarno',
        'c' => 'Soeharto',
        'd' => 'B.J. Habibie',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Sistem pemerintahan Indonesia adalah...',
        'a' => 'Presidensial',
        'b' => 'Parlamenter',
        'c' => 'Monarki',
        'd' => 'Federal',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Lembaga negara yang berwenang membuat undang-undang adalah...',
        'a' => 'DPR',
        'b' => 'DPD',
        'c' => 'MPR',
        'd' => 'Presiden',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Hak asasi manusia yang paling mendasar adalah...',
        'a' => 'Hak untuk hidup',
        'b' => 'Hak untuk bekerja',
        'c' => 'Hak untuk berpendapat',
        'd' => 'Hak untuk memiliki',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Kegiatan ekonomi yang menghasilkan barang disebut...',
        'a' => 'Produksi',
        'b' => 'Distribusi',
        'c' => 'Konsumsi',
        'd' => 'Investasi',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Alat pembayaran yang sah di Indonesia adalah...',
        'a' => 'Dolar',
        'b' => 'Rupiah',
        'c' => 'Euro',
        'd' => 'Yen',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Bank yang mengatur peredaran uang di Indonesia adalah...',
        'a' => 'Bank Mandiri',
        'b' => 'Bank BCA',
        'c' => 'Bank Indonesia',
        'd' => 'Bank BRI',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Inflasi adalah...',
        'a' => 'Kenaikan harga barang secara umum',
        'b' => 'Penurunan harga barang secara umum',
        'c' => 'Kenaikan nilai tukar mata uang',
        'd' => 'Penurunan nilai tukar mata uang',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Pajak yang dikenakan pada barang mewah disebut...',
        'a' => 'Pajak penghasilan',
        'b' => 'Pajak pertambahan nilai',
        'c' => 'Pajak bumi dan bangunan',
        'd' => 'Pajak penjualan barang mewah',
        'jawaban' => 'd'
    ],
    [
        'soal' => 'Koperasi didirikan berdasarkan prinsip...',
        'a' => 'Keuntungan maksimal',
        'b' => 'Kekeluargaan dan gotong royong',
        'c' => 'Persaingan bebas',
        'd' => 'Monopoli',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Perdagangan antar negara disebut...',
        'a' => 'Perdagangan dalam negeri',
        'b' => 'Perdagangan internasional',
        'c' => 'Perdagangan regional',
        'd' => 'Perdagangan lokal',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Organisasi perdagangan dunia adalah...',
        'a' => 'ASEAN',
        'b' => 'WTO',
        'c' => 'OPEC',
        'd' => 'APEC',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Negara anggota ASEAN berjumlah...',
        'a' => '8 negara',
        'b' => '9 negara',
        'c' => '10 negara',
        'd' => '11 negara',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'ASEAN didirikan pada tahun...',
        'a' => '1965',
        'b' => '1967',
        'c' => '1970',
        'd' => '1975',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Penduduk yang tinggal di suatu wilayah disebut...',
        'a' => 'Populasi',
        'b' => 'Komunitas',
        'c' => 'Masyarakat',
        'd' => 'Kelompok',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Perpindahan penduduk dari desa ke kota disebut...',
        'a' => 'Urbanisasi',
        'b' => 'Transmigrasi',
        'c' => 'Imigrasi',
        'd' => 'Emigrasi',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Sensus penduduk di Indonesia dilakukan setiap...',
        'a' => '5 tahun sekali',
        'b' => '10 tahun sekali',
        'c' => '15 tahun sekali',
        'd' => '20 tahun sekali',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Kepadatan penduduk dihitung dengan rumus...',
        'a' => 'Jumlah penduduk / Luas wilayah',
        'b' => 'Luas wilayah / Jumlah penduduk',
        'c' => 'Jumlah penduduk x Luas wilayah',
        'd' => 'Jumlah penduduk - Luas wilayah',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Kegiatan manusia yang memanfaatkan sumber daya alam disebut...',
        'a' => 'Konservasi',
        'b' => 'Eksploitasi',
        'c' => 'Preservasi',
        'd' => 'Rehabilitasi',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Sumber daya alam yang dapat diperbarui adalah...',
        'a' => 'Minyak bumi',
        'b' => 'Batu bara',
        'c' => 'Hutan',
        'd' => 'Emas',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Pencemaran udara dapat menyebabkan...',
        'a' => 'Hujan asam',
        'b' => 'Erosi',
        'c' => 'Tanah longsor',
        'd' => 'Gempa bumi',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Kebudayaan adalah...',
        'a' => 'Hasil karya manusia',
        'b' => 'Segala sesuatu yang dihasilkan manusia',
        'c' => 'Keseluruhan sistem gagasan dan hasil karya manusia',
        'd' => 'Tradisi turun temurun',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Unsur kebudayaan yang paling sulit berubah adalah...',
        'a' => 'Teknologi',
        'b' => 'Sistem kepercayaan',
        'c' => 'Sistem ekonomi',
        'd' => 'Sistem transportasi',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Akulturasi adalah...',
        'a' => 'Percampuran dua kebudayaan',
        'b' => 'Penolakan kebudayaan asing',
        'c' => 'Pemusnahan kebudayaan lama',
        'd' => 'Isolasi kebudayaan',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Suku bangsa terbesar di Indonesia adalah...',
        'a' => 'Sunda',
        'b' => 'Jawa',
        'c' => 'Batak',
        'd' => 'Minangkabau',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Bahasa persatuan Indonesia adalah...',
        'a' => 'Bahasa Jawa',
        'b' => 'Bahasa Indonesia',
        'c' => 'Bahasa Melayu',
        'd' => 'Bahasa Sunda',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Agama yang pertama kali masuk ke Indonesia adalah...',
        'a' => 'Islam',
        'b' => 'Hindu',
        'c' => 'Buddha',
        'd' => 'Kristen',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Candi Borobudur merupakan peninggalan agama...',
        'a' => 'Hindu',
        'b' => 'Buddha',
        'c' => 'Islam',
        'd' => 'Kristen',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Masjid Demak merupakan peninggalan kerajaan...',
        'a' => 'Mataram',
        'b' => 'Demak',
        'c' => 'Banten',
        'd' => 'Aceh',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Perang Padri terjadi di daerah...',
        'a' => 'Jawa',
        'b' => 'Sumatera Barat',
        'c' => 'Sulawesi',
        'd' => 'Kalimantan',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Perang Aceh melawan Belanda dipimpin oleh...',
        'a' => 'Cut Nyak Dien',
        'b' => 'Tuanku Imam Bonjol',
        'c' => 'Pangeran Diponegoro',
        'd' => 'Sultan Hasanuddin',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Sumpah Pemuda diikrarkan pada tanggal...',
        'a' => '27 Oktober 1928',
        'b' => '28 Oktober 1928',
        'c' => '29 Oktober 1928',
        'd' => '30 Oktober 1928',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Tokoh yang merumuskan Pancasila adalah...',
        'a' => 'Mohammad Hatta',
        'b' => 'Soekarno',
        'c' => 'Ahmad Soebardjo',
        'd' => 'Mohammad Yamin',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Lambang negara Indonesia adalah...',
        'a' => 'Garuda Pancasila',
        'b' => 'Bhinneka Tunggal Ika',
        'c' => 'Merah Putih',
        'd' => 'Bendera Pusaka',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Semboyan negara Indonesia adalah...',
        'a' => 'Garuda Pancasila',
        'b' => 'Bhinneka Tunggal Ika',
        'c' => 'Merdeka atau Mati',
        'd' => 'Indonesia Raya',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Lagu kebangsaan Indonesia adalah...',
        'a' => 'Indonesia Pusaka',
        'b' => 'Indonesia Raya',
        'c' => 'Tanah Airku',
        'd' => 'Maju Tak Gentar',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Warna bendera Indonesia adalah...',
        'a' => 'Merah Putih',
        'b' => 'Merah Kuning',
        'c' => 'Putih Biru',
        'd' => 'Merah Biru',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Provinsi di Indonesia yang paling banyak penduduknya adalah...',
        'a' => 'Jawa Barat',
        'b' => 'Jawa Tengah',
        'c' => 'Jawa Timur',
        'd' => 'DKI Jakarta',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Pulau terbesar di Indonesia adalah...',
        'a' => 'Jawa',
        'b' => 'Sumatera',
        'c' => 'Kalimantan',
        'd' => 'Papua',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Danau terbesar di Indonesia adalah...',
        'a' => 'Danau Toba',
        'b' => 'Danau Singkarak',
        'c' => 'Danau Poso',
        'd' => 'Danau Matano',
        'jawaban' => 'a'
    ],
    [
        'soal' => 'Gunung tertinggi di Indonesia adalah...',
        'a' => 'Gunung Merapi',
        'b' => 'Gunung Semeru',
        'c' => 'Gunung Jaya Wijaya',
        'd' => 'Gunung Kerinci',
        'jawaban' => 'c'
    ],
    [
        'soal' => 'Mata uang negara Thailand adalah...',
        'a' => 'Ringgit',
        'b' => 'Baht',
        'c' => 'Peso',
        'd' => 'Dong',
        'jawaban' => 'b'
    ],
    [
        'soal' => 'Negara yang terletak di benua Eropa adalah...',
        'a' => 'Jepang',
        'b' => 'Australia',
        'c' => 'Prancis',
        'd' => 'Brasil',
        'jawaban' => 'c'
    ]
];

// Insert soal IPA SMP
echo "Memasukkan 50 soal IPA SMP...\n";
$count_ipa = 0;
foreach($soal_ipa as $soal) {
    $soal_text = esc($soal['soal']);
    $a = esc($soal['a']);
    $b = esc($soal['b']);
    $c = esc($soal['c']);
    $d = esc($soal['d']);
    $jawaban = esc($soal['jawaban']);
    
    $sql = "INSERT INTO soal(kategori,tingkat,soal,a,b,c,d,jawaban) 
            VALUES('IPA','SMP','$soal_text','$a','$b','$c','$d','$jawaban')";
    
    if($conn->query($sql)) {
        $count_ipa++;
    } else {
        echo "Error: " . $conn->error . "\n";
    }
}
echo "Berhasil memasukkan $count_ipa soal IPA SMP\n\n";

// Insert soal IPS SMP
echo "Memasukkan 50 soal IPS SMP...\n";
$count_ips = 0;
foreach($soal_ips as $soal) {
    $soal_text = esc($soal['soal']);
    $a = esc($soal['a']);
    $b = esc($soal['b']);
    $c = esc($soal['c']);
    $d = esc($soal['d']);
    $jawaban = esc($soal['jawaban']);
    
    $sql = "INSERT INTO soal(kategori,tingkat,soal,a,b,c,d,jawaban) 
            VALUES('IPS','SMP','$soal_text','$a','$b','$c','$d','$jawaban')";
    
    if($conn->query($sql)) {
        $count_ips++;
    } else {
        echo "Error: " . $conn->error . "\n";
    }
}
echo "Berhasil memasukkan $count_ips soal IPS SMP\n\n";

echo "Selesai! Total soal yang dimasukkan: " . ($count_ipa + $count_ips) . " soal\n";
$conn->close();
?>

