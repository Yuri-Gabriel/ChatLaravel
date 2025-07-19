const user = sessionStorage.getItem("user");
if(user == null) window.location.href = "/view/index";

const csrfToken = document
  .querySelector('meta[name="csrf-token"]')
  ?.getAttribute('content') ?? '';

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],

});

const url = window.location.href;

const channel = url.substring(url.lastIndexOf('/') + 1);
console.log(`chat.${channel}`)
window.Echo.private(`chat.${channel}`).listen(".MensagemEvent", (e) => {
    console.log(e)
});

document.getElementById("send_message_btn").addEventListener("click", () => {
    const msg = document.getElementById("message_input").value;
    console.log(msg);

    fetch(`/api/saveMessage/${channel}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
            texto_mensagem: msg,
            nome_usuario: user,
            nome_grupo: channel,
        })
    })
    .then(async response => {
        if(response.status == 201) {
            return response.json();
        }
		const errorJson = await response.json();
		throw new Error(errorJson.message || "Erro desconhecido");
    })
    .then(json => {
        console.log(json);
    })
    .catch(error => {
		console.log(error.message);
        alert(error.message);
    });
});


