const buttomExit = document.querySelector(".container")

console.log("index 1")

buttomExit.addEventListener("submit", async (e) => {
    e.preventDefault()
    const res = await fetch("http://localhost/task-forms/server/php/destroy.php")
    const data = await res.json()
    // const data = await res.text()
    // console.log(data)
    if(data.status === "ok")
        location.reload()
})