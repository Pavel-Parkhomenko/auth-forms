import {
    loginValidate, 
    passwordValidate,
    errorAction
} from './valid_module.js'

const form = document.querySelector("form")

const NAMES = {
    login: "login",
    password: "password"
}

form.addEventListener("blur", (event) => {
    if(event.target.tagName !== "INPUT") return

    let elem = event.target
    let message;
    switch(elem.name) {
        case NAMES.login:
            message = loginValidate(elem.value)
            errorAction(elem, message)
            break
        case NAMES.password:
            message = passwordValidate(elem.value)
            errorAction(elem, message)
            break
    }
}, true)