<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" th:href="@{style/chat.css}">
    <title>Chat</title>
</head>
<body>
    <main>
        <section id="message_area">
            
        </section>
        <section id="input_container">
            <input type="text" id="message_input">
            <button id="send_message_btn">
                Enviar
            </button>
        </section>
    </main>
    <!-- SockJS -->
	<script src="https://cdn.jsdelivr.net/npm/sockjs-client@1/dist/sockjs.min.js"></script>
	
	<!-- STOMP.js (versão compatível) -->
	<script src="https://cdn.jsdelivr.net/npm/@stomp/stompjs@6.1.2/bundles/stomp.umd.min.js"></script>

    
    <script th:src="@{script/chat.js}"></script>
</body>
</html>