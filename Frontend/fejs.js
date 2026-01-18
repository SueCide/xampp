

const button    = document.getElementById("back_login_button");
const textvalue = document.createElement("div")

button.addEventListener("click",() => {
    destroy_session()
    window.location.href = "login.html"

});

function destroy_session(){

 

}
