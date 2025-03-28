
## Instalasi

1. Composer Install
2. Membuat database dengan konfigurasi 

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=(database yang dibuat)
DB_USERNAME=root
DB_PASSWORD=

3. Setelah konfigurasi database 
4. Jalankan perintah 'php artisan migrate'
5. Jalankan perintah 'php artisan db:seed' untuk generate data Status
6. Jalankan perintah 'php artisan l5-swagger:generate'
7. Jalankan perintah 'php artisan serve'
8. Jalankan pada browser "http://127.0.0.1:8000/api/documentation"
