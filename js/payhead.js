document.addEventListener('DOMContentLoaded', function() {
    const url = new URL(window.location.href);
    const userId = url.searchParams.get("userId");

    document.getElementById("dashboardNav").addEventListener("click", () => {
        window.location.href = `dashboard.php?userId=${userId}`;
    });
    document.getElementById("employeeNav").addEventListener("click", () => {
        window.location.href = `employee.php?userId=${userId}`;
    });
    document.getElementById("payheadNav").addEventListener("click", () => {
        window.location.href = `payhead.php?userId=${userId}`;
    });
    document.getElementById("payrollNav").addEventListener("click", () => {
        window.location.href = `payroll.php?userId=${userId}`;
    });
    document.getElementById("about_usNav").addEventListener("click", () => {
        window.location.href = `about_us.php?userId=${userId}`;
    });

    document.getElementById("addPayHeadBtn").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("addPayHeadModal").classList.add("show");
    });

    document.getElementById("addClose").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("addPayHeadModal").classList.remove("show");
    });

    getPayHeads();

    document.getElementById("logoutButton").addEventListener("click", () => {
        window.location.href = "api/logout.php";
    });
});
let userId = null;
let allPayHeads = [];
function getPayHeads(){

    
    fetch("api/store_session.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            userId = data.userId;
            return fetch("api/pay_heads_api.php?userId=" + userId)
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("content").innerHTML = "";
            allPayHeads = data.payHeads;
            data.payHeads.forEach(payHead => {
                document.getElementById("content").innerHTML += `
                    <tr>
                        <td>${payHead.name}</td>
                        <td>${payHead.description}</td>
                        <td>${payHead.type}</td>
                        <td>
                            <button class="btn-edit" data-id="${payHead.pay_head_id}"><i class="fas fa-edit"></i></button>
                            <button class="btn-delete" data-id="${payHead.pay_head_id}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                `;
            }); 

            document.getElementById("addPayHeadForm").addEventListener("submit", (event) => {
                event.preventDefault();
                addPayHead(userId);
            });

            document.querySelectorAll(".btn-edit").forEach(button => {
                button.addEventListener("click", function(event){
                    event.preventDefault();
                    const payHeadId = this.getAttribute("data-id");
                    const payHeadData = data.payHeads.find(p => p.pay_head_id == payHeadId);
                    if(payHeadData){
                        document.getElementById("editPayHeadModal").classList.add("show");

                        document.getElementById("editClose").addEventListener("click", function(event){
                            event.preventDefault();
                            document.getElementById("editPayHeadModal").classList.remove("show");
                        });

                        document.getElementById("editName").value = payHeadData.name;
                        document.getElementById("editDescription").value = payHeadData.description;
                        document.getElementById("editType").value = payHeadData.type;

                        document.getElementById("editPayHeadForm").addEventListener("submit", function(event){
                            event.preventDefault();
                            updatePayHead(userId, payHeadData.pay_head_id)
                        });
                    }
                });
            });

            document.querySelectorAll(".btn-delete").forEach(button => {
                button.addEventListener("click", function(event){
                    event.preventDefault();
                    const payHeadId = this.getAttribute("data-id");
                    const payHeadData = data.payHeads.find(p => p.pay_head_id == payHeadId);
                    if(payHeadData){
                        document.getElementById("deleteModal").classList.add("show");
                        
                        document.getElementById("deleteItemName").textContent = payHeadData.name;

                        document.getElementById("cancelDelete").addEventListener("click", function(event){
                            event.preventDefault();
                            document.getElementById("deleteModal").classList.remove("show");
                        });

                        document.getElementById("confirmDelete").addEventListener("click", function(event){
                            event.preventDefault();
                            deletePayHead(payHeadId);
                        });
                    }
                    
                });
            });
        }
    })
    .catch(error => console.error(error));
}
function addPayHead(id){

    const formData = {
        userId: Number(id),
        name: document.getElementById("name").value,
        description: document.getElementById("description").value,
        type: document.getElementById("type").value
    }
    fetch("api/pay_heads_api.php", {
        method: "POST",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            alert("Added Successfully!");
            window.location.reload();
        }
    })
    .catch(error => console.error(error));
}

function updatePayHead(userIdV, payHeadIdV){
    const formData = {
        payHeadId: Number(payHeadIdV),
        userId: Number(userIdV),
        name: document.getElementById("editName").value,
        description: document.getElementById("editDescription").value,
        type: document.getElementById("editType").value
    }
    fetch("api/pay_heads_api.php", {
        method: "PUT",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            alert("Updated Successfully!");
            window.location.reload();
        }
    })
    .catch(error => console.error(error));
}

function deletePayHead(id){
    const formData = {
        payHeadId: Number(id),
    }
    fetch("api/pay_heads_api.php", {
        method: "DELETE",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            window.location.reload();
        }
    })
    .catch(error => console.error(error));
}

function searchPayHeads() {
    const searchInput = document.getElementById("searchInput").value.toLowerCase();
    const content = document.getElementById("content");
    
    if (!searchInput) {
        // If search is empty, reload all pay heads
        getPayHeads();
        return;
    }
    
    // Filter pay heads based on search input
    const filteredPayHeads = allPayHeads.filter(payHead => {
        const payHeadDetails = `${payHead.name} ${payHead.description || ''} ${payHead.type}`.toLowerCase();
        return payHeadDetails.includes(searchInput) || 
               payHead.pay_head_id.toString().toLowerCase().includes(searchInput);
    });
    
    // Display filtered pay heads
    content.innerHTML = "";
    filteredPayHeads.forEach(payHead => {
        content.innerHTML += `
            <tr>
                <td>${payHead.pay_head_id}</td>
                <td>${payHead.name}</td>
                <td>${payHead.description}</td>
                <td>${payHead.type}</td>
                <td>
                    <button class="btn-edit" data-id="${payHead.pay_head_id}"><i class="fas fa-edit"></i></button>
                    <button class="btn-delete" data-id="${payHead.pay_head_id}"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        `;
    });
    
    // Reattach event listeners to the buttons
    document.querySelectorAll(".btn-edit").forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            const payHeadId = this.getAttribute("data-id");
            const payHeadData = allPayHeads.find(p => p.pay_head_id == payHeadId);
            if (payHeadData) {
                document.getElementById("editPayHeadModal").classList.add("show");

                document.getElementById("editClose").addEventListener("click", function(event) {
                    event.preventDefault();
                    document.getElementById("editPayHeadModal").classList.remove("show");
                });

                document.getElementById("editName").value = payHeadData.name;
                document.getElementById("editDescription").value = payHeadData.description;
                document.getElementById("editType").value = payHeadData.type;

                document.getElementById("editPayHeadForm").addEventListener("submit", function(event) {
                    event.preventDefault();
                    updatePayHead(userId, payHeadData.pay_head_id);
                });
            }
        });
    });

    document.querySelectorAll(".btn-delete").forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            const payHeadId = this.getAttribute("data-id");
            const payHeadData = allPayHeads.find(p => p.pay_head_id == payHeadId);
            if (payHeadData) {
                document.getElementById("deleteModal").classList.add("show");
                
                document.getElementById("deleteItemName").textContent = payHeadData.name;

                document.getElementById("cancelDelete").addEventListener("click", function(event) {
                    event.preventDefault();
                    document.getElementById("deleteModal").classList.remove("show");
                });

                document.getElementById("confirmDelete").addEventListener("click", function(event) {
                    event.preventDefault();
                    deletePayHead(payHeadId);
                });
            }
        });
    });
}