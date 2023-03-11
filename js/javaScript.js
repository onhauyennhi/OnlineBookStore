
// close dang ky / dang nhap
function offreg() {
    const modalEl = document.querySelector(".modal");
    modalEl.style.display = "none";
}
const btndn = document.getElementById("btndn");
btndn.addEventListener("click",
    function () {
        const modalEl = document.querySelector(".modal");
        modalEl.style.display = "block";
    })
//close dang nhap/dang ky
function closelogin() {
    const loginEl = document.querySelector(".login");
    loginEl.style.display = "none";
    const registEl = document.querySelector(".regist");
    registEl.style.display = "block";
}
function closeregist() {
    const registEl = document.querySelector(".regist");
    registEl.style.display = "none";
    const loginEl = document.querySelector(".login");
    loginEl.style.display = "block";
}