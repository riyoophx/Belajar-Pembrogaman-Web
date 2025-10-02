# Profil IG Dark - TailwindCSS

Project ini adalah simulasi tampilan profil Instagram dengan tema dark mode, dibangun menggunakan "HTML5"" + "TailwindCSS" tanpa Bootstrap. 


## Struktur Project

```
.
├── index.html       # File utama (menggunakan Tailwind CDN)
└── assets/
    └── IMG/         # Folder berisi gambar 
```


## Bagian Halaman

1. **Header Profil**

   * Foto profil (bulat).
   * Username + tombol Follow.
   * Jumlah posts, followers, following.
   * Bio singkat.

2. **Feed**
   * Minimal 12 gambar.
   * Ditampilkan dalam grid responsif:

     * Mobile: `grid-cols-1`
     * Tablet: `grid-cols-2` atau `grid-cols-3`
     * Desktop: `grid-cols-4`
   * Saat gambar di-hover, muncul overlay jumlah likes dan comments.

3. **Footer**
   * Text copyright sederhana.

## Fitur Tailwind yang Dipakai

* Grid Responsive : `grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4`
* Order Utility : `order-1` / `order-2` (mengatur urutan elemen di breakpoint berbeda).
* Col-span : digunakan pada layout header untuk menyesuaikan lebar.
* Spacing : `p-4`, `m-2`, `gap-2`, `space-x-6`.
* Alignment : `flex`, `items-center`, `justify-center`.
* Shadow & Rounded : `shadow-lg`, `rounded-full`, `rounded`.
* Hover Effect : `group-hover:opacity-100 transition`.

## Cara Menjalankan

1. Pastikan semua file sudah ada (`index.html` dan folder `assets/IMG` dengan gambar).
2. Buka `index.html` langsung di browser (Chrome/Firefox/Edge).
3. Tailwind sudah otomatis diload lewat "CDN", jadi tidak perlu instalasi tambahan.

## Responsivitas

* Mobile → Foto feed tampil satu kolom.
* Tablet → Grid 2-3 kolom.
* Desktop → Grid 4 kolom.
* Tombol Follow berubah posisi:

  * Di desktop: kecil di sebelah username.
  * Di mobile: full width di bawah username.

## Tools

* HTML5
* TailwindCSS (via CDN)
