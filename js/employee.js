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
    document.getElementById("logoutButton").addEventListener("click", () => {
        window.location.href = "api/logout.php";
    });
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

let allEmployees = [];
function getEmployees(id){
    fetch("api/employee_api.php?userId=" + id)
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("tableContent").innerHTML = "";
            allEmployees = data.employees;
            data.employees.forEach(employee => {
                document.getElementById("tableContent").innerHTML += `
                    <tr>
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
                        document.getElementById("employeeDetailModal").classList.add("show");

                        document.getElementById("employeeCloseButton").addEventListener("click", function(event){
                            event.preventDefault();
                            document.getElementById("employeeDetailModal").classList.remove("show");
                        });

                        document.getElementById("employeeNameDetails").textContent = `${empData.first_name} ${empData.middle_name ? empData.middle_name + " " : ""} ${empData.last_name}`;
                        document.getElementById("employeeDesignationDetails").textContent = `${empData.designation}`;
                        document.getElementById("employeeIdDetails").textContent = `${empData.employee_id}`;
                        document.getElementById("employmentTypeDetails").textContent = `${empData.employment_type}`;
                        document.getElementById("designationDetails").textContent = `${empData.designation}`;
                        document.getElementById("dateHiredDetails").textContent = `${empData.hire_date}`;
                        document.getElementById("payFrequencyDetails").textContent = `${empData.pay_frequency}`;
                        getSalary(id, empData.employee_id);
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

function getSalary(userId, employeeId){
    fetch(`api/salary_api.php?userId=${userId}&employeeId=${employeeId}`)
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("employeePayslipCards").innerHTML = "";
            data.payrollDetails.forEach(p => {
                document.getElementById("employeePayslipCards").innerHTML += `
                    <div class="employee-payslip-card" data-id="${p.payroll_details_id}">
                        <div class="employee-month">
                            <span>${new Date(p.pay_date).toLocaleString('en-US', { month: 'long', year: 'numeric' })}</span>
                            <span class="employee-paid-badge">Paid</span>
                        </div>
                        <div class="employee-net-amount">₱${Math.abs(p.net_pay).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</div>
                        <div class="employee-net-label">Net Salary</div>
                    </div>
                `;
            });

            document.querySelectorAll(".employee-payslip-card").forEach(button => {
                button.addEventListener("click", function(event){
                    event.preventDefault();
                    const pdId = this.getAttribute("data-id");
                    const pData = data.payrollDetails.find(p => p.payroll_details_id == pdId);
                    if(pData){
                        document.getElementById("viewModal").classList.add("show");
                        document.getElementById("aviewCloseButton").addEventListener("click", function(event){
                            event.preventDefault();
                            document.getElementById("viewModal").classList.remove("show");
                        });

                        document.getElementById("payDateSalary").innerHTML = `<strong>Pay Date:</strong> ${new Date(pData.pay_date).toLocaleString('en-US', { month: 'long', year: 'numeric' })}`;
                        document.getElementById("payrollIdSalary").innerHTML = `<strong>Payroll ID:</strong> ${pData.payroll_details_id}`;
                        document.getElementById("statusSalary").innerHTML = `<strong>Status:</strong> ${pData.status}`;
                        document.getElementById("nameSalary").innerHTML = `<strong>Name:</strong> ${pData.first_name} ${pData.middle_name ? pData.middle_name + " " : ""} ${pData.last_name}`;
                        getEarningsDeductions(pData.user_id, pData.employee_id, pData.payroll_details_id);

                        document.getElementById("totalEarningsDetails").textContent = `₱${Math.abs(pData.total_earnings).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                        document.getElementById("totalDeductionDetails").textContent = `₱${Math.abs(pData.total_deductions).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                        document.getElementById("totalNetDetails").textContent = `₱${Math.abs(pData.net_pay).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                        document.getElementById("notesDetails").innerHTML = `<strong>Notes:</strong> ${pData.notes}`;
                        
                        document.getElementById("downloadPDFId").addEventListener("click", function(event){
                            event.preventDefault();
                            downloadPDF(pData.payroll_details_id);
                        });
                    }
                });
            });
        }
    })
    .catch(error => console.error(error));
}

function getEarningsDeductions(userId, employeeId, payrollDetailsId){
    fetch(`api/earnings_deductions_api.php?userId=${userId}&employeeId=${employeeId}&payrollDetailsId=${payrollDetailsId}`)
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("earningRow").innerHTML = "<h3>EARNINGS</h3>";
            document.getElementById("deductionRow").innerHTML = "<h3>DEDUCTIONS</h3>";
            data.earnings.forEach(e => {
                document.getElementById("earningRow").innerHTML += `
                    <div class="view-amount-row">
                        <span>₱${e.name}</span>
                        <span>₱${Math.abs(e.amount).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</span>
                    </div>
                `;
            });

            data.deductions.forEach(d => {
                document.getElementById("deductionRow").innerHTML += `
                    <div class="view-amount-row">
                        <span>₱${d.name}</span>
                        <span>₱${Math.abs(d.amount).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</span>
                    </div>
                `;
            });
        }
    })
    .catch(error => console.error(error));
}

function searchEmployee() {
    const searchInput = document.getElementById("searchInput").value.toLowerCase();
    const tableContent = document.getElementById("tableContent");
    
    if (!searchInput) {
        // If search is empty, reload all employees
        getEmployees(new URL(window.location.href).searchParams.get("userId"));
        return;
    }
    
    // Filter employees based on search input
    const filteredEmployees = allEmployees.filter(employee => {
        const fullName = `${employee.first_name} ${employee.middle_name || ''} ${employee.last_name}`.toLowerCase();
        return fullName.includes(searchInput) || 
               employee.employee_id.toString().toLowerCase().includes(searchInput) ||
               employee.employment_type.toLowerCase().includes(searchInput) ||
               employee.designation.toLowerCase().includes(searchInput) ||
               employee.hire_date.toLowerCase().includes(searchInput) ||
               employee.pay_frequency.toLowerCase().includes(searchInput);
    });
    
    // Display filtered employees
    tableContent.innerHTML = "";
    filteredEmployees.forEach(employee => {
        tableContent.innerHTML += `
            <tr>
                <td>${employee.employee_id}</td>
                <td>${employee.first_name}</td>
                <td>${employee.middle_name || ''}</td>
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
    
    // Reattach event listeners to the buttons
    document.querySelectorAll(".btn-view").forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            const empId = this.getAttribute("data-id");
            const empData = allEmployees.find(e => e.employee_id == empId);
            if (empData) {
                document.getElementById("employeeDetailModal").classList.add("show");

                document.getElementById("employeeCloseButton").addEventListener("click", function(event) {
                    event.preventDefault();
                    document.getElementById("employeeDetailModal").classList.remove("show");
                });

                document.getElementById("employeeNameDetails").textContent = `${empData.first_name} ${empData.middle_name ? empData.middle_name + " " : ""} ${empData.last_name}`;
                document.getElementById("employeeDesignationDetails").textContent = `${empData.designation}`;
                document.getElementById("employeeIdDetails").textContent = `${empData.employee_id}`;
                document.getElementById("employmentTypeDetails").textContent = `${empData.employment_type}`;
                document.getElementById("designationDetails").textContent = `${empData.designation}`;
                document.getElementById("dateHiredDetails").textContent = `${empData.hire_date}`;
                document.getElementById("payFrequencyDetails").textContent = `${empData.pay_frequency}`;
                const userId = new URL(window.location.href).searchParams.get("userId");
                getSalary(userId, empData.employee_id);
            }
        });
    });

    document.querySelectorAll(".btn-edit").forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            const empId = this.getAttribute("data-id");
            const empData = allEmployees.find(e => e.employee_id == empId);
            if (empData) {
                document.getElementById("editEmployeeModal").classList.add("show");

                document.getElementById("editFirstName").value = empData.first_name;
                document.getElementById("editMiddleName").value = empData.middle_name || '';
                document.getElementById("editLastName").value = empData.last_name;
                document.getElementById("editEmploymentType").value = empData.employment_type;
                document.getElementById("editDesignation").value = empData.designation;
                document.getElementById("editHireDate").value = empData.hire_date;
                document.getElementById("editPayFrequency").value = empData.pay_frequency;

                document.getElementById("editEmployeeForm").addEventListener("submit", function(event) {
                    event.preventDefault();
                    updateEmployee(empId);
                });
            }
        });
    });

    document.querySelectorAll(".btn-delete").forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            const empId = this.getAttribute("data-id");
            const empData = allEmployees.find(e => e.employee_id == empId);
            if (empData) {
                document.getElementById("deleteEmployeeModal").classList.add("show");
                document.getElementById("deleteEmployeeForm").addEventListener("submit", function(event) {
                    event.preventDefault();
                    deleteEmployee(empData.employee_id);
                });
            }
        });
    });
}

async function downloadPDF(payrollDetailsId) {
    if (typeof html2pdf === 'undefined') {
        console.error('html2pdf library not loaded');
        alert('PDF generation library is missing. Please contact support.');
        return;
    }

    const modalContent = document.getElementById('viewModal');

    if (!modalContent.classList.contains('show')) {
        console.error('Modal not open');
        alert('Please open the payslip details before downloading.');
        return;
    }

    // Ensure earnings and deductions are loaded
    const userId = new URL(window.location.href).searchParams.get('userId');
    const employeeId = document.querySelector('#employeeIdDetails').textContent; // Adjust selector if needed
    await getEarningsDeductions(userId, employeeId, payrollDetailsId);

    // Clone the modal content
    const printContent = modalContent.cloneNode(true);

    // Style the cloned content for PDF generation
    printContent.style.position = 'static';
    printContent.style.width = '190mm';
    printContent.style.minHeight = '300mm'; // Adjust height as needed
    printContent.style.backgroundColor = 'white';
    printContent.style.opacity = '1';
    printContent.style.visibility = 'visible';
    printContent.style.display = 'block';
    printContent.style.overflow = 'visible';
    printContent.style.padding = '0';
    printContent.style.margin = '0';

    // Style the modal content
    const innerContent = printContent.querySelector('.view-modal');
    if (innerContent) {
        innerContent.style.maxWidth = 'none';
        innerContent.style.width = '100%';
        innerContent.style.maxHeight = 'none';
        innerContent.style.padding = '15mm';
        innerContent.style.boxSizing = 'border-box';
    }

    // Style the header
    const header = printContent.querySelector('.view-modal-header');
    if (header) {
        header.style.display = 'none';
    }

    // Style the company logo if present
    const companyLogo = printContent.querySelector('.view-company-logo');
    if (companyLogo) {
        companyLogo.style.padding = '5mm';
    }

    // Style salary details
    const salaryDetails = printContent.querySelectorAll('#payDateSalary, #payrollIdSalary, #statusSalary, #nameSalary');
    salaryDetails.forEach(el => {
        el.style.fontSize = '10pt';
        el.style.padding = '3mm 0';
    });

    // Style earnings and deductions sections
    const earningsDeductions = printContent.querySelectorAll('#earningRow, #deductionRow');
    earningsDeductions.forEach(section => {
        section.style.display = 'flex';
        section.style.justifyContent = 'space-between';
        section.style.flexDirection = 'column';
        section.querySelectorAll('h3').forEach(title => {
            title.style.fontSize = '12pt';
            title.style.marginBottom = '5mm';
        });
        section.querySelectorAll('.view-amount-row').forEach(row => {
            row.style.fontSize = '10pt';
            row.style.padding = '3mm 0';
        });
    });

    // Style totals section
    const totals = printContent.querySelector('.view-total-section');
    if (totals) {
        totals.style.fontSize = '10pt';
        totals.style.padding = '5mm';
        totals.querySelectorAll('.view-total-row').forEach(row => {
            row.style.padding = '3mm 0';
        });
    }

    // Style notes section
    const notes = printContent.querySelector('#notesDetails');
    if (notes) {
        notes.style.fontSize = '10pt';
        notes.style.padding = '6mm';
        notes.style.marginTop = '8mm';
    }

    // Append the cloned content to the body
    document.body.appendChild(printContent);

    // Generate PDF
    const opt = {
        margin: 10,
        filename: `salary_slip_${payrollDetailsId}.pdf`,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2, useCORS: true },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
        pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
    };

    html2pdf().from(printContent).set(opt).save().then(() => {
        document.body.removeChild(printContent);
        console.log('PDF generated successfully');
    }).catch(error => {
        document.body.removeChild(printContent);
        console.error('Error generating PDF:', error);
        alert('Failed to generate PDF: ' + error.message);
    });
}
