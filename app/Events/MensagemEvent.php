<?php

namespace App\Events;

use App\Dto\MensagemDTO;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MensagemEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public MensagemDTO $dto
    )
    {
        Log::debug("MensagemDTO(): ", [
            'texto' => $this->dto->texto_mensagem,
            'nome_usuario' => $this->dto->nome_usuario,
            'nome_grupo' => $this->dto->nome_grupo,
        ]);
    }

    public function broadcastOn(): Channel
    {
        Log::debug("broadcastOn(): 'chat.'.{$this->dto->nome_grupo})", [
            'texto' => $this->dto->texto_mensagem,
            'usuario' => $this->dto->nome_usuario,
            'grupo' => $this->dto->nome_grupo,
            'hora' => now()->toDateTimeString()
        ]);
        return new Channel('chat.'.$this->dto->nome_grupo);
    }

    public function broadcastAs()
    {
        Log::debug("broadcastAs(): 'mensagem.nova'", [
            'texto' => $this->dto->texto_mensagem,
            'usuario' => $this->dto->nome_usuario,
            'grupo' => $this->dto->nome_grupo,
            'hora' => now()->toDateTimeString()
        ]);
        return 'mensagem.nova';
    }

    public function broadcastWith()
    {
        Log::debug("broadcastWith(): ", [
            'texto' => $this->dto->texto_mensagem,
            'usuario' => $this->dto->nome_usuario,
            'grupo' => $this->dto->nome_grupo,
            'hora' => now()->toDateTimeString()
        ]);
        return [
            'texto' => $this->dto->texto_mensagem,
            'usuario' => $this->dto->nome_usuario,
            'grupo' => $this->dto->nome_grupo,
            'hora' => now()->toDateTimeString()
        ];
    }
}
