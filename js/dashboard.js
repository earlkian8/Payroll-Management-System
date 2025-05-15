document.addEventListener("DOMContentLoaded", () => {
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
    getDashboard(userId);
});

function getDashboard(id){
    fetch("api/dashboard_api.php?userId=" + id)
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("totalEmployees").textContent = data.employees.empCount;
            document.getElementById("payrollProcessed").textContent = data.payrollDetails.pCount;
            document.getElementById("totalPayHeads").textContent = data.payHeads.pHCount;

            data.recentPayroll.forEach(p => {
                document.getElementById("content").innerHTML += `
                    <tr>
                        <td>${p.first_name} ${p.middle_name ? p.middle_name + " " : ""} ${p.last_name}</td>
                        <td>${new Date(p.pay_date).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })}</td>
                        <td>₱${Math.abs(p.total_earnings).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                        <td>₱${Math.abs(p.total_deductions).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                        <td>₱${Math.abs(p.net_pay).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                        <td><span style="color: #4CAF50;">${p.status}</span></td>
                    </tr>
                `;
            });
        }
    })
    .catch(error => console.error(error)); 
}

