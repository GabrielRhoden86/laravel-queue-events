## 1 - QUEUE_CONNECTION=database
## 2 - php artisan queue:table
## 3 - php artisan migrate
## 4 - php artisan make:event SendEventMail
## 5 - php artisan make:listener SendListnerMailWork --event=SendEventMail
## 6 - Registrar Eventos e Listeners em : app\Providers\EventServiceProvider.php
## 7 - php artisan queue:work
## 8 - Execute: http://127.0.0.1:8000/enviar-email
## 9 - Reinicie os workers: php artisan queue:restart
## 10 - Limpa Failed Jobs: php artisan queue:flush
