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

    fetchEmployees();
});

function fetchEmployees() {
    fetch("fetch/fetch_employees.php")
        .then(response => response.json())
        .then(data => {
            console.log(data);
            const tableBody = document.getElementById("content");
            tableBody.innerHTML = ""; // Clear existing rows

            // Loop through the data and create table rows
            data.forEach(employee => {
                const row = document.createElement("tr");
                row.classList.add("tr-data-style", "data-row");
                row.setAttribute("data-employee-id", employee.employee_id);

                // Add table cells
                const fullNameCell = document.createElement("td");
                fullNameCell.classList.add("td-style");
                fullNameCell.textContent = employee.full_name;

                const designationCell = document.createElement("td");
                designationCell.classList.add("td-style");
                designationCell.textContent = employee.designation;

                const employmentTypeCell = document.createElement("td");
                employmentTypeCell.classList.add("td-style");
                employmentTypeCell.textContent = employee.employment_type;

                // Append cells to the row
                row.appendChild(fullNameCell);
                row.appendChild(designationCell);
                row.appendChild(employmentTypeCell);

                // Append the row to the table body
                tableBody.appendChild(row);

            });
            
            attachRowEventListeners(data);
        })
        .catch(error => console.error("Error fetching employees", error));
}

function attachRowEventListeners(data) {
    const rows = document.querySelectorAll(".data-row");
    rows.forEach(row => {
        row.addEventListener("click", function () {
            const employeeId = row.getAttribute("data-employee-id");

            // Find the employee data for the clicked row
            const employee = data.find(emp => emp.employee_id == employeeId);
            if (employee) {
                showModal(employee);
            }
        });
    });
}

function showModal(employee){
    const employeeDetails = document.getElementById("employee-details");
    const back = document.getElementById("back");

    const nameInformation = document.getElementById("name-information");
    const employeeIdInformation = document.getElementById("employeeId-information");
    const genderValue = document.getElementById("gender-value");
    const birthdayValue = document.getElementById("birthday-value");
    const employmentTypeValue = document.getElementById("employmentType-value");
    const designationValue = document.getElementById("designation-value");
    const salaryValue = document.getElementById("salary-value");
    const overtimePayValue = document.getElementById("overtimePay-value");
    const timeInValue = document.getElementById("timeIn-value");
    const timeOutValue = document.getElementById("timeOut-value");
    const dateHiredValue = document.getElementById("dateHired-value");

    nameInformation.textContent = `${employee.first_name} ${employee.middle_name ? employee.middle_name + " " : ""} ${employee.last_name}`;
    employeeIdInformation.textContent = `${employee.employee_id}`;
    genderValue.textContent = `${employee.gender}`;
    birthdayValue.textContent = `${employee.birthday}`;
    employmentTypeValue.textContent = `${employee.employment_type}`;
    designationValue.textContent = `${employee.designation}`;
    salaryValue.textContent = `₱${employee.salary}`;
    overtimePayValue.textContent = `₱${employee.overtime_pay}`;
    timeInValue.textContent = `${employee.time_in}`;
    timeOutValue.textContent = `${employee.time_out}`;
    dateHiredValue.textContent = `${employee.date_hired}`;
    employeeDetails.classList.add("show");

    back.addEventListener("click", function(event){
        event.preventDefault();
        employeeDetails.classList.remove("show");
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

        document.getElementById("editFirstName").value = employee.first_name;
        document.getElementById("editMiddleName").value = employee.middle_name;
        document.getElementById("editLastName").value = employee.last_name;
        document.getElementById("editGender").value = employee.gender;
        document.getElementById("editBirthday").value = employee.birthday;
        document.getElementById("editEmploymentType").value = employee.employment_type;
        document.getElementById("editDesignation").value = employee.designation;
        document.getElementById("editSalary").value = employee.salary;
        document.getElementById("editOvertimePay").value = employee.overtime_pay;
        document.getElementById("editTimeIn").value = employee.time_in;
        document.getElementById("editTimeOut").value = employee.time_out;
        document.getElementById("editDateHired").value = employee.date_hired;
        document.getElementById("editEmployeeId").value = employee.employee_id;
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

        document.getElementById("saveEmployeeId").value = document.getElementById("editEmployeeId").value;
        document.getElementById("saveFirstName").value = document.getElementById("editFirstName").value;
        document.getElementById("saveMiddleName").value = document.getElementById("editMiddleName").value;
        document.getElementById("saveLastName").value = document.getElementById("editLastName").value;
        document.getElementById("saveGender").value = document.getElementById("editGender").value;
        document.getElementById("saveBirthday").value = document.getElementById("editBirthday").value;
        document.getElementById("saveEmploymentType").value = document.getElementById("editEmploymentType").value;
        document.getElementById("saveDesignation").value = document.getElementById("editDesignation").value;
        document.getElementById("saveSalary").value = document.getElementById("editSalary").value;
        document.getElementById("saveOvertimePay").value = document.getElementById("editOvertimePay").value;
        document.getElementById("saveTimeIn").value = document.getElementById("editTimeIn").value;
        document.getElementById("saveTimeOut").value = document.getElementById("editTimeOut").value;
        document.getElementById("saveDateHired").value = document.getElementById("editDateHired").value;
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