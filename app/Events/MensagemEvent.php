<?php

namespace App\Events;

use App\Dto\MensagemDTO;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MensagemEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public MensagemDTO $dto,
        public string $grupo
    ) {
        Log::info("MensagemEvent disparado para o grupo: {$grupo}");
    }

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
        Log::info("broadcastWith executado: ", [
            'texto' => $this->dto->texto_mensagem,
            'nome_usuario' => $this->dto->nome_usuario,
            'nome_grupo' => $this->dto->nome_grupo,
        ]);
        return [
            'texto' => $this->dto->texto_mensagem,
            'nome_usuario' => $this->dto->nome_usuario,
            'nome_grupo' => $this->dto->nome_grupo,
            'data' => now()->toDateTimeString()
        ];
    }

    public function broadcastAs(): string
    {
        return 'MensagemEvent';
    }
}
