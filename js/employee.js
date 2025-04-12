document.addEventListener("DOMContentLoaded", function(){

    const open = document.getElementById("open");
    const discard = document.getElementById("discard");
    const create = document.getElementById("create");
    const modalContainer = document.getElementById("modal-container");
    const overlay = document.getElementById("overlay");
    open.addEventListener("click", function(){
        modalContainer.classList.add("show");
        overlay.classList.add("show");
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
});

function fetchEmployees() {
    fetch("api/employee_api.php")
        .then(response => response.json())
        .then(data => {
            if(data.status === "success"){
                const content = document.getElementById("content");

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
    const employeeDetails = document.getElementById("employee-details");
    const back = document.getElementById("back");
    const overlay = document.getElementById("overlay");

    const nameInformation = document.getElementById("name-information");
    const genderValue = document.getElementById("gender-value");
    const birthdayValue = document.getElementById("birthday-value");
    const employmentTypeValue = document.getElementById("employmentType-value");
    const designationValue = document.getElementById("designation-value");
    const dateHiredValue = document.getElementById("dateHired-value");
    const payFrequencyValue = document.getElementById("payFrequency-value");

    if (nameInformation && genderValue && birthdayValue && employmentTypeValue && designationValue && dateHiredValue && payFrequencyValue) {
        nameInformation.textContent = `${employee.first_name} ${employee.middle_name ? employee.middle_name + " " : ""} ${employee.last_name}`;
        genderValue.textContent = `${employee.gender}`;
        birthdayValue.textContent = `${employee.birthday}`;
        employmentTypeValue.textContent = `${employee.employment_type}`;
        designationValue.textContent = `${employee.designation}`;
        dateHiredValue.textContent = `${employee.date_hired}`;
        payFrequencyValue.textContent = `${employee.pay_frequency}`;
        employeeDetails.classList.add("show");
        overlay.classList.add("show");
    } else {
        console.error("One or more elements not found in the DOM");
    }
    back.addEventListener("click", function(event){
        event.preventDefault();
        employeeDetails.classList.remove("show");
        overlay.classList.remove("show");
    });

    const deleteButtonId = document.getElementById("delete-button-id");
    const confirmDeleteContainer = document.getElementById("confirm-delete-container");

    deleteButtonId.addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("delete-employeeId").value = employee.employee_id;
        confirmDeleteContainer.classList.add("show");
        
    });

    const cancelButtonDelete = document.getElementById("cancel-button-delete");
    cancelButtonDelete.addEventListener("click", function(event){
        event.preventDefault();
        confirmDeleteContainer.classList.remove("show");
    });

    
    const e = document.getElementById("e");
    const editModalContainer = document.getElementById("edit-modal-container");
    const editDiscard = document.getElementById("editDiscard");

    e.addEventListener("click", function(event){
        event.preventDefault();

        document.getElementById("editEmployeeId").value = employee.employee_id;
        document.getElementById("editFirstName").value = employee.first_name;
        document.getElementById("editMiddleName").value = employee.middle_name;
        document.getElementById("editLastName").value = employee.last_name;
        document.getElementById("editGender").value = employee.gender;
        document.getElementById("editBirthday").value = employee.birthday;
        document.getElementById("editEmploymentType").value = employee.employment_type;
        document.getElementById("editDesignation").value = employee.designation;
        document.getElementById("editDateHired").value = employee.date_hired;
        document.getElementById("editPayFrequency").value = employee.pay_frequency;
        editModalContainer.classList.add("show");

    });

    editDiscard.addEventListener("click", function(event){
        event.preventDefault();
        editModalContainer.classList.remove("show");
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

    const cancelButtonSave = document.getElementById("cancel-button-save");

    cancelButtonSave.addEventListener("click", function(event){
        event.preventDefault();
        confirmSaveContainer.classList.remove("show");
    });
}
function openTab(index) {
    let tabs = document.querySelectorAll(".tab");
    let contents = document.querySelectorAll(".tab-content");

    tabs.forEach(tab => tab.classList.remove("active"));
    contents.forEach(content => content.classList.remove("active"));

    tabs[index].classList.add("active");
    contents[index].classList.add("active");
}