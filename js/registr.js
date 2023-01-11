import {
    loginValidate, 
    passwordValidate,
    conPasswordValidate,
    emailValidate,
    nameValidate,
    errorAction
} from './valid_module.js'

const form = document.querySelector("form")

const NAMES = {
    login: "login",
    password: "password",
    name: 'name',
    email: 'email',
    conPassword: 'conPassword'
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
        case NAMES.conPassword:
            message = conPasswordValidate(elem.value)
            errorAction(elem, message)
            break
        case NAMES.email:
            message = emailValidate(elem.value)
            errorAction(elem, message)
            break
        case NAMES.name:
            message = nameValidate(elem.value)
            errorAction(elem, message)
            break
    }
}, true)
