document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("loginForm").addEventListener("submit", function(event){
        event.preventDefault();
        login();
    });
});

function login(){
    const formData = {
        email: document.getElementById("email").value,
        password: document.getElementById("password").value
    }

    fetch("api/login_api.php", {
        method: "POST",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}

    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            alert("Log In Successfully!");
            const userSession = {
                userId: data.userData.user_id
            }
            return fetch("api/store_session.php", {
                method: "POST",
                body: JSON.stringify(userSession),
                headers: {"Content-Type": "application/json"}
            })
            
        }else{
            document.getElementById("errorModal").classList.add("show");

            setTimeout(function() {

                document.getElementById("errorModal").classList.remove("show");

                setTimeout(function() {

                    document.getElementById("errorModal").style.opacity = "";
                }, 500);
            }, 1000);
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            return fetch("api/store_session.php")
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            console.log(data.userId);
            window.location.href = `dashboard.php?userId=${data.userId}`;
        }
    })
    .catch(error => console.error(error));
}