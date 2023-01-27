import {
    loginValidate, 
    passwordValidate,
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
    password: "password"
}

// событие потери фокуса. При потери фокуса срабатывает функция проверки
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

form.addEventListener('submit', async (e) => {
    e.preventDefault()
    // если у нас висит сообщение об ошибке, то форму не отправляем
    if(form.querySelector('.message_error')) return
    try{
        const res = await fetch(SERVER_PATH + "login.php", {
            method: 'POST',
            headers: {
                'X-Requested-With': 'FetchAjaxRequest'
              },
            body: new FormData(form)
        })
        const data = await res.json()
        // если сервер вернул type: succes (успех), то делаем редирект на главую страницу
        if(data.type === "success") location.href = "../index.php"
        errorFromServer(messServerBox, data.message)
    } catch(e){
        errorFromServer(messServerBox, "Ошибка на сервере")
    }

})

buttonRedirect.addEventListener('click', () => {
    location.href = '../view/registr.php'
})