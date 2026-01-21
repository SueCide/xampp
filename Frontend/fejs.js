import { logout } from "./functions.js";

const button    = document.getElementById("logout");
const textvalue = document.createElement("div")

button.addEventListener("click",() =>{

    logout().then(()=>{

        window.location.href="login.html";

    });
});


