window.onload = () => {
    let taskdone = document.querySelectorAll(".taskdone")
    for (button of taskdone) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/semaine-actuelle/fait/p1/${this.dataset.taskdone}`)
            xmhttp.send()
        })
    }
}
window.onload = () => {
    let taskdone = document.querySelectorAll(".taskdone")
    for (button of taskdone) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/semaine-actuelle/fait/p2/${this.dataset.taskdone}`)
            xmhttp.send()
        })
    }
}
window.onload = () => {
    let taskdone = document.querySelectorAll(".taskdone")
    for (button of taskdone) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/semaine-suivante/fait/p1/${this.dataset.taskdone}`)
            xmhttp.send()
        })
    }
}
window.onload = () => {
    let taskdone = document.querySelectorAll(".taskdone")
    for (button of taskdone) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/semaine-suivante/fait/p2/${this.dataset.taskdone}`)
            xmhttp.send()
        })
    }
}