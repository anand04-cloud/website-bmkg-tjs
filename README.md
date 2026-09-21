<p align="center">
  <img src="https://www.bmkg.go.id/asset/img/logo/logo-bmkg.png" width="120" alt="Logo BMKG">
</p>

<h1 align="center">Portal Digitalisasi Layanan MKG & Website Resmi</h1>
<h3 align="center">Stasiun Meteorologi Kelas III Tanjung Harapan (Bulungan, Kalimantan Utara)</h3>

<p align="center">
  <img src="https://img.shields.io/badge/Status-Production%20Ready-brightgreen" alt="Status">
  <img src="https://img.shields.io/badge/Framework-Laravel%2010%2F11-red" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2%2B-blue" alt="PHP">
  <img src="https://img.shields.io/badge/License-MIT-green" alt="License">
</p>

---

## 📌 Tentang Aplikasi
Repository ini merupakan kode sumber resmi untuk **Website Layanan Informasi Meteorologi, Klimatologi, dan Geofisika (MKG)** berbasis web yang dikembangkan khusus untuk **Stasiun Meteorologi Kelas III Tanjung Harapan**. 

Aplikasi ini dibangun untuk menyediakan akses informasi publik yang cepat, akurat, dan transparan, sekaligus menyediakan panel administratif internal guna mendukung tugas operasional harian pengamatan cuaca, gempabumi, kualitas udara, serta publikasi buletin dan berita stasiun.

---

## 🚀 Fitur Utama Sistem

1. **Prakiraan Cuaca Real-Time (API-First)**:
   - Integrasi langsung dengan Open Data BMKG untuk wilayah Kabupaten Bulungan, Kota Tarakan, Malinau, Nunukan, dan Tana Tidung.
2. **Peringatan Dini Cuaca Nasional & Kaltara (Nowcasting CAP)**:
   - Sinkronisasi otomatis data RSS/CAP dari server pusat BMKG.
   - Pemetaan interaktif sebaran wilayah terdampak menggunakan **Leaflet.js** (skala nasional pada halaman khusus, dan fokus wilayah Kaltara pada halaman Beranda).
3. **Ringkasan Gempabumi Terkini & Dirasakan**:
   - Pembaruan otomatis data gempa otomatis (`autogempa.json` & `gempadirasakan.json`) lengkap dengan visualisasi peta guncangan (*ShakeMap*).
4. **Monitoring Kualitas Udara (AQI / PM2.5)**:
   - Pemantauan parameter kualitas udara wilayah Tanjung Harapan dan stasiun pembanding nasional menggunakan integrasi API WAQI.
5. **Pelayanan Publik & Arsip Digital**:
   - Modul manajemen Rak Buletin (unduh laporan iklim PDF), galeri Peta Iklim (Dasarian & Bulanan), manajemen Berita & Kegiatan stasiun, serta pengelolaan tautan formulir layanan pengajuan data.
6. **Dashboard Admin Terpadu**:
   - Panel autentikasi khusus pegawai untuk mengelola konten website secara mandiri tanpa mengubah kode program.

---

## 🛠️ Spesifikasi Teknis
- **Framework**: Laravel
- **Frontend**: Tailwind CSS, Alpine.js / Blade Templates
- **Mapping Engine**: Leaflet.js (OpenStreetMap Tiles)
- **Data Exchange**: cURL, SimpleXMLElement (RSS/XML/JSON Parser), Laravel HTTP Client
- **Database**: MySQL / MariaDB

---
