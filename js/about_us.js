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

    document.getElementById("logoutButton").addEventListener("click", () => {
        window.location.href = "api/logout.php";
    });
});