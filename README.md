# 🧳 Alfarouq Tour & Travel – 3-Negara Tour Platform

Minatbaru digantikan oleh **Alfarouq Tour & Travel**, platform tour berbasis Laravel untuk paket wisata Malaysia, Singapura & Thailand dengan harga terjangkau. Cocok untuk individu, keluarga, atau group trip. :contentReference[oaicite:3]{index=3}

---

## 🌟 Fitur Utama
- 📅 Paket *Open Trip* dan *Private Trip* 3 negara
- 🧭 Sistem pemesanan lengkap & pendaftaran pengguna (register/login) 
- 📄 Dokumentasi perjalanan & riwayat trip :contentReference[oaicite:5]{index=5}
- 🛎️ Notifikasi WhatsApp & integrasi sosial media (IG, TikTok)
- 📊 Admin dashboard: kelola paket, peserta, pemesanan, laporan

---

## 🛠️ Teknologi yang Digunakan
- PHP & Laravel Framework  
- MySQL  
- Blade Templates & Bootstrap  
- Composer, Artisan CLI  
- XAMPP/Laragon atau web server + MySQL  

---

## 🚀 Instalasi & Setup Lokal

### Prasyarat:
- PHP >= 8.1  
- Composer  
- MySQL  
- XAMPP / Laragon

### Langkah instalasi:
```bash
# 1. Clone repo
git clone https://github.com/ahmadadrianwibisana/myalfarouq_web.git

# 2. Masuk folder project
cd myalfarouq_web

# 3. Install depedensi
composer install

# 4. Salin .env
cp .env.example .env

# 5. Generate key aplikasi
php artisan key:generate

# 6. Buat database baru (misal: alfarouq_db)

# 7. Update konfigurasi database di .env:
DB_DATABASE=myalfarouq_web  
DB_USERNAME=root  
DB_PASSWORD=

# 8. Jalankan migrasi jika tersedia
php artisan migrate

# 9. Jalankan server lokal
php artisan serve

# 10. Akses aplikasi di browser
http://127.0.0.1:8000
