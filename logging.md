## 1 - Primeiro, defina um novo canal de log no seu arquivo de configuração config/logging.php:
'channels' => [
    // ...
    'mail' => [
        'driver' => 'single',
        'path' => storage_path('logs/mail.log'),
        'level' => 'error',
    ],
    // ...
],


## 2 - use algo assim Log::channel('mail')->error()....
public function failed(SendEventMail $event, \Exception $exception)
{
    $user = $event->user;
    Log::channel('mail')->error('Todas as tentativas de envio do email para '.$user->email.' falharam' . $exception->getMessage());
}
