document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("registerForm").addEventListener("submit", function(event){
        event.preventDefault();
        addUser();
    });
});

function addUser(){
    if(document.getElementById("password").value === document.getElementById("confirmPassword").value){
        const formData = {
        email: document.getElementById("email").value,
        password: document.getElementById("password").value
        }
        fetch("api/user_api.php", {
            method: "POST",
            body: JSON.stringify(formData),
            headers: {"Content-Type": "application/json"}
        })
        .then(response => response.json())
        .then(data => {
            if(data.status === "success"){
                alert("Created Successfully!");
                window.location.href = "index.php";
            }
        })
        .then(error => console.error(error));
    }
}