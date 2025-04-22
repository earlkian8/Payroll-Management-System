document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("overlay").addEventListener("click", function(){
        document.getElementById("overlay").classList.remove("show");
        document.getElementById("modal-container").classList.remove("show");
        document.getElementById("edit-modal-container").classList.remove("show");
        document.getElementById("confirm-save-container").classList.remove("show");
        document.getElementById("confirm-delete-container").classList.remove("show");
    });
    const open = document.getElementById("open");
    const createModalContainer = document.getElementById("modal-container");
    const discard = document.getElementById("discard");
    const overlay = document.getElementById("overlay");
    open.addEventListener("click", function(){
        createModalContainer.classList.add("show");
        overlay.classList.add("show")
    });

    discard.addEventListener("click", function(event){
        event.preventDefault();
        createModalContainer.classList.remove("show");
        overlay.classList.remove("show");
    });
    fetchPayHead();
    
    createModalContainer.addEventListener("submit", function(){
        addPayHead();
    });
    
    document.getElementById("confirm-save-container").addEventListener("submit", function(){
        editPayHead();
    });
    document.getElementById("confirm-delete-container").addEventListener("submit", function(){
        deletePayHead();
    });
});

function fetchPayHead(){
    fetch("api/pay_head_api.php")
    .then(response => response.json())
    .then(data =>{
        if(data.status === "success"){
            const tableBody = document.getElementById("content");
            tableBody.innerHTML = '';

            data.payHeads.forEach(payHead =>{
                tableBody.innerHTML += `
                    <tr class="tr-data-style" data-pay-head-id="${payHead.pay_head_id}">
                        <td class="td-style">${payHead.name}</td>
                        <td class="td-style">${payHead.description}</td>
                        <td class="td-style">${payHead.type}</td>
                    </tr>
                `;
            });
            attachRowEventListeners(data);
        }
    })
    .catch("Error");
}

function attachRowEventListeners(data) {
    const rows = document.querySelectorAll(".tr-data-style");
    rows.forEach(row => {
        row.addEventListener("click", function () {
            const payHeadId = row.getAttribute("data-pay-head-id");

            const payHead = data.payHeads.find(ph => ph.pay_head_id == payHeadId);
            if (payHead) {
                showModal(payHead);
            }
        });
    });
}

function showModal(payHead){

    const editModalContainer = document.getElementById("edit-modal-container");
    document.getElementById("editPayHeadId").value = payHead.pay_head_id;
    document.getElementById("editName").value = payHead.name;
    document.getElementById("editDescription").value = payHead.description;
    document.getElementById("editType").value = payHead.type;

    editModalContainer.classList.add("show");
    document.getElementById("overlay").classList.add("show");
    
    const save = document.getElementById("save");
    const confirmSaveContainer = document.getElementById("confirm-save-container");

    save.addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("savePayHeadId").value = document.getElementById("editPayHeadId").value;
        document.getElementById("saveName").value = document.getElementById("editName").value;
        document.getElementById("saveDescription").value = document.getElementById("editDescription").value;
        document.getElementById("saveType").value = document.getElementById("editType").value;
        confirmSaveContainer.classList.add("show");
    });

    const cancelButtonSave = document.getElementById("cancel-button-save");
    cancelButtonSave.addEventListener("click", function(event){
        event.preventDefault();
        confirmSaveContainer.classList.remove("show");
    });

    const del = document.getElementById("delete");
    const confirmDeleteContainer = document.getElementById("confirm-delete-container");

    del.addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("deletePayHeadId").value = payHead.pay_head_id;
        confirmDeleteContainer.classList.add("show");
    });

    const cancelButtonDelete = document.getElementById('cancel-button-delete');
    cancelButtonDelete.addEventListener("click", function(event){
        event.preventDefault();
        
        confirmDeleteContainer.classList.remove("show");
    });
}

function addPayHead(){
    const formData = {
        name: document.getElementById("name").value.trim(),
        description: document.getElementById("description").value.trim(),
        type: document.getElementById("type").value.trim()
    }
    fetch("api/pay_head_api.php", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "message") {
        }
    })
    .catch(error => console.error(error));
}

function editPayHead(){
    const formData = {
        savePayHeadId: Number(document.getElementById("savePayHeadId").value),
        saveName: document.getElementById("saveName").value.trim(),
        saveDescription: document.getElementById("saveDescription").value.trim(),
        saveType: document.getElementById("saveType").value.trim()
    }
    
    fetch("api/pay_head_api.php", {
        method: "PUT",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "message") {
        }
    })
    .catch(error => console.error(error));
}

function deletePayHead(){
    const formData = {
        deletePayHeadId: Number(document.getElementById("deletePayHeadId").value)
    }
    fetch("api/pay_head_api.php", {
        method: "DELETE",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "message") {
        }
    })
    .catch(error => console.error(error));
}