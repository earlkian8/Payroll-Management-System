document.addEventListener('DOMContentLoaded', function() {

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

    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    const issueButtons = document.querySelectorAll('.btn-issue');

    // Tab switching functionality
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tabId = button.getAttribute('data-tab');

            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            button.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        });
    });

    getPayHeads(userId);
    getDraftPayroll();
    getPendingPayroll();
    getIssuedPayroll();
    document.getElementById("addPayHeadBtn").addEventListener("click", function(event){
        event.preventDefault();
        addPayHead();
    });

    // document.getElementById("savePayHeadsBtn").addEventListener("click", function(event) {
    //     event.preventDefault();
    //     insertEmployeePayHeads();
    // });

    document.getElementById("closeModal").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("modalIssue").classList.remove("show");
    });

    document.getElementById("logoutButton").addEventListener("click", () => {
        window.location.href = "api/logout.php";
    });
});

let userId = null;
let totalEarnings = 0;
let totalDeductions = 0;

let netSalary = 0;


let allDraftPayroll = [];
let allPendingPayroll = [];
let allIssuedPayroll = [];
function getDraftPayroll(){
    fetch("api/store_session.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            userId = data.userId;
            return fetch(`api/draft_payroll_api.php?userId=${userId}`)
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("draftContent").innerHTML = "";
            allDraftPayroll = data.draftPayroll;
            data.draftPayroll.forEach(payroll => {
                document.getElementById("draftContent").innerHTML += `
                    <tr>
                        <td>${payroll.first_name} ${payroll.middle_name ? payroll.middle_name + " " : ""} ${payroll.last_name}</td>
                        <td>${payroll.pay_period_start}</td>
                        <td>${payroll.pay_period_end}</td>
                        <td>${payroll.pay_frequency}</td>
                    </tr>
                `;
            });
        }
    })
    .catch(error => console.error(error));
}

function getIssuedPayroll(){
    fetch("api/store_session.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            return fetch("api/issued_payroll_api.php?userId=" + data.userId)
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("issuedContent").innerHTML = "";
            allIssuedPayroll = data.issuedPayroll;
            data.issuedPayroll.forEach(p => {
                document.getElementById("issuedContent").innerHTML += `
                        <tr>
                            <td>${p.first_name} ${p.middle_name ? p.middle_name + " " : ""} ${p.last_name}</td>
                            <td>${p.pay_frequency}</td>
                            <td>₱${Math.abs(p.net_pay).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                        </tr>`;
            });
        }
    })
    .catch(error => console.error(error));
}

function getPendingPayroll(){
    fetch("api/store_session.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            userId = data.userId;
            return fetch(`api/pending_payroll_api.php?userId=${userId}`)
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("pendingContent").innerHTML = "";
            allPendingPayroll = data.pendingPayroll;
            data.pendingPayroll.forEach(payroll => {
                document.getElementById("pendingContent").innerHTML += `
                    <tr>
                        <td>${payroll.first_name} ${payroll.middle_name ? payroll.middle_name + " " : ""} ${payroll.last_name}</td>
                        <td>${payroll.pay_period_start}</td>
                        <td>${payroll.pay_period_end}</td>
                        <td>${payroll.pay_frequency}</td>
                        <td>
                            <button class="btn-issue" data-employee-id="${payroll.employee_id}" id="edit"><i class="fa-solid fa-wallet"></i></button>
                        </td>
                    </tr>
                `;
            });

            document.querySelectorAll(".btn-issue").forEach(button => {
                button.addEventListener("click", function(event){
                    event.preventDefault();
                    const employeeId = this.getAttribute("data-employee-id");
                    const employeeData = data.pendingPayroll.find(p => p.employee_id == employeeId);
                    if(employeeData){
                        document.getElementById("modalIssue").classList.add("show");
                        document.getElementById("issueName").textContent = `${employeeData.first_name} ${employeeData.middle_name ? employeeData.middle_name + " " : ""} ${employeeData.last_name}`;

                            document.getElementById("savePayHeadsBtn").addEventListener("click", function(event) {
                                event.preventDefault();

                                addPayrollDetails(employeeData.payroll_id, userId);
                                alert("Added Successfully!");
                                window.location.reload();
                            });
                    }
                });
            });
        }
    })
    .catch(error => console.error(error));
}

let allPayHeads = [];
function getPayHeads(id){
    fetch("api/pay_heads_api.php?userId=" + id)
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("payHeadSelect").innerHTML = "";
            document.getElementById("payHeadSelect").innerHTML += `<option value="">-- Select Pay Head --</option>`;

            allPayHeads = data.payHeads;
            data.payHeads.forEach(p => {
                document.getElementById("payHeadSelect").innerHTML += `
                    <option value="${p.pay_head_id}">${p.name}</option>
                `;
            });
        }
    })
    .catch(error => console.error(error));
}

function addPayHead() {
    const payHeadSelect = document.getElementById("payHeadSelect");
    const payHeadAmount = document.getElementById("payHeadAmount");
    const payHeadContainer = document.getElementById("payHeadContainer");

    const payHeadId = payHeadSelect.value;
    const selectedPayHead = payHeadSelect.options[payHeadSelect.selectedIndex].text;
    let amount = payHeadAmount.value.trim();

    if (!payHeadId || selectedPayHead === "-- Select Pay Head --") {
        alert("Please select a pay head.");
        return;
    }
    if (!amount || isNaN(amount) || amount <= 0) {
        alert("Please enter a valid amount.");
        return;
    }

    const payHead = allPayHeads.find(p => p.pay_head_id == payHeadId);
    const isDeduction = payHead.type == "Deductions" ? true : false;

    amount = parseFloat(amount);
    if (isDeduction) {
        amount = -amount;
    }

    payHeadContainer.innerHTML += `
        <div class="pay-head-card" data-pay-head-id="${payHeadId}">
            <span>${selectedPayHead}: ₱${Math.abs(amount).toFixed(2)}${isDeduction ? " (Deduction)" : " (Earning)"}</span>
            <button class="remove-btn"><i class="fas fa-trash"></i></button>
        </div>
    `;

    document.querySelectorAll(".remove-btn").forEach(button => {
        button.addEventListener("click", function() {
            this.parentElement.remove();
            updatePaymentSummary();
        });
    });

    payHeadSelect.value = "";
    payHeadAmount.value = "";

    updatePaymentSummary();
}

function updatePaymentSummary() {
    totalEarnings = 0;
    totalDeductions = 0;

    const payHeadCards = document.querySelectorAll(".pay-head-card");

    payHeadCards.forEach(card => {
        const text = card.querySelector("span").textContent;
        const amount = parseFloat(text.match(/\₱([\d.]+)/)[1]);
        const isDeduction = text.toLowerCase().includes("deduction") || text.toLowerCase().includes("tax");

        if (isDeduction) {
            totalDeductions += amount;
        } else {
            totalEarnings += amount;
        }
    });

    netSalary = totalEarnings - totalDeductions;

    document.getElementById("totalEarnings").textContent = `₱${totalEarnings.toFixed(2)}`;
    document.getElementById("totalDeductions").textContent = `₱${totalDeductions.toFixed(2)}`;
    document.getElementById("netSalary").textContent = `₱${netSalary.toFixed(2)}`;
}

function insertEmployeePayHeads() {
    
}

function addPayrollDetails(payrollIdV, userIdV){

    const formData = {
        payrollId: Number(payrollIdV),
        userId: Number(userIdV),
        totalEarnings: totalEarnings,
        totalDeductions: totalDeductions,
        netPay: netSalary,
        notes: document.getElementById("paymentNotes").value
    }
    fetch("api/payroll_details.php", {
        method: "POST",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            const payHeadCards = document.querySelectorAll(".pay-head-card");
            const employeeId = document.querySelector(".btn-issue[data-employee-id]").getAttribute("data-employee-id");

            if (payHeadCards.length === 0) {
                alert("Please add at least one pay head.");
                return;
            }

            const payHeads = Array.from(payHeadCards).map(card => {
                const text = card.querySelector("span").textContent;
                const amount = parseFloat(text.match(/\₱([\d.]+)/)[1]);
                const isDeduction = text.toLowerCase().includes("deduction") || text.toLowerCase().includes("tax");
                return {
                    payHeadId: card.getAttribute("data-pay-head-id"),
                    amount: isDeduction ? -amount : amount
                };
            });

            const payload = {
                userId: userId,
                employeeId: employeeId,
                payrollDetailsId: data.id,
                payHeads: payHeads
            };

            return fetch("api/employee_pay_heads.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(payload)
            })
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success");
    })
    .catch(error => console.error(error));
}


function searchPayroll() {
    const searchInput = document.getElementById("searchInput").value.toLowerCase();
    const activeTab = document.querySelector('.tab-btn.active').getAttribute('data-tab');
    let contentId, allPayroll;

    // Determine the active tab and corresponding content/array
    switch (activeTab) {
        case 'draft':
            contentId = 'draftContent';
            allPayroll = allDraftPayroll;
            break;
        case 'pending':
            contentId = 'pendingContent';
            allPayroll = allPendingPayroll;
            break;
        case 'issued':
            contentId = 'issuedContent';
            allPayroll = allIssuedPayroll;
            break;
    }

    const content = document.getElementById(contentId);

    if (!searchInput) {
        // If search is empty, reload the active tab's payroll
        switch (activeTab) {
            case 'draft':
                getDraftPayroll();
                break;
            case 'pending':
                getPendingPayroll();
                break;
            case 'issued':
                getIssuedPayroll();
                break;
        }
        return;
    }

    // Filter payroll based on search input
    const filteredPayroll = allPayroll.filter(payroll => {
        const fullName = `${payroll.first_name} ${payroll.middle_name || ''} ${payroll.last_name}`.toLowerCase();
        return fullName.includes(searchInput) ||
               payroll.pay_period_start.toLowerCase().includes(searchInput) ||
               payroll.pay_period_end.toLowerCase().includes(searchInput) ||
               payroll.pay_frequency.toLowerCase().includes(searchInput) ||
               (payroll.net_pay && payroll.net_pay.toString().toLowerCase().includes(searchInput));
    });

    // Display filtered payroll
    content.innerHTML = "";
    filteredPayroll.forEach(payroll => {
        switch (activeTab) {
            case 'draft':
                content.innerHTML += `
                    <tr>
                        <td>${payroll.first_name} ${payroll.middle_name ? payroll.middle_name + " " : ""} ${payroll.last_name}</td>
                        <td>${payroll.pay_period_start}</td>
                        <td>${payroll.pay_period_end}</td>
                        <td>${payroll.pay_frequency}</td>
                    </tr>
                `;
                break;
            case 'pending':
                content.innerHTML += `
                    <tr>
                        <td>${payroll.first_name} ${payroll.middle_name ? payroll.middle_name + " " : ""} ${payroll.last_name}</td>
                        <td>${payroll.pay_period_start}</td>
                        <td>${payroll.pay_period_end}</td>
                        <td>${payroll.pay_frequency}</td>
                        <td>
                            <button class="btn-issue" data-employee-id="${payroll.employee_id}" id="edit"><i class="fa-solid fa-wallet"></i></button>
                        </td>
                    </tr>
                `;
                break;
            case 'issued':
                content.innerHTML += `
                    <tr>
                        <td>${payroll.first_name} ${payroll.middle_name ? payroll.middle_name + " " : ""} ${payroll.last_name}</td>
                        <td>${payroll.pay_frequency}</td>
                        <td>₱${Math.abs(payroll.net_pay).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    </tr>
                `;
                break;
        }
    });

    // Reattach event listeners for Pending tab (btn-issue)
    if (activeTab === 'pending') {
        document.querySelectorAll(".btn-issue").forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault();
                const employeeId = this.getAttribute("data-employee-id");
                const employeeData = allPendingPayroll.find(p => p.employee_id == employeeId);
                if (employeeData) {
                    document.getElementById("modalIssue").classList.add("show");
                    document.getElementById("issueName").textContent = `${employeeData.first_name} ${employeeData.middle_name ? employeeData.middle_name + " " : ""} ${employeeData.last_name}`;

                    document.getElementById("savePayHeadsBtn").addEventListener("click", function(event) {
                        event.preventDefault();
                        addPayrollDetails(employeeData.payroll_id, userId);
                        alert("Added Successfully!");
                        window.location.reload();
                    });
                }
            });
        });
    }
}