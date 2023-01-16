import {
    SERVER_PATH
} from '../constants/constants.js'

const buttomExit = document.querySelector(".button__exit")

buttomExit.addEventListener("click", async (e) => {
    e.preventDefault()
    const res = await fetch(SERVER_PATH + "destroy.php")
    const data = await res.json()
    if(data.status === "ok")
        location.reload()
})