window.onload = () => {
let taskdone = document.querySelectorAll(".taskdone")
for (button of taskdone) {
    button.addEventListener("click", function () {
        let xmhttp = new XMLHttpRequest;
        xmhttp.open("get", `/semaine-actuelle/fait/${this.dataset.taskdone}`)
        xmhttp.send()
    })
}}