import {
    SERVER_PATH
} from '../constants/constants.js'

export function loginValidate(login) {
    if (/\s/g.test(login)) {
        return "Логин не должен содержать пробелы"
    }
    else if (login.length < 6) {
        return "Логин должен быть больше 6 символов"
    } else return 0
}

let currentPassword = ""
export function passwordValidate(password) {
    currentPassword = password
    if (/\s/g.test(password)) {
        return "Пароль не должен содержать пробелы"
    } else if (password.length <= 6) {
        return "Пароль должен быть больше 6 символов"
    } else if (!/[0-9]/.test(password)) {
        return "Пароль должен содержать цифру"
    } else if (!/[a-zA-z]/.test(password)) {
        return "Пароль должен содержать букву"
    } else return 0
}

export function nameValidate(name) {
    if (/\s/g.test(name)) {
        return "Имя не должно содержать пробелы"
    } else if (name <= 2) {
        return "Имя должно быть больше 2 символов"
    } else if (/[0-9]/.test(name)) {
        return "Имя должно состоять только из букв"
    } else return 0
}

export function conPasswordValidate(conPassword) {
    if (currentPassword !== conPassword) {
        return "Пароли не совпадают"
    } else return 0
}

export function emailValidate(email) {
    if (/\s/g.test(email)) {
        return "Email не должен содержать пробелы"
    } else if (!/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i.test(email)) {
        return "Неверный email"
    } else return 0
}

export function errorAction(elem, message) {
    if (message) {
        messageError(elem, message)
    } else {
        elem.parentNode.querySelector('.message_error')?.remove()
    }
}

/*
Функция, которая выводит сообщение об ошибке клиента.
Ошибка выводится под полем input (elem) в родительском контейнере.
Если контейнер уже имеет собщение, то просто заменяется текст, если нет - 
то создается новое сообщение
*/
function messageError(elem, message) {
    if (!elem.parentNode.querySelector(".message_error")) {
        elem.insertAdjacentHTML('afterend', `<span class="message_error">${message}</span>`);
    } else {
        elem.parentNode.querySelector('.message_error').textContent = message
    }
}

/*
Данная функция выводит сообщение с сервера, такие как 
"Такой логин уже существует", "Неверный логин или пароль" и тп.
Сообщения выводятся под основной формой
*/
export function errorFromServer(container, message) {
    if (!container.querySelector(".message_server")) {
        container.insertAdjacentHTML('beforeend', `<span class="message_server">${message}</span>`);
    } else {
        container.querySelector('.message_server').textContent = message
    }
}

/*
При загрузке страницы проверяем наличие cookie.
*/
export function checkCookie() {
    document.addEventListener("DOMContentLoaded", async (e) => {
        e.preventDefault()
        const res = await fetch(SERVER_PATH + "cookie.php")
        const data = await res.text()
        console.log(data)
    })
}