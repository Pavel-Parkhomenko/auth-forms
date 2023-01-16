import {
    loginValidate, 
    passwordValidate,
    conPasswordValidate,
    emailValidate,
    nameValidate,
    errorAction,
    errorFromServer,
    checkCookie
} from './module.js'

import {
    SERVER_PATH
} from '../constants/constants.js'

checkCookie()

const form = document.querySelector("form")
const buttonRedirect = document.querySelector(".button__redirect")
const messServerBox = document.querySelector('.container__bottom')

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

form.addEventListener('submit', async (e) => {
    e.preventDefault()
    if(form.querySelector('.message_error')) return
    const res = await fetch(SERVER_PATH + "registr.php", {
        method: 'POST',
        headers: {
            'X-Requested-With': 'FetchAjaxRequest'
          },
        body: new FormData(form)
    })
    const data = await res.json()
    if(data.type === "success") location.href = "../index.php"
    errorFromServer(messServerBox, data.message)
})

// событие, которое позволяет нам с формы регистрации перейти на форму входа
buttonRedirect.addEventListener('click', () => {
    location.href = '../view/login.php'
})
