document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("signupForm").addEventListener("submit", function () {
        addAccount();
    });
});



async function addAccount() {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    // Basic validation


    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        return;
    }



    const formdata = {
        email: email,
        password: password,
    };

    // Send the formdata to your server
    fetch('api/accounts_api.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(formdata),
    })
    .then(response => response.json())
    .then(data => {

    })
    .catch((error) => {
        console.error('Error:', error);
        alert("An error occurred. Please try again later.");
    });
}
