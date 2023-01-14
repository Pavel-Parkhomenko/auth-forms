import {
    loginValidate, 
    passwordValidate,
    errorAction,
    errorFromServer,
    checkCookie
} from './module.js'

console.log("checj cookie")
checkCookie()

const form = document.querySelector("form")
const buttonRedirect = document.querySelector(".button__redirect")
const messServerBox = document.querySelector('.container__bottom')

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

console.log('login 2')


form.addEventListener('submit', async (e) => {
    e.preventDefault()
    if(form.querySelector('.message_error')) return
    const res = await fetch("../../server/php/login.php", {
        method: 'POST',
        headers: {
            'X-Requested-With': 'FetchAjaxRequest'
          },
        body: new FormData(form)
    })
    const data = await res.json()
    // const data = await res.text()
    console.log(data)
    if(data.type === "success") location.href = "../index.php"
    errorFromServer(messServerBox, data.message)
})

buttonRedirect.addEventListener('click', () => {
    location.href = '../view/registr.php'
})