<?php

namespace App\Listeners;

use App\Events\SendEventMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendListnerMailHome implements ShouldQueue
{

    public $queue = 'emailsEvents';
    // Cada tentativa terá um tempo limite de 120 segundos, com um atraso de 10 segundos entre as tentativas.
    public $tries = 3;  // Número de tentativas
    public $timeout = 120;  // Tempo limite em segundos
    public $backoff = 10; // Atraso entre tentativas em segundos
    // Após o tratamento acima caso o email falhe, ele será movido para a fila jobs_failed após 3 tentativas.

    public function handle(SendEventMail $event): void
    {
        $user = $event->user;
        try {
            Mail::send('confirmationEmail', ['dados' => $user], function ($message) use ($user) {
                $usuario_cadastrado = ucfirst($user->name);
                $message->from('gabrielrhodden@gmail.com');
                $message->to($user->email, $user->name)->subject("Senhor(a) {$usuario_cadastrado} segue email da Home!");
            });
            Log::info('Email enviado com sucesso para ' . $user->email.' fila Home!');
        } catch (\Exception $e) {
            Log::error('Erro no Envio: ' . $e->getMessage());
            $this->handleFailure($user, $e);
        }
    }

    protected function handleFailure($user, $exception): void
    {
        // Exemplo de registro no log específico para falhas de email
        Log::channel('mail')->error('Todas as tentativas de envio do email para ' . $user->email . ' falharam: ' . $exception->getMessage());
    }
}
