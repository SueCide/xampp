import { checkUser } from "./functions.js";
import { create_a_guy } from "./functions.js";

const text      = document.getElementById("text");
const username  = document.getElementById("username");
const password  = document.getElementById("Password");
const password2 = document.getElementById("Password2");
const button    = document.getElementById("confirm_button");
const lbutton    = document.getElementById("login_button");
const textvalue = document.createElement("div")

button.addEventListener("click",main) 

let a = 1

function main (){

    const name = username.value;
    const pass1 = password.value;
    const pass2 = password2.value;
    
    if (pass1 !== pass2) {
        
        textvalue.textContent = `passwords doesn't match  [${a}]`
        a++
        text.appendChild(textvalue); 

    }else if(pass1==""||pass2==""||name==""){   
        
        textvalue.textContent = `please enter both username and password  [${a}]`
        a++
        text.appendChild(textvalue);

    }else if(name.length<5 || pass1.length<5){

        textvalue.textContent = `username and password has to be at least 5 symbols long  [${a}]`
        a++
        text.appendChild(textvalue);

    }else{
        
        checkUser(name).then(exist =>{
             if (exist) {

                textvalue.textContent = `username already exists [${a}]`
                a++
                text.appendChild(textvalue)
                
             } else {
                
                create_a_guy(name,pass1).then(res =>{

                    if (res.status ==='success'){

                        textvalue.textContent = `success`
                        a++
                        text.appendChild(textvalue)
                        window.location.href = "login.html"

                    } else {

                        console.log('error: ',res)

                    }

                });                
             }
        }); 
    }    
}

lbutton.addEventListener("click",login_b)

function login_b() {

    window.location.href = "login.html"
    
}