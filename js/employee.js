document.addEventListener("DOMContentLoaded", function(){

    document.getElementById("addEmployeeBtn").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("addEmployeeModal").classList.add("show");
    });

    document.getElementById("addClose").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("addEmployeeModal").classList.remove("show");
    });
});