document.addEventListener("DOMContentLoaded", function(){

    const open = document.getElementById("open");
    const discard = document.getElementById("discard");
    const create = document.getElementById("create");
    const modalContainer = document.getElementById("modal-container");

    open.addEventListener("click", function(){
        modalContainer.classList.add("show");
    });

    discard.addEventListener("click", function(event){
        event.preventDefault();
        modalContainer.classList.remove("show");
    });

    create.addEventListener("click", function(){
        modalContainer.classList.remove("show");
    });
});