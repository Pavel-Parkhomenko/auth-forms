export function loginValidate(login) {
    if(login.length < 6) {
        return "Логин должен быть больше 6 символов"
    } else return 0
}

let currentPassword = "" 
export function passwordValidate(password) {
    currentPassword = password
    if(password.length <= 6) {
        return "Пароль должен быть больше 6 символов"
    } else if(!/[0-9]/.test(password)) {
        return "Пароль должен содержать цифру"
    } else if(!/[a-zA-z]/.test(password)) {
        return "Пароль должен содержать букву"
    } else return 0
}

export function nameValidate(name) {
    if(name <= 2){
        return "Имя должно быть больше 2 символов"
    } else if(/[0-9]/.test(name)) {
        return "Имя должно состоять только из букв"
    } else return 0
}

export function conPasswordValidate(conPassword) {
    if(currentPassword !== conPassword){
        return "Пароли не совпадают"
    } else return 0
}

export function emailValidate(email) {
    if(!/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i.test(email)) {
        return "Неверный email"
    } else return 0
}

function messageError(elem, message) {
    if(!elem.parentNode.querySelector(".message_error")) {
        elem.insertAdjacentHTML('afterend', `<span class="message_error">${message}</span>`);
    } else {
        elem.parentNode.querySelector('.message_error').textContent = message
    }
}

export function errorAction(elem, message) {
    if(message){
        messageError(elem, message)
    } else {
        elem.parentNode.querySelector('.message_error')?.remove()
    }
}