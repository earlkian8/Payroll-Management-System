document.addEventListener('DOMContentLoaded', function() {

    document.getElementById("edit").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("modalIssue").classList.add("show");
    });

    document.getElementById("closeModal").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("modalIssue").classList.remove("show");
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
});
