# Profil IG - Bootstrap & CSS

Project ini adalah simulasi tampilan profil Instagram versi dark mode. Dibuat pakai kombinasi HTML, Bootstrap 5, sama sedikit CSS custom biar feed foto keliatan lebih rapi. Ada dua file utama di sini: "index.html" dan "style.css".

## Struktur Project

```
.
├── index.html       # File utama
├── style.css        # File styling
└── assets/
    ├── CSS/
    │   └── style.css (kalau mau rapihin folder)
    └── IMG/
        ├── PP.jpeg
        ├── FEED_1.jpeg
        ├── FEED_2.jpeg
        └── ... (sampai FEED_12.jpeg)
```

---
## Penjelasan Singkat

### 1. index.html
* Ini file utama yang ngebentuk struktur halaman.
* Udah include "Bootstrap 5.3.3" lewat CDN.
* Bagian-bagiannya:

  * Header Profil : foto profil, username, tombol follow, jumlah postingan, followers, sama following.
  * Bio : teks singkat.
  * Feed Foto : grid foto (3 kolom di hp, 4 kolom di laptop).
  * Hover Info : kalo cursor diarahin ke foto muncul jumlah likes & komen.
  * Footer : copyright kecil di bawah.

### 2. style.css
* Fokusnya buat styling feed biar keliatan seragam.
* Fitur utamanya:

  * Foto otomatis kotak (1:1 aspect ratio).
  * Gambar di-set "object-fit: cover" biar gak ketarik aneh-aneh.
  * Ada efek hover yang munculin overlay likes & komen.

## Cara Jalaninnya
1. Pastikan file dan folder (index.html, style.css, sama assets/IMG) udah lengkap.
2. Tinggal buka "index.html" di browser favorit.
3. Butuh internet aktif buat load "Bootstrap CDN".

## Tampilan
* Tema : full dark mode (background hitam, teks putih).
* Layout : responsif, otomatis ngikutin ukuran layar.
* Efek : hover di foto nunjukin likes & komen.

## Tools yang Dipake
* HTML5
* CSS3
* Bootstrap 5.3.3

