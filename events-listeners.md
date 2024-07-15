## 1 - QUEUE_CONNECTION=database
## 2 - php artisan queue:table
## 3 - php artisan migrate
## 4 - php artisan make:event SendEventMail
## 5 - php artisan make:listener SendListnerMailWork --event=SendEventMail
## 6 - Registrar Eventos e Listeners em : app\Providers\EventServiceProvider.php
## 7 - php artisan queue:work ou php artisan queue:work --queue=emailsEvents
## 8 - Execute: http://127.0.0.1:8000/enviar-email
## 9 - Reinicie os workers: php artisan queue:restart
## 10 - Limpa Failed Jobs: php artisan queue:flush
## OBS - Retirando a implemtação da classe 'implements ShouldQueue' dos listners os emails são enviados automaticamente sem 
## serem introduzidos na tabela jobs

Pattern Observer:
Começos pelo controller que processa as regras de negocio direciona ao  evento que distribui aos listners que executam a tarefa
##        controller
    	      |
    		  |
	________Event_______
	|	     |	        |
	|	     |          |	
Listner 1 Listner 2  Listner 3
