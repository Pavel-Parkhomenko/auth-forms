const buttomExit = document.querySelector(".container")

buttomExit.addEventListener("submit", async (e) => {
    e.preventDefault()
    const res = await fetch("http://localhost/task-forms/php/destroy.php")
    const data = await res.json()
    if(data.status === "ok")
        location.reload()
})