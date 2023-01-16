import {
    SERVER_PATH
} from '../constants/constants.js'

const buttomExit = document.querySelector(".button__exit")

// событие клика на на кнопку выйти. Обращение идет к файлу destroy.php
buttomExit.addEventListener("click", async (e) => {
    e.preventDefault()
    const res = await fetch(SERVER_PATH + "destroy.php")
    const data = await res.json()
    if(data.status === "ok")
        location.reload()
})