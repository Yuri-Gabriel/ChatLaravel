const user = sessionStorage.getItem("user");

if(user == null) {
    window.location.href = "/view/index";
}

const csrfToken = document
  .querySelector('meta[name="csrf-token"]')
  ?.getAttribute('content') ?? '';

const create_group_btn = document.getElementById("create_group_btn");

create_group_btn.addEventListener("click", () => {
    alert("btn");
    let nome_grupo = document.getElementById("nome_grupo_input").value;

    nome_grupo = nome_grupo.trim().replaceAll("[\\.\\s]", "");
    alert(nome_grupo);

    fetch('/api/createGroup', {
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        method: "POST",
        body: JSON.stringify({
            nome_grupo: nome_grupo
        }),
    })
    .then(async response => {
        console.log(response);
        if(response.status == 201) {
            alert("foi");
            return response.json();
        }
        alert("não foi");
        throw new Error(await response.json());
    })
    .then(json => {
        alert(json.message);
        window.location.href = `/view/chat/${nome_grupo}`;
    })
    .catch(error => {
        alert("Erro ao criar");
        console.log(error.error);
    });
});
