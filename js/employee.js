document.addEventListener("DOMContentLoaded", function(){

    const open = document.getElementById("open");
    const discard = document.getElementById("discard");
    const create = document.getElementById("create");
    const modalContainer = document.getElementById("modal-container");
    const employeeDetails = document.getElementById("employee-details");
    const editModalContainer = document.getElementById("edit-modal-container");
    const confirmSaveContainer = document.getElementById("confirm-save-container");
    const confirmDeleteContainer = document.getElementById("confirm-delete-container");
    const overlay = document.getElementById("overlay");
    open.addEventListener("click", function(){
        modalContainer.classList.add("show");
        overlay.classList.add("show");
    });

    overlay.addEventListener("click", function(event){
        event.preventDefault();
        modalContainer.classList.remove("show");
        employeeDetails.classList.remove("show");
        editModalContainer.classList.remove("show");
        confirmSaveContainer.classList.remove("show");
        confirmDeleteContainer.classList.remove("show");
        overlay.classList.remove("show");
    });

    discard.addEventListener("click", function(event){
        event.preventDefault();
        modalContainer.classList.remove("show");
        overlay.classList.remove("show");
    });

    create.addEventListener("click", function(){
        modalContainer.classList.remove("show");
    });

    fetchEmployees();

    modalContainer.addEventListener("submit", function(){
        addEmployee();
    });

});

let allEmployees = [];

function fetchEmployees() {
    fetch("api/employee_api.php")
        .then(response => response.json())
        .then(data => {
            if(data.status === "success"){
                const content = document.getElementById("content");
                allEmployees = data.employees;
                data.employees.forEach(employee =>{
                    content.innerHTML += `
                        <tr class="tr-body-style" data-employee-id=${employee.employee_id}>
                            <td class="td-style">${employee.first_name} ${employee.middle_name ? employee.middle_name + "" : " "} ${employee.last_name}</td>
                            <td class="td-style">${employee.designation}</td>
                            <td class="td-style">${employee.employment_type}</td>
                        </tr>
                    `;
                });

                attachRowEventListeners(data);

            }
        })
        .catch(error => console.error("Error fetching employees", error));
}

function attachRowEventListeners(data) {
    const rows = document.querySelectorAll(".tr-body-style");
    rows.forEach(row => {
        row.addEventListener("click", function () {
            const employeeId = row.getAttribute("data-employee-id");

            const employee = data.employees.find(emp => emp.employee_id == employeeId);
            if (employee) {
                showModal(employee);
            }
        });
    });
}

function showModal(employee){
    const employeeDetails = document.getElementById('employee-details');
    const overlay = document.getElementById("overlay");
    const closeDetails = document.getElementById("close-details");
    employeeDetails.addEventListener("click", function(event) {
        if (event.target === employeeDetails) {
            employeeDetails.classList.remove("show");
            confirmDeleteContainer.classList.remove("show");
        }
    });

    closeDetails.addEventListener("click", function(event){
        employeeDetails.classList.remove("show");
    });


    document.getElementById("employee-full-name").textContent = `${employee.first_name} ${employee.middle_name ? employee.middle_name + "" : " "} ${employee.last_name}`;
    document.getElementById("detail-full-name").textContent = `${employee.first_name} ${employee.middle_name ? employee.middle_name + "" : " "} ${employee.last_name}`;
    document.getElementById("detail-gender").textContent = `${employee.gender}`;
    document.getElementById("detail-birthday").textContent = `${employee.birthday}`;
    document.getElementById("detail-employment-type").textContent = `${employee.employment_type}`;
    document.getElementById("detail-designation").textContent = `${employee.designation}`;
    document.getElementById("employee-status").textContent = `${employee.designation}`;
    document.getElementById("detail-date-hired").textContent = `${employee.date_hired}`;
    document.getElementById("detail-pay-frequency").textContent = `${employee.pay_frequency}`;
    
    employeeDetails.classList.add("show");

    const editEmployeeBtn = document.getElementById('edit-employee-btn');
    const editModalContainer = document.getElementById("edit-modal-container");

    editEmployeeBtn.addEventListener("click", function(event){
        event.preventDefault();

        document.getElementById("editFirstName").value = employee.first_name;
        document.getElementById("editMiddleName").value = employee.middle_name;
        document.getElementById("editLastName").value = employee.last_name;
        document.getElementById("editGender").value = employee.gender;
        document.getElementById("editBirthday").value = employee.birthday;
        document.getElementById("editEmploymentType").value = employee.employment_type;
        document.getElementById("editDesignation").value = employee.designation;
        document.getElementById("editDateHired").value = employee.date_hired;
        document.getElementById("editPayFrequency").value = employee.pay_frequency;

        editModalContainer.classList.add('show');
        employeeDetails.classList.remove("show");
        overlay.classList.add("show");
    });

    const editClose = document.getElementById("edit-close");
    editClose.addEventListener('click', function(event){
        event.preventDefault();
        editModalContainer.classList.remove('show');
        employeeDetails.classList.add("show");
        overlay.classList.remove("show");
    });

    const editDiscard = document.getElementById("editDiscard");
    editDiscard.addEventListener("click", function(event){
        event.preventDefault();
        editModalContainer.classList.remove('show');
        employeeDetails.classList.add("show");
        overlay.classList.remove("show");
        confirmSaveContainer.classList.remove("show");
    });

    const deleteEmployeeBtn = document.getElementById("delete-employee-btn");
    const confirmDeleteContainer = document.getElementById("confirm-delete-container");

    deleteEmployeeBtn.addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("delete-employeeId").value = employee.employee_id;
        confirmDeleteContainer.classList.add("show");
    });

    confirmDeleteContainer.addEventListener("submit", function(){
        deleteEmployee();
    });

    const cancelButtonDelete = document.getElementById("cancel-button-delete");

    cancelButtonDelete.addEventListener("click", function(event){
        event.preventDefault();
        confirmDeleteContainer.classList.remove("show");
    });
    
    const edit = document.getElementById("edit");
    const confirmSaveContainer = document.getElementById("confirm-save-container");

    edit.addEventListener("click", function(event){
        event.preventDefault();

        document.getElementById("saveEmployeeId").value = employee.employee_id;
        document.getElementById("saveFirstName").value = document.getElementById("editFirstName").value;
        document.getElementById("saveMiddleName").value = document.getElementById("editMiddleName").value;
        document.getElementById("saveLastName").value = document.getElementById("editLastName").value;
        document.getElementById("saveGender").value = document.getElementById("editGender").value;
        document.getElementById("saveBirthday").value = document.getElementById("editBirthday").value;
        document.getElementById("saveEmploymentType").value = document.getElementById("editEmploymentType").value;
        document.getElementById("saveDesignation").value = document.getElementById("editDesignation").value;
        document.getElementById("saveDateHired").value = document.getElementById("editDateHired").value;
        document.getElementById("savePayFrequency").value = document.getElementById("editPayFrequency").value;
        
        confirmSaveContainer.classList.add("show");
    });

    confirmSaveContainer.addEventListener("submit", function(){
        editEmployee(employee);
    });

    const cancelButtonSave = document.getElementById("cancel-button-save");
    cancelButtonSave.addEventListener("click", function(event){
        event.preventDefault();
        confirmSaveContainer.classList.remove("show");
    });
}

function searchEmployee() {
    const searchInput = document.getElementById("search").value.toLowerCase();
    const content = document.getElementById("content");
    
    if (!searchInput) {
        fetchEmployees();
        return;
    }
    
    const filteredEmployees = allEmployees.filter(employee => {
        const fullName = `${employee.first_name} ${employee.middle_name || ''} ${employee.last_name}`.toLowerCase();
        return (
            fullName.includes(searchInput) ||
            (employee.designation && employee.designation.toLowerCase().includes(searchInput)) ||
            (employee.employment_type && employee.employment_type.toLowerCase().includes(searchInput)) ||
            (employee.gender && employee.gender.toLowerCase().includes(searchInput)) ||
            (employee.birthday && employee.birthday.includes(searchInput)) ||
            (employee.date_hired && employee.date_hired.includes(searchInput)) ||
            (employee.pay_frequency && employee.pay_frequency.toLowerCase().includes(searchInput))
        );
    });
    
    content.innerHTML = "";
    filteredEmployees.forEach(employee => {
        content.innerHTML += `
            <tr class="tr-body-style" data-employee-id="${employee.employee_id}">
                <td class="td-style">${employee.first_name} ${employee.middle_name || ''} ${employee.last_name}</td>
                <td class="td-style">${employee.designation}</td>
                <td class="td-style">${employee.employment_type}</td>
            </tr>
        `;
    });

    document.querySelectorAll(".tr-body-style").forEach(row => {
        row.addEventListener("click", function() {
            const employeeId = this.getAttribute("data-employee-id");
            const employeeData = allEmployees.find(e => e.employee_id == employeeId);
            if(employeeData) {
                showModal(employeeData);
            }
        });
    });
}

function addEmployee() {
    
    const formData = {
        firstName: document.getElementById("firstName").value.trim(),
        middleName: document.getElementById("middleName").value.trim(),
        lastName: document.getElementById("lastName").value.trim(),
        gender: document.getElementById("gender").value.trim(),
        birthday: document.getElementById("birthday").value.trim(),
        employmentType: document.getElementById("employmentType").value.trim(),
        designation: document.getElementById("designation").value.trim(),
        dateHired: document.getElementById("dateHired").value.trim(),
        payFrequency: document.getElementById("payFrequency").value.trim()
    };

    console.log("Sending data:", formData);

    fetch("api/employee_api.php", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        
    })
    .catch(error => console.error(error));
}

function editEmployee(employee){
;
    const formData = {
        saveEmployeeId: employee.employee_id,
        saveFirstName: document.getElementById("saveFirstName").value.trim(),
        saveMiddleName: document.getElementById("saveMiddleName").value.trim(),
        saveLastName: document.getElementById("saveLastName").value.trim(),
        saveGender: document.getElementById("saveGender").value.trim(),
        saveBirthday: document.getElementById("saveBirthday").value.trim(),
        saveEmploymentType: document.getElementById("saveEmploymentType").value.trim(),
        saveDesignation: document.getElementById("saveDesignation").value.trim(),
        saveDateHired: document.getElementById("saveDateHired").value.trim(),
        savePayFrequency: document.getElementById("savePayFrequency").value.trim()
    };

    fetch("api/employee_api.php", {
        method: "PUT",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(formData)
        
    })
    .then(response => response.json())
    .then(data =>{
        fetchEmployees();
    })
    .catch(error => console.error(error));
}

function deleteEmployee(){

    const formData = {
        deleteEmployeeId: document.getElementById("delete-employeeId").value
    }

    fetch("api/employee_api.php", {
        method: "DELETE",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {

    })
    .catch(error => console.error(error));
}