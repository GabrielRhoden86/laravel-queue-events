<?php

namespace App\Listeners;

use App\Events\SendEventMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendListnerMailWork
{
    /**
     * Handle the event.
     */
    public function __construct()
    {
        //
    }

    public function handle(SendEventMail $event):void
    {
        $user = $event->user;

        try {
            Mail::send('confirmationEmail', ['dados' => $user], function ($message) use ($user) {
                $usuario_cadastrado = ucfirst($user->name);
                $message->from('gabrielrhodden@gmail.com');
                $message->to($user->email, $user->name)->subject("Senhor(a) {$usuario_cadastrado} segue email da Work!");
            });
            Log::info('User data:', [
                'name' => $user->name,
                'status' => 'Olá eu sou o handle Work!',
            ]);
        } catch (\Exception $e) {
            Log::error('Erro no Envio: ' . $e->getMessage());
            throw $e;
        }
    }
}
