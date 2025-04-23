document.addEventListener("DOMContentLoaded", function(){
    getPendingEmployees();
    getPayHead();
    getIssuedEmployee();
    
});

function getPendingEmployees(){
    fetch("api/pending_employee_api.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("pendingContent").innerHTML = "";
            data.pendingEmployees.forEach(employee =>{
                document.getElementById("pendingContent").innerHTML += `
                    <tr class="tr-body-style" data-id="${employee.employee_id}">
                        <td class="td-style">${employee.first_name} ${employee.middle_name ? employee.middle_name + " " : ""} ${employee.last_name}</td>
                        <td class="td-style">${employee.pay_frequency}</td>
                    </tr>
                `;
            });

            document.querySelectorAll(".tr-body-style").forEach(button =>{
                button.addEventListener("click", function(){
                    const employeeId = this.getAttribute("data-id");
                    const employeeData = data.pendingEmployees.find(e => e.employee_id == employeeId);
                    if(employeeData){
                        showPayrollModal(employeeData);
                    }
                });
            });
        }
    })
    .catch(error => console.error(error));
}

function showPayrollModal(employeeData){
    document.getElementById("modal-overlay").classList.add("show");
    document.getElementById("modalFullName").textContent = `${employeeData.first_name} ${employeeData.middle_name ? employeeData.middle_name + " " : ""} ${employeeData.last_name}`;
    const modal = document.getElementById("modal-overlay")
    modal.setAttribute("data-employee-id", employeeData.employee_id);
    document.getElementById("close-button").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("modal-overlay").classList.remove("show");
    });

    document.getElementById("cancel").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("modal-overlay").classList.remove("show");
    });

    document.getElementById("modal-overlay").addEventListener("submit", function() {
        addEmployeePayHead();
        addPayroll();
        updateEmployee();
    });
}

let totalEarnings = 0;
let totalDeductions = 0;

function getPayHead() {
    fetch("api/pay_head_api.php")
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            data.payHeads.forEach(payHead => {
                document.getElementById("pay-head-select").innerHTML += `
                    <option value="${payHead.pay_head_id}">${payHead.name} (${payHead.type})</option>
                `;
            });

            document.getElementById("addPayHead").addEventListener("click", function(event) {
                event.preventDefault();
                const selectedPayHeadId = document.getElementById("pay-head-select").value;
                const selectedPayHead = data.payHeads.find(ph => ph.pay_head_id == selectedPayHeadId);
            
                const payHeadItem = document.createElement("div");
                payHeadItem.className = "pay-head-item";
                payHeadItem.setAttribute("data-pay-head-id", selectedPayHeadId);
                payHeadItem.innerHTML = `
                    <div class="pay-head-info">
                        <div class="pay-head-title">${selectedPayHead.name}</div>
                        <div class="pay-head-type ${selectedPayHead.type.toLowerCase()}">${selectedPayHead.type}</div>
                    </div>
                    <input type="number" class="pay-head-amount" value="${document.getElementById("pay-head-amount").value}" min="0" step="0.01">
                    <button class="remove-pay-head" type="button">&times;</button>
                `;
            
                document.getElementById("pay-heads-container").appendChild(payHeadItem);

                if(selectedPayHead.type === "Earnings"){

                    totalEarnings += Number(document.getElementById("pay-head-amount").value);
                }else if(selectedPayHead.type === "Deductions"){
                    totalDeductions += Number(document.getElementById("pay-head-amount").value);
                }

                document.getElementById("pay-head-amount").value = null;
                document.getElementById("pay-head-select").value = '';
                const removeButtons = document.querySelectorAll(".remove-pay-head");
                removeButtons.forEach(button => {
                    button.addEventListener("click", function () {
                        const payHeadItem = this.closest(".pay-head-item");
                        const amount = Number(payHeadItem.querySelector(".pay-head-amount").value);
                        const type = payHeadItem.querySelector(".pay-head-type").textContent;
                        if(type === "Earnings"){
                            totalEarnings -= amount;
                            document.getElementById("earnings-summary-value").textContent = totalEarnings;
                        }else if(type === "Deductions"){
                            totalDeductions -= amount;
                            document.getElementById("deductions-summary-value").textContent = totalDeductions;
                        }
                        document.getElementById("net-summary-value").textContent = totalEarnings - totalDeductions;
                        payHeadItem.remove();
                    });
                });

                document.getElementById("earnings-summary-value").textContent = totalEarnings;
                document.getElementById("deductions-summary-value").textContent = totalDeductions;
                document.getElementById("net-summary-value").textContent = totalEarnings - totalDeductions;
            });
        }
    })
    .catch(error => console.error(error));
}

async function addEmployeePayHead() {
    const employeeId = document.getElementById("modal-overlay").getAttribute("data-employee-id");
    const payHeadItems = document.querySelectorAll(".pay-head-item");

    const requests = Array.from(payHeadItems).map(item => {
        const payHeadId = item.getAttribute("data-pay-head-id");
        const amount = parseFloat(item.querySelector(".pay-head-amount").value);
        const formData = {
            employeeId: parseInt(employeeId),
            payHeadId: parseInt(payHeadId),
            amount: amount
        };

        return fetch("api/employee_pay_heads_api.php", {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status !== "success") {
                throw new Error("Failed to add pay head");
            }
            return data;
        });
    });

    return Promise.all(requests);
}


async function addPayroll() {
    const formData = {
        employeeId: Number(document.getElementById("modal-overlay").getAttribute("data-employee-id")),
        status: "Issued",
        totalEarnings: totalEarnings,
        totalDeductions: totalDeductions,
        netPay: totalEarnings - totalDeductions,
        notes: document.getElementById("payment-notes").value
    };

    const response = await fetch("api/payroll_api.php", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(formData)
    });

    const data = await response.json();
    if (data.status !== "success") {
        throw new Error("Failed to add payroll");
    }
    return data;
}

async function updateEmployee(){
    const formData = {
        lastPayDate: new Date().toISOString().split('T')[0],
        employeeId: Number(document.getElementById("modal-overlay").getAttribute("data-employee-id"))
    }

    const response = await fetch("api/employee_lastpaydate_api.php", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(formData)
    });

    const data = await response.json();
    if (data.status !== "success") {
        throw new Error("Failed to add payroll");
    }
    return data;
}

function getIssuedEmployee(){
    fetch("api/employee_lastpaydate_api.php", {
        method: "GET",
        headers: { "Content-Type": "application/json" }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("issuedContent").innerHTML = "";
            data.issuedEmployee.forEach(employee => {
                document.getElementById("issuedContent").innerHTML += `
                    <tr class="tr-body-style" data-issued-employee-id="${employee.employee_id}">
                        <td class="td-style">${employee.first_name} ${employee.middle_name ? employee.middle_name + " " : ""} ${employee.last_name}</td>
                        <td class="td-style">${employee.pay_date_only}</td>
                        <td class="td-style">₱${employee.net_pay}</td>
                    </tr>
                `;
            });

            document.querySelectorAll(".tr-body-style").forEach(button =>{
                button.addEventListener("click", function(event){
                    event.preventDefault();
                    const employeeId = this.getAttribute("data-issued-employee-id");
                    const employeeData = data.issuedEmployee.find(e => e.employee_id == employeeId);
                    if(employeeData){
                        showReceipt(employeeData);
                    }
                });
            });
        }
    })
    .catch(error => console.error(error));
}

function showReceipt(employeeData){
    document.getElementById("modal-overlay-receipt").classList.add("show");
    
    document.getElementById("earnings-box-receipt").innerHTML = '';
    document.getElementById("deductions-box-receipt").innerHTML = '';

    document.getElementById("close-button-receipt").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("modal-overlay-receipt").classList.remove("show");
    });

    document.getElementById("payDateReceipt").innerHTML = `<strong>Pay Date:</strong> ${employeeData.pay_date_only}`;
    document.getElementById("payrollIdReceipt").innerHTML = `<strong>Payroll ID:</strong> ${employeeData.payroll_id}`;
    document.getElementById("statusReceipt").innerHTML = `<strong>Status:</strong> ${employeeData.status}`;
    document.getElementById("nameReceipt").innerHTML = `<strong>Name:</strong> ${employeeData.first_name} ${employeeData.middle_name ? employeeData.middle_name + " " : ""} ${employeeData.last_name}`;
    document.getElementById("designationReceipt").innerHTML = `<strong>Designation:</strong> ${employeeData.designation}`;
    document.getElementById("payFrequencyReceipt").innerHTML = `<strong>Pay Frequency:</strong> ${employeeData.pay_frequency}`;

    fetch(`api/employee_pay_heads_earnings_api.php?employeeId=${employeeData.employee_id}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(response => response.json())
    .then(data => {

        if(data.status === "success"){
            document.getElementById("earnings-box-receipt").innerHTML += `<h4 class="section-title-receipt">EARNINGS</h4>`;
            data.employeePayHeadsById.forEach(employeePayHead =>{
                document.getElementById("earnings-box-receipt").innerHTML += `
                    <div class="salary-item-receipt">
                        <span class="item-name-receipt">${employeePayHead.name}</span>
                        <span class="item-value-receipt">${employeePayHead.amount}</span>
                    </div>
                `;
            });
        }
        
        
    })
    .catch(error => console.error(error));

    fetch(`api/employee_pay_heads_deductions_api.php?employeeId=${employeeData.employee_id}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(response => response.json())
    .then(data => {

        if(data.status === "success"){
            document.getElementById("deductions-box-receipt").innerHTML += `<h4 class="section-title-receipt">DEDUCTIONS</h4>`;
            data.employeePayHeadsById.forEach(employeePayHead =>{
                document.getElementById("deductions-box-receipt").innerHTML += `
                    <div class="salary-item-receipt">
                        <span class="item-name-receipt">${employeePayHead.name}</span>
                        <span class="item-value-receipt">${employeePayHead.amount}</span>
                    </div>
                `;
            });
        }
        
        
    })
    .catch(error => console.error(error));

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