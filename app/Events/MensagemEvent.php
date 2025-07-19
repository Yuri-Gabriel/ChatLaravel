<?php

namespace App\Events;

use App\Dto\MensagemDTO;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MensagemEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public MensagemDTO $dto,
        public string $grupo
    ) { }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.'.$this->grupo),
        ];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        Log::debug("Broadcasting para chat.{$this->grupo}", [
            'texto' => $this->dto->texto_mensagem,
            'nome_usuario' => $this->dto->nome_usuario,
            'nome_grupo' => $this->dto->nome_grupo,
            'data' => now()->toDateTimeString()
        ]);

        return [
            'texto' => $this->dto->texto_mensagem,
            'nome_usuario' => $this->dto->nome_usuario,
            'nome_grupo' => $this->dto->nome_grupo,
            'data' => now()->toDateTimeString()
        ];
    }
}
