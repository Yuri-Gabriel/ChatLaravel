const user = sessionStorage.getItem("user");

if(user != null) {
    window.location.href = "/view/group";
}

const csrfToken = document
  .querySelector('meta[name="csrf-token"]')
  ?.getAttribute('content') ?? '';

const button_start = document.getElementById("button_start");

button_start.addEventListener("click", () => {
    const username = document.getElementById("username_input").value.trim();
    if(username == "") {
        alert("Username is empty");
        return;
    } else if(username.length < 3) {
        alert("The username is small: " + username);
        return;
    }

    fetch('/api/createUser', {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
            nome_usuario: username
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
        window.sessionStorage.setItem("user", username);
        window.location.href = "/view/group";
    })
    .catch(error => {
		console.log(error.message);
        alert(error.message);
    });
});
