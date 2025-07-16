<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite([
        "resources/js/group.js"
    ])
    <title>Group</title>
</head>
<body>
<!--
    - Carregar uma lista com todos os grupos existentes, pode ter uam filtragem com imput text tbm,
        onde cada item da lista é um link para acessar o respectivo grupo
    - Input para criar um novo grupo
    - Botão para criar o grupo
-->
    <div>
        <div>
            <ul>
                @foreach ($groups as $group)
                    <li>
                        <a href="/view/chat/{{ $group->nome_grupo }}">
                            {{ $group->nome_grupo }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div>
            <div>
                <div>
                    <h3>
                        Crie um grupo
                    </h3>
                </div>
                <div>
                    <label for="nome_grupo">Nome do grupo</label>
                    <input type="text" name="nome_grupo" id="nome_grupo_input"/>
                </div>
                <div>
                    <button id="create_group_btn" >
                        Criar grupo
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
