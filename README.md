# Pengenalan
REST API (Representational State Transfer Application Programming Interface) adalah antarmuka pemrograman aplikasi (API) yang memungkinkan pertukaran data dan komunikasi antara perangkat lunak atau sistem komputer.

REST API yang saya buat adalah data wilayah indonesia meliputi data provinsi (provinces), kabupaten/kota (regencies), kecamatan (districts), dan kelurahan/desa (villages) menggunakan teknologi Laravel dan MYSQL Sebagai Databasenya. Biasanya data ini digunakan untuk membuat sebuah dropdown bertingkat untuk mencari data kabupaten/kota berdasarkan nama provinsi dan seterusnya.

## Versi PHP Minimal Untuk Menjalankan Api
PHP v 7.4 >= (Pastikan Sudah Menginstall Composer)

## Cara Menggunakan Api

Untuk melakukan testing data api silahkan menggunakan tools berikut : Postman, Thunder (VS Code Extension).

Berikut adalah url request api beserta methodnya

<b> Untuk Mendapatkan Data Provinsi </b>

```javascript
GET https://wilayah-indo.dev19.my.id/api/provinces
```

<b> Untuk Mendapatkan Data Kabupaten/Kota Berdasarkan Provinsi </b>

```javascript
GET https://wilayah-indo.dev19.my.id/api/regencies/{provinces_id}
```

Contoh :
jika anda ingin mendapatkan nama kabupaten/kota dari provinsi banten

```javascript
GET https://wilayah-indo.dev19.my.id/api/regencies/36
```

<b> Untuk Mendapatkan Data Kecamatan Berdasarkan Kabupaten/Kota </b>

```javascript
GET https://wilayah-indo.dev19.my.id/api/districts/{regencies_id}
```

Contoh :
jika anda ingin mendapatkan nama kecamatan dari kota tangerang

```javascript
GET https://wilayah-indo.dev19.my.id/api/districts/3671
```

<b> Untuk Mendapatkan Data Kelurahan/Desa Bedasarkan Kecamatan </b>

```javascript
GET https://wilayah-indo.dev19.my.id/api/villages/{districts_id}
```

Contoh :
jika anda ingin mendapatkan nama kelurahan/desa dari kecamatan neglasari

```javascript
GET https://wilayah-indo.dev19.my.id/api/villages/3671051
```

<b> Untuk Mendapatkan Semua Data Kabupaten/Kota </b>

```javascript
GET https://wilayah-indo.dev19.my.id/api/data_regencies
```

<b> Untuk Mendapatkan Semua Data Kecamatan </b>

```javascript
GET https://wilayah-indo.dev19.my.id/api/data_districts
```

<b> Untuk Mendapatkan Semua Data Kelurahan </b>

```javascript
GET https://wilayah-indo.dev19.my.id/api/data_villages
```

## Jika Ingin Disimpan ke hosting kalian

Clone Repo

```javascript
$ git clone https://github.com/fajarsapwebdev19/api-wilayah-indo.git
```

Setelah Selesai Clone

```javascript
$ cd api-wilayah-indo
```

kemudian ketik perintah berikut untuk membuat file .env
```javascript
$ cp .env.example .env
```

setelah sudah dilakukan semua silahkan konfigurasi file .env dengan code editor kesayangan kalian
```javascript
DB_DATABASE=nama_database
DB_USERNAME=username_database
DB_PASSWORD=password_database //kosongkan jika anda ingin mengujinya di local
```

setelah sudah semua ketikan perintah berikut di terminal mengarah pada folder project ini
```javascript
$ php artisan key:generate
```

setelah key tergenerate, selanjutnya ketikan perintah berikut untuk membuat table secara otomatis
```php
$ php artisan migrate
```

kemudian import database. lokasi database ada di database/backup/wilayah_indo_data.sql

ketik perintah berikut untuk menjalankan server local pastikan apache dan mysql dalam keadaan aktif di web serve local kalian

```javascript
$ php artisan serve
```

api sudah siap di gunakan
## Status Code
| Status Code | Description |
| :--- | :--- |
| 200 | Success |
| 404 | Forbiden |
| 500 | Internal Server Error |
| 503 | No Data Available |

## Note
Apabila ada kesalahan dalam menuliskan format api silahkan berikan kritik dan sarannya ke email fajarsaputrawebdev19@gmail.com

Jangan lupa bintangnya :). Jika ini bermanfaat
