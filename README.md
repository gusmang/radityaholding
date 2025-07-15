<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Tentang Sistem

Dokumen Approval Raditya ( Unit Bisnis & Holding )
Aplikasi ini dibuat untuk mempermudah pengelolaan dokumen dan proses approval dokumen antara Unit Bisnis dan Holding di Raditya.
Dibuat menggunakan laravel 9 & PHP 8.2 + Vite + Bootstrap & jQuery

## Petunjuk Instalasi

-   Composer Install ( install package - package )
-   PHP Artisan Serve ( menjalankan di localhost )
-   Npm Run Dev ( menjalankan vite )

## Petunjuk Database ( Penting )

-   Table Users ( tabel seluruh user raditya ( holding dan unit bisnis ) )
-   Table Positions ( tabel seluruh role raditya )
-   Table Menus ( tabel seluruh menu di sistem raditya )

## Petunjuk Tabel dan Field ( Penting )

-   Table Users ( id_positions adalah id_unit_usaha ( relasi ke table unit_usaha.id) -> jika nilai 0 = holding , jika > 0 = unit usaha , jika -1 = super admin )
-   Table Pengadaan / Pembayaran / Petty Cashes ( id_positions > 0 = status sudah terApprove / sebagai penanda dokumen sudah terApprove , jika nilai = 0 brarti masih status pending )
-   Status Surat Pengadaan ( 1 = "Pengadaan Aset", 2 = "Lainnya", 3 = "Penghapusan Aset", 4 = "Maintenance")
