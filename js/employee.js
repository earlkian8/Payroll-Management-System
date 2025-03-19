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

function fetchEmployees(){
    fetch("../fetch/fetch_employees.php")
    .then(response => response.json())
    .then(data => {
        const content = document.getElementById("content");
        
       
        content.innerHTML = "";

        data.forEach((employee) => {
            let li = document.createElement("li");

            let nameDiv = document.createElement("div");
            nameDiv.className = "full-name-style";
            let nameSpan = document.createElement("span");
            nameSpan.className = "name";
            nameSpan.textContent = `${employee.first_name} ${employee.middle_name ? employee.middle_name + " " : ""} ${employee.last_name}`;

            nameDiv.appendChild(nameSpan);

            let designationDiv = document.createElement("div");
            designationDiv.className = "designation-style";

            let designationSpan = document.createElement("span");
            designationSpan.className = "designation";
            designationSpan.textContent = employee.designation;

            designationDiv.append(designationSpan);

            let employmentTypeDiv = document.createElement("div");
            employmentTypeDiv.className = "employment-type-style";

            let employmentTypeSpan = document.createElement("span");
            employmentTypeSpan.className = "employment-type";
            employmentTypeSpan.textContent = `${employee.employment_type}`;
            
            employmentTypeDiv.append(employmentTypeSpan)

            li.appendChild(nameDiv);
            li.appendChild(designationDiv);
            li.appendChild(employmentTypeDiv);

            li.addEventListener("click", function(){
                showModal(employee);
            });

            

            content.prepend(li);
        });
    })
    .catch(error => console.error("Error fetching employees", error));
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
}
function openTab(index) {
    let tabs = document.querySelectorAll(".tab");
    let contents = document.querySelectorAll(".tab-content");

    tabs.forEach(tab => tab.classList.remove("active"));
    contents.forEach(content => content.classList.remove("active"));

    tabs[index].classList.add("active");
    contents[index].classList.add("active");
}