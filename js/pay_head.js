document.addEventListener("DOMContentLoaded", function(){
    const open = document.getElementById("open");
    const createModalContainer = document.getElementById("modal-container");
    const discard = document.getElementById("discard");

    open.addEventListener("click", function(){
        createModalContainer.classList.add("show");
    });

    discard.addEventListener("click", function(event){
        event.preventDefault();
        createModalContainer.classList.remove("show");
    });
    fetchPayHead();
});

function fetchPayHead(){
    fetch("fetch/fetch_pay_head.php")
    .then(response => response.json())
    .then(data =>{
        const tableBody = document.getElementById("content");
        tableBody.innerHTML = '';

        data.forEach(payHead =>{
            const row = document.createElement("tr");
            row.classList.add("tr-data-style", "data-row");
            row.setAttribute("data-pay-head-id", payHead.pay_head_id);

            // Add table cells
            const nameCell = document.createElement("td");
            nameCell.classList.add("td-style");
            nameCell.textContent = payHead.name;

            const descriptionCell = document.createElement("td");
            descriptionCell.classList.add("td-style");
            descriptionCell.textContent = payHead.description;

            const typeCell = document.createElement("td");
            typeCell.classList.add("td-style");
            typeCell.textContent = payHead.type;

            // Append cells to the row
            row.appendChild(nameCell);
            row.appendChild(descriptionCell);
            row.appendChild(typeCell);

            // Append the row to the table body
            tableBody.appendChild(row);
        });
        attachRowEventListeners(data);
    })
    .catch("Error");
}

function attachRowEventListeners(data) {
    const rows = document.querySelectorAll(".data-row");
    rows.forEach(row => {
        row.addEventListener("click", function () {
            const payHeadId = row.getAttribute("data-pay-head-id");

            // Find the employee data for the clicked row
            const payHead = data.find(ph => ph.pay_head_id == payHeadId);
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

    const back = document.getElementById("back");
    back.addEventListener("click", function(event){
        event.preventDefault();
        editModalContainer.classList.remove("show");
    });

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