import { check_data } from "./functions.js";

const text      = document.getElementById("text");
const username  = document.getElementById("username");
const password  = document.getElementById("Password");
const button    = document.getElementById("confirm_button");
const rbutton    = document.getElementById("register_button");
const textvalue = document.createElement("div");

button.addEventListener("click",main);

let a = 1

function main() {

    const name = username.value;
    const pass = password.value;

    if (!name||!pass) {
        
        textvalue.textContent = `please enter both username and password  [${a}]`
        a++
        text.appendChild(textvalue)

    } else {
        
        check_data(name,pass).then(res =>{

            console.log(res)

            textvalue.textContent = `${res.message}  [${a}]`
            a++
            text.appendChild(textvalue)

            if (res.status === 'success'){

                window.location.href = "fejs.php"

            }
        });
    }
}

rbutton.addEventListener("click",register_b)

function register_b() {

    window.location.href = "register.html"
    
}