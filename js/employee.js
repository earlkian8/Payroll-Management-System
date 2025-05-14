document.addEventListener("DOMContentLoaded", function(){

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
    
    document.getElementById("addEmployeeBtn").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("addEmployeeModal").classList.add("show");
    });

    document.getElementById("addClose").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("addEmployeeModal").classList.remove("show");
    });

    document.getElementById("addEmployeeForm").addEventListener("submit", function(event){
        event.preventDefault();
        addEmployee();
    });

    document.getElementById("editClose").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("editEmployeeModal").classList.remove("show");
    });

    getEmployees(userId);
});

function addEmployee(){
    fetch("api/store_session.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            const formData = {
                userId: data.userId,
                firstName: document.getElementById("firstName").value,
                middleName: document.getElementById("middleName").value,
                lastName: document.getElementById("lastName").value,
                employmentType: document.getElementById("employmentType").value,
                designation: document.getElementById("designation").value,
                hireDate: document.getElementById("hireDate").value,
                payFrequency: document.getElementById("payFrequency").value
            }
            return fetch("api/employee_api.php", {
                method: "POST",
                body: JSON.stringify(formData),
                headers: {"Content-Type": "application/json"}
            })
        }
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

function getEmployees(id){
    fetch("api/employee_api.php?userId=" + id)
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("tableContent").innerHTML = "";

            data.employees.forEach(employee => {
                document.getElementById("tableContent").innerHTML += `
                    <tr>
                        <td>${employee.employee_id}</td>
                        <td>${employee.first_name}</td>
                        <td>${employee.middle_name}</td>
                        <td>${employee.last_name}</td>
                        <td>${employee.employment_type}</td>
                        <td>${employee.designation}</td>
                        <td>${employee.hire_date}</td>
                        <td>${employee.pay_frequency}</td>
                        <td>
                            <button class="btn-view" data-id="${employee.employee_id}"><i class="fas fa-eye"></i></button>
                            <button class="btn-edit" data-id="${employee.employee_id}"><i class="fas fa-edit"></i></button>
                            <button class="btn-delete" data-id="${employee.employee_id}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                `;
            });

            document.querySelectorAll(".btn-view").forEach(button => {
                button.addEventListener("click", function(event){
                    event.preventDefault();
                    const empId = this.getAttribute("data-id");
                    const empData = data.employees.find(e => e.employee_id == empId);
                    if(empData){
                        document.getElementById("viewEmployeeModal").classList.add("show");
                    }
                });
            });
            document.querySelectorAll(".btn-edit").forEach(button => {
                button.addEventListener("click", function(event){
                    event.preventDefault();
                    const empId = this.getAttribute("data-id");
                    const empData = data.employees.find(e => e.employee_id == empId);
                    if(empData){
                        document.getElementById("editEmployeeModal").classList.add("show");

                        document.getElementById("editFirstName").value = empData.first_name;
                        document.getElementById("editMiddleName").value = empData.middle_name;
                        document.getElementById("editLastName").value = empData.last_name;
                        document.getElementById("editEmploymentType").value = empData.employment_type;
                        document.getElementById("editDesignation").value = empData.designation;
                        document.getElementById("editHireDate").value = empData.hire_date;
                        document.getElementById("editPayFrequency").value = empData.pay_frequency;

                        document.getElementById("editEmployeeModal").addEventListener("submit", function(event){
                            event.preventDefault();
                            updateEmployee(empId);
                        });
                    }
                });
            });

            document.querySelectorAll(".btn-delete").forEach(button => {
                button.addEventListener("click", function(event){
                    event.preventDefault();
                    const empId = this.getAttribute("data-id");
                    const empData = data.employees.find(e => e.employee_id == empId);
                    if(empData){
                        document.getElementById("deleteEmployeeModal").classList.add("show");
                        console.log(empData);
                        document.getElementById("deleteEmployeeForm").addEventListener("submit", function(event){
                            event.preventDefault();
                            deleteEmployee(empData.employee_id);
                        });
                    }
                });
            });
        }
    })
    .catch(error => console.error(error));
}

function updateEmployee(id){
    fetch("api/store_session.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            const formData = {
                userId: data.userId,
                employeeId: id,
                firstName: document.getElementById("editFirstName").value,
                middleName: document.getElementById("editMiddleName").value,
                lastName: document.getElementById("editLastName").value,
                employmentType: document.getElementById("editEmploymentType").value,
                designation: document.getElementById("editDesignation").value,
                hireDate: document.getElementById("editHireDate").value,
                payFrequency: document.getElementById("editPayFrequency").value
            }
            return fetch("api/employee_api.php", {
                method: "PUT",
                body: JSON.stringify(formData),
                headers: {"Content-Type": "application/json"}
            })
        }
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

function deleteEmployee(aestd){
    const formData = {
        employeeId: Number(aestd),
    }
    fetch("api/employee_api.php", {
        method: 'DELETE',
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            alert("Deleted Successfully!");
            window.location.reload();
        }
    })
    .catch(error => console.error(error));
}