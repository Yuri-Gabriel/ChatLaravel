const user = sessionStorage.getItem("user");

if(user != null) {
    window.location.href = "/chat";
}

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

    fetch('/api/saveUser', {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            username: username
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
        window.sessionStorage.setItem("user", JSON.stringify(json));
        window.location.href = "/chat";
    })
    .catch(error => {
		console.log(error.message);
        alert(error.message);
    });
});
