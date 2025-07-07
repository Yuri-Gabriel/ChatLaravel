var user_session = null;

const user = sessionStorage.getItem("user");

if(user == null) {
    window.location.href = "/";
} else {
	try {
		user_session = JSON.parse(user);
	} catch (err) {
		window.location.href = "/";
	}
}

const stompClient = new StompJs.Client({
    webSocketFactory: () => new SockJS('http://' + window.location.host + '/ws')
});


stompClient.onConnect = (frame) => {
  console.log("Conectado: " + frame);
  
  stompClient.subscribe("/getMessages", (messageOutput) => {
	console.log("Mensagem recebida:", messageOutput);
	const message = JSON.parse(messageOutput.body);
	loadMessages(message);
 });
};

stompClient.onWebSocketError = (error) => {
    console.error('Error with websocket', error);
};

stompClient.onStompError = (frame) => {
    console.error('Broker reported error: ' + frame.headers['message']);
    console.error('Additional details: ' + frame.body);
};

stompClient.activate();

window.onload = () => {
    const messageArea = document.getElementById('message_area');
    messageArea.scrollTop = messageArea.scrollHeight;
}

const loadMessages = (message) => {
	const message_container = document.getElementById("message_area");
	const isThisUser = message.user.id === user_session.id;
	let html = `<div class="message_container ${isThisUser ? "this_user_message" : ""}">` +
					'<div class="message_component">' +
						'<div class="username_message">' +
							`<h4>${message.user.username}</h4>` +
						'</div>' +
						'<div class="text_message">' +
							`<label>${message.content}</label>` +
						'</div>' +
					'</div>' +
				'</div>';
		message_container.insertAdjacentHTML('beforeend', html);
		message_container.scrollTop = message_container.scrollHeight;
}

const send_message_btn = document.getElementById("send_message_btn");
send_message_btn.addEventListener("click", () => {
	const message = document.getElementById("message_input");
	if(message.value.trim() != "") {
		const messageDTO = {
            user: user_session,
			content: message.value
        }
		stompClient.publish({
	        destination: "/app/saveMessage",
	        body: JSON.stringify(messageDTO)
	    });
	}
	message.value = "";
});

