
## Instalasi

1. Composer Install
2. Membuat database dengan konfigurasi 

<p>DB_CONNECTION=mysql</p>
<p>DB_HOST=127.0.0.1</p>
<p>DB_PORT=3306</p>
<p>DB_DATABASE=(database yang dibuat)</p>
<p>DB_USERNAME=root</p>
<p>DB_PASSWORD=</p>

3. Setelah konfigurasi database 
4. Jalankan perintah 'php artisan migrate'
5. Jalankan perintah 'php artisan db:seed' untuk generate data Status
6. Jalankan perintah 'php artisan l5-swagger:generate'
7. Jalankan perintah 'php artisan serve'
8. Jalankan pada browser "http://127.0.0.1:8000/api/documentation"
