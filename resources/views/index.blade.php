<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite([
        "resources/css/index.css",
        "resources/js/index.js"
    ])
    <title>Chat</title>
</head>
<body>
    <main>
        <div id="title_container">
            <h1>
                Chat Laravel
            </h1>
        </div>
        <div id="username_container">
            <div id="input_container">
                <label for="username_input">
                    Username:
                </label>
                <input type="text" name="username_input" id="username_input">
            </div>
            <div id="button_container">
                <button id="button_start">
                    Entrar
                </button>
            </div>
        </div>
    </main>
</body>
</html>
