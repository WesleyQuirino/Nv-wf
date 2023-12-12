let header = document.querySelector("header");
let btn = document.querySelector("#btn");

function changeBackgroundColor() {
    btn.addEventListener("click", (e) => {
        header.classList.toggle("blue");
        header.classList.toggle("green");
    });
}

changeBackgroundColor();