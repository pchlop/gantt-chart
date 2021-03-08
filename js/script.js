let login = document.getElementById("login");
let signup = document.getElementById("signup");
let modal_close = document.getElementById("modal_close");
let modal_close_sign = document.getElementById("modal_close_sign");



login.addEventListener("click", function() {
    let login_modal = document.getElementById("login_modal");
    login_modal.classList.remove("hidden");
})

signup.addEventListener("click", function() {
    let signup_modal = document.getElementById("signup_modal");
    signup_modal.classList.remove("hidden");
})

modal_close.addEventListener("click", function() {
    let login_modal = document.getElementById("login_modal");
    login_modal.classList.add("hidden");
})

modal_close_sign.addEventListener("click", function() {
    let signup_modal = document.getElementById("signup_modal");
    signup_modal.classList.add("hidden");
})

