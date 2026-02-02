CARA MENGISI LEADERBOARD DENGAN 2000 PESERTA
============================================

File: generate_leaderboard.php

Cara menggunakan:
1. Buka browser dan akses: http://localhost/cc/generate_leaderboard.php
   atau
   http://your-domain/cc/generate_leaderboard.php

2. Script akan otomatis membuat 2000 peserta dengan:
   - Nama yang bervariasi
   - Sekolah yang berbeda-beda (dari berbagai SMP di Sumatera Barat)
   - Kelas yang bervariasi (VII, VIII, IX)
   - Rank/skor yang terdistribusi secara natural:
     * 1% mendapat skor sangat tinggi (450-500)
     * 4% mendapat skor tinggi (400-450)
     * 10% mendapat skor tinggi-sedang (350-400)
     * 20% mendapat skor sedang-tinggi (250-350)
     * 25% mendapat skor sedang (150-250)
     * 25% mendapat skor sedang-rendah (80-150)
     * 15% mendapat skor rendah (0-80)

3. Progress akan ditampilkan setiap 100 peserta

4. Setelah selesai, akan menampilkan:
   - Total peserta yang berhasil dibuat
   - Statistik leaderboard (total user, rank tertinggi, terendah, rata-rata)
   - Link untuk melihat leaderboard

Fitur:
- Batch insert untuk performa lebih cepat
- Transaksi database untuk memastikan data konsisten
- Distribusi rank yang natural dan realistis
- Progress bar untuk monitoring
- Error handling yang baik

Data yang di-generate:
- Username: peserta1, peserta2, ..., peserta2000
- Password: password123 (untuk semua)
- Nama: Kombinasi nama depan dan belakang yang bervariasi
- Sekolah: Dari daftar 40+ sekolah di Sumatera Barat
- Kelas: VII A/B/C, VIII A/B/C, IX A/B/C
- NIS: NIS000001, NIS000002, ..., NIS002000
- Role: user
- Status: Bervariasi (Selesai IPA SMP, IPS SMP, MTK SMP, dll)

Catatan:
- Pastikan koneksi database sudah benar
- Proses ini akan memakan waktu beberapa menit (tergantung server)
- Setelah selesai, bisa hapus file generate_leaderboard.php untuk keamanan
- Jika ingin mengulang, hapus dulu data user yang lama

Tips:
- Untuk performa lebih baik, pastikan index pada tabel users sudah optimal
- Jika terjadi timeout, bisa kurangi jumlah peserta atau tingkatkan max_execution_time di PHP

