function openEditModal(orderId) {
    const modal = document.getElementById('edit-modal');
    const row = document.querySelector(`tr[data-order-id="${orderId}"]`);
    
    if (!modal || !row) return;

    // Set form values from data attributes
    document.getElementById('edit-order-id').value = orderId;
    document.getElementById('edit-product').value = row.dataset.productId;
    document.getElementById('edit-customer-type').value = row.dataset.customerTypeId;
    document.getElementById('edit-payment-type').value = row.dataset.paymentTypeId;
    document.getElementById('edit-order-quantity').value = row.dataset.quantity;
    document.getElementById('edit-order-date-time').value = row.dataset.dateTime;
    document.getElementById('edit-order-status').value = row.dataset.status;

    // Update form action
    const form = document.getElementById('edit-order-form');
    form.action = `/orders/${orderId}`;
    
    modal.style.display = 'block';
}

function closeEditModal() {
    const modal = document.getElementById('edit-modal');
    if (modal) {
        modal.style.display = 'none';
    }
}

// Handle form submission
document.getElementById('edit-order-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = e.target;
    const formData = new FormData(form);
    const orderId = document.getElementById('edit-order-id').value;

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        } else {
            alert('Error: ' + (data.message || 'Update failed'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred');
    });
});

function handleDelete() {
    const orderId = document.getElementById('edit-order-id').value;
    if (confirm('Are you sure you want to delete this order?')) {
        fetch(`/orders/${orderId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            }
        })
        .catch(error => console.error('Error:', error));
    }
}