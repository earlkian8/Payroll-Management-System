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
    getReceiptById(employee);
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
async function openReceipt(employeeData) {
    document.getElementById("modal-overlay-receipt").classList.add("show");
    
    document.getElementById("close-button-receipt").addEventListener("click", function(event) {
        event.preventDefault();
        document.getElementById("modal-overlay-receipt").classList.remove("show");
    });

    document.getElementById("payDateReceipt").innerHTML = `<strong>Pay Date:</strong> ${employeeData.pay_date_only}`;
    document.getElementById("payrollIdReceipt").innerHTML = `<strong>Payroll ID:</strong> ${employeeData.payroll_id}`;
    document.getElementById("statusReceipt").innerHTML = `<strong>Status:</strong> ${employeeData.status}`;
    document.getElementById("nameReceipt").innerHTML = `<strong>Name:</strong> ${employeeData.first_name} ${employeeData.middle_name ? employeeData.middle_name + " " : ""} ${employeeData.last_name}`;
    document.getElementById("designationReceipt").innerHTML = `<strong>Designation:</strong> ${employeeData.designation}`;
    document.getElementById("payFrequencyReceipt").innerHTML = `<strong>Pay Frequency:</strong> ${employeeData.pay_frequency}`;

    document.getElementById("earnings-box-receipt").innerHTML = '';
    document.getElementById("deductions-box-receipt").innerHTML = '';

    const [earningsResponse, deductionsResponse] = await Promise.all([
        fetch(`api/employee_pay_heads_earnings_api.php?employeeId=${employeeData.employee_id}`),
        fetch(`api/employee_pay_heads_deductions_api.php?employeeId=${employeeData.employee_id}`)
    ]);

    const earningsData = await earningsResponse.json();
    const deductionsData = await deductionsResponse.json();

    if (earningsData.status === "success") {
        document.getElementById("earnings-box-receipt").innerHTML += `<h4 class="section-title-receipt">EARNINGS</h4>`;
        earningsData.employeePayHeadsById.forEach(employeePayHead => {
            document.getElementById("earnings-box-receipt").innerHTML += `
                <div class="salary-item-receipt">
                    <span class="item-name-receipt">${employeePayHead.name}</span>
                    <span class="item-value-receipt">${employeePayHead.amount}</span>
                </div>
            `;
        });
    }

    if (deductionsData.status === "success") {
        document.getElementById("deductions-box-receipt").innerHTML += `<h4 class="section-title-receipt">DEDUCTIONS</h4>`;
        deductionsData.employeePayHeadsById.forEach(employeePayHead => {
            document.getElementById("deductions-box-receipt").innerHTML += `
                <div class="salary-item-receipt">
                    <span class="item-name-receipt">${employeePayHead.name}</span>
                    <span class="item-value-receipt">${employeePayHead.amount}</span>
                </div>
            `;
        });
    }

    document.getElementById("totalEarningsRowReceipt").innerHTML = `
        <span>Total Earnings</span>
        <span>₱${employeeData.total_earnings}</span>
    `;
    document.getElementById("totalDeductionsRowReceipt").innerHTML = `
        <span>Total Deduction</span>
        <span>₱${employeeData.total_deductions}</span>
    `;
    document.getElementById("netPayRowReceipt").innerHTML = `
        <span>Salary</span>
        <span>₱${employeeData.net_pay}</span>
    `;
    document.getElementById("notesReceipt").innerHTML = `<strong>Notes:</strong> ${employeeData.notes}`;
}

function downloadReceiptAsPDF() {
    const receiptContent = document.getElementById('modal-overlay-receipt');
    
    if (!receiptContent.classList.contains('show')) {
        console.error('Receipt not open');
        return;
    }

    const printContent = receiptContent.cloneNode(true);
    
    printContent.style.position = 'static';
    printContent.style.width = '190mm';
    printContent.style.minHeight = '277mm';
    printContent.style.backgroundColor = 'white';
    printContent.style.opacity = '1';
    printContent.style.visibility = 'visible';
    printContent.style.display = 'block';
    printContent.style.overflow = 'visible';
    printContent.style.padding = '0';
    printContent.style.margin = '0';


    const modalContent = printContent.querySelector('.modal-content-receipt');
    modalContent.style.maxWidth = 'none';
    modalContent.style.width = '100%';
    modalContent.style.maxHeight = 'none';
    modalContent.style.padding = '15mm';
    modalContent.style.boxSizing = 'border-box';


    const modalHeader = printContent.querySelector('.modal-header-receipt');
    modalHeader.style.padding = '8mm 10mm';
    modalHeader.querySelector('h2').style.fontSize = '16pt';

    const companyHeader = printContent.querySelector('.company-header-receipt');
    companyHeader.style.marginBottom = '8mm';
    companyHeader.style.paddingBottom = '5mm';

    const companyLogo = printContent.querySelector('.company-logo-receipt');
    companyLogo.querySelector('img').style.width = '40px';
    companyLogo.querySelector('img').style.height = '40px';
    companyLogo.querySelector('h3').style.fontSize = '14pt';

    const payslipDetails = printContent.querySelector('.payslip-details-receipt');
    payslipDetails.style.fontSize = '10pt';

    const employeeInfo = printContent.querySelector('.employee-info-receipt');
    employeeInfo.style.display = 'flex';
    employeeInfo.style.justifyContent = 'space-between';
    employeeInfo.style.marginBottom = '8mm';
    employeeInfo.querySelectorAll('div').forEach(div => {
        div.style.width = '48%';
    });
    employeeInfo.querySelector('h4').style.fontSize = '12pt';
    employeeInfo.querySelectorAll('p').forEach(p => {
        p.style.fontSize = '10pt';
    });

    const salaryDetails = printContent.querySelector('.salary-details-receipt');
    salaryDetails.style.display = 'flex';
    salaryDetails.style.justifyContent = 'space-between';
    salaryDetails.style.marginBottom = '8mm';
    salaryDetails.querySelectorAll('.salary-box-receipt').forEach(box => {
        box.style.width = '48%';
    });
    salaryDetails.querySelectorAll('.section-title-receipt').forEach(title => {
        title.style.fontSize = '12pt';
        title.style.padding = '5mm 8mm';
        title.style.marginBottom = '5mm';
    });
    salaryDetails.querySelectorAll('.salary-item-receipt').forEach(item => {
        item.style.fontSize = '10pt';
        item.style.padding = '5mm 0';
    });

    const summary = printContent.querySelector('.summary-receipt');
    summary.style.padding = '8mm';
    summary.style.marginTop = '8mm';
    summary.style.fontSize = '10pt';
    summary.querySelector('.total').style.fontSize = '12pt';
    summary.querySelector('.total').style.paddingTop = '5mm';
    summary.querySelector('.total').style.marginTop = '5mm';

    const notes = printContent.querySelector('.notes-receipt');
    notes.style.fontSize = '10pt';
    notes.style.padding = '6mm';
    notes.style.marginTop = '8mm';

    const footer = printContent.querySelector('.footer-receipt');
    footer.style.fontSize = '9pt';
    footer.style.marginTop = '10mm';

    document.body.appendChild(printContent);

    const opt = {
        margin: 10,
        filename: 'salary_slip.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2, useCORS: true },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
        pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
    };

    html2pdf().from(printContent).set(opt).save().then(() => {
        document.body.removeChild(printContent);
    });
}

function getReceiptById(employee) {
    fetch(`api/employee_receipt_id_api.php?employeeId=${employee.employee_id}`)
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            document.getElementById("payslips-container").innerHTML = '';
            data.getIssuedEmployeeById.forEach(employee => {
                document.getElementById("payslips-container").innerHTML += `
                    <div class="payslip-card" data-receipt-id=${employee.employee_id}>
                        <div class="payslip-header">
                            <span class="payslip-date">Issued: ${employee.pay_date_only}</span>
                            <span class="payslip-frequency">${employee.pay_frequency}</span>
                        </div>
                        <div class="payslip-amount">₱${employee.net_pay}</div>
                        <div class="payslip-footer">
                            <span class="payslip-status">Ready for download</span>
                            <button class="payslip-download-btn" data-receipt-id="${employee.employee_id}">
                                <i class="download-icon"></i>
                            </button>
                        </div>
                    </div>
                `;
            });

            document.querySelectorAll(".payslip-card").forEach(card => {
                const employeeId = card.getAttribute("data-receipt-id");
                const employeeData = data.getIssuedEmployeeById.find(e => e.employee_id == employeeId);
                
                card.addEventListener("click", function(event) {
                    if (!event.target.closest('.payslip-download-btn')) {
                        if (employeeData) {
                            openReceipt(employeeData);
                        }
                    }
                });
                
                const downloadBtn = card.querySelector('.payslip-download-btn');
                downloadBtn.addEventListener("click", async function(event) {
                    document.getElementById("modal-overlay-receipt").classList.remove("show");
                    event.stopPropagation();
                    event.preventDefault();
                    console.log('Download button clicked for employee:', employeeData.employee_id);
                    if (employeeData) {
                        console.log('Opening receipt...');
                        await openReceipt(employeeData);
                        console.log('Receipt opened, triggering PDF download...');
                        downloadReceiptAsPDF();
                    }
                });
            });
        }
    })
    .catch(error => console.error(error));
}