const user = sessionStorage.getItem("user");
if(user == null) window.location.href = "/view/index";

const csrfToken = document
  .querySelector('meta[name="csrf-token"]')
  ?.getAttribute('content') ?? '';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY || '85b07856e1d48d85392a', // Fallback explícito
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER || 'sa1', // Fallback explícito
    forceTLS: true,
    encrypted: true,
    disableStats: true,
    auth: {
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        }
    },
    authEndpoint: '/broadcasting/auth'
});

const url = window.location.href;
const channelName = url.substring(url.lastIndexOf('/') + 1);

console.log(`Conectando ao canal: chat.${channelName}`);

window.Echo.channel(`chat.${channelName}`)
    .subscribed(() => {
        console.log("✅ Inscrito no canal: chat." + channelName);
    })
    .error((error) => {
        console.error("❌ Erro na conexão:", error);
    })
    .listen('.mensagem.nova', (e) => {
        console.log('Nova mensagem recebida:', e);
        // Adicione aqui a lógica para exibir a mensagem na tela
    });

document.getElementById("send_message_btn").addEventListener("click", () => {
    const msg = document.getElementById("message_input").value;
    console.log(msg);

    fetch(`/api/saveMessage/${channelName}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
            texto_mensagem: msg,
            nome_usuario: user,
            nome_grupo: channelName,
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


