document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('addPayHeadModal');
    const addBtn = document.getElementById('addPayHeadBtn');
    const closeBtn = document.querySelector('.close');
    const modalTitle = document.querySelector('.modal-content h2');
    const form = document.getElementById('addPayHeadForm');
    const submitBtn = document.querySelector('.btn-submit');
    let isEditing = false;
    let editingId = null;

    // Open modal for adding
    addBtn.onclick = function() {
        isEditing = false;
        modalTitle.textContent = 'Add Pay Head';
        submitBtn.textContent = 'Add Pay Head';
        form.reset();
        modal.style.display = 'block';
    }

    // Close modal
    closeBtn.onclick = function() {
        modal.style.display = 'none';
    }

    // Click outside to close
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    // Handle edit buttons
    document.querySelectorAll('.btn-edit').forEach(button => {
        button.onclick = function() {
            isEditing = true;
            const row = this.closest('tr');
            editingId = row.cells[0].textContent;
            
            // Fill the form with current values
            document.getElementById('name').value = row.cells[1].textContent;
            document.getElementById('description').value = row.cells[2].textContent;
            document.getElementById('type').value = row.cells[3].textContent;

            // Update modal title and button
            modalTitle.textContent = 'Edit Pay Head';
            submitBtn.textContent = 'Update Pay Head';
            modal.style.display = 'block';
        }
    });    // Delete Modal Elements
    const deleteModal = document.getElementById('deleteModal');
    const deleteItemNameSpan = document.getElementById('deleteItemName');
    const cancelDeleteBtn = document.getElementById('cancelDelete');
    const confirmDeleteBtn = document.getElementById('confirmDelete');
    let deleteRow = null;

    // Handle delete buttons
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.onclick = function() {
            deleteRow = this.closest('tr');
            const name = deleteRow.cells[1].textContent;
            deleteItemNameSpan.textContent = name;
            deleteModal.style.display = 'block';
        }
    });

    // Cancel delete
    cancelDeleteBtn.onclick = function() {
        deleteModal.style.display = 'none';
        deleteRow = null;
    }

    // Confirm delete
    confirmDeleteBtn.onclick = function() {
        if (deleteRow) {
            // Here you would typically make an AJAX call to delete the record
            deleteRow.remove();
            deleteModal.style.display = 'none';
            deleteRow = null;
        }
    }

    // Close delete modal when clicking outside
    window.onclick = function(event) {
        if (event.target == deleteModal) {
            deleteModal.style.display = 'none';
            deleteRow = null;
        }
    }

    // Form submission
    form.onsubmit = function(e) {
        e.preventDefault();
        // Here you would typically make an AJAX call to save/update the record
        
        if (isEditing) {
            alert('Pay head updated successfully!');
        } else {
            alert('Pay head added successfully!');
        }
        modal.style.display = 'none';
    }
});
