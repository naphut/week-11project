
@extends('layouts.app')

@section('content')
<!-- Header -->
<div class="header">
    <div class="menu-toggle" id="menu-toggle">☰</div>
    <h1>Store Dashboard</h1>
    <div class="header-right">
        <input type="text" placeholder="Search here..." class="search-bar">
        <select id="language-select">
            <option value="en">ENG (US)</option>
            <option value="km">Khmer (KM)</option>
        </select>
        <span class="notification">🔔</span>
        <div class="user">
            <img src="https://static.vecteezy.com/system/resources/thumbnails/000/439/863/small/Basic_Ui__28186_29.jpg" alt="User">
        </div>
    </div>
</div>
<!-- Orders Table -->
<div class="widget orders-table">
    <h3>All Orders</h3>
    <button class="add-btn" onclick="openAddModal()">Add New Order</button>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Customer Type</th>
                    <th>Payment Type</th>
                    <th>Quantity</th>
                    <th>Date/Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="orders-tbody">
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->product->product_name }}</td>
                    <td>{{ $order->customerType->customer_type_description }}</td>
                    <td>{{ $order->paymentType->payment_type_description }}</td>
                    <td>{{ $order->order_quantity }}</td>
                    <td>{{ $order->order_date_time }}</td>
                    <td>{{ $order->order_status }}</td>
                    <td>
                        <button class="edit-btn" onclick="openEditModal('{{ $order->order_id }}')">Edit</button>
                        <form action="{{ route('orders.destroy', $order->order_id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add New Order Modal -->
<div id="add-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeAddModal()">×</span>
        <h2>Add New Order</h2>
        <form id="add-order-form" action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="add-product">Product:</label>
                <select id="add-product" name="product_id" required class="form-control">
                    <option value="" disabled selected>Select a product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->product_id }}">{{ $product->product_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="add-customer-type">Customer Type:</label>
                <select id="add-customer-type" name="customer_type_id" required class="form-control">
                    <option value="" disabled selected>Select customer type</option>
                    @foreach($customerTypes as $type)
                        <option value="{{ $type->customer_type_id }}">{{ $type->customer_type_description }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="add-payment-type">Payment Type:</label>
                <select id="add-payment-type" name="payment_type_id" required class="form-control">
                    <option value="" disabled selected>Select payment type</option>
                    @foreach($paymentTypes as $type)
                        <option value="{{ $type->payment_type_id }}">{{ $type->payment_type_description }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="add-order-quantity">Order Quantity:</label>
                <input type="number" id="add-order-quantity" name="order_quantity" min="1" required class="form-control">
            </div>
            <div class="form-group">
                <label for="add-order-date-time">Order Date & Time:</label>
                <input type="datetime-local" id="add-order-date-time" name="order_date_time" required class="form-control">
            </div>
            <div class="form-group">
                <label for="add-order-status">Order Status:</label>
                <input type="text" id="add-order-status" name="order_status" placeholder="e.g., Pending" required class="form-control">
            </div>
            <div class="modal-buttons">
                <button type="submit" class="btn btn-primary">Add Order</button>
            </div>
        </form>
    </div>
</div>

<!-- Add data attributes to table rows -->
@foreach($orders as $order)
<tr data-order-id="{{ $order->order_id }}" 
    data-product-id="{{ $order->product_id }}"
    data-customer-type-id="{{ $order->customer_type_id }}"
    data-payment-type-id="{{ $order->payment_type_id }}"
    data-quantity="{{ $order->order_quantity }}"
    data-date-time="{{ $order->order_date_time->format('Y-m-d\TH:i') }}"
    data-status="{{ $order->order_status }}">
    <!-- ... existing table cells ... -->
    <td>
        <button class="edit-btn" onclick="openEditModal('{{ $order->order_id }}')">Edit</button>
        <!-- ... delete button ... -->
    </td>
</tr>
@endforeach

<!-- Edit Modal -->
<div id="edit-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">×</span>
        <h2>Edit Order</h2>
        <form id="edit-order-form" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="edit-order-id">Order ID:</label>
                <input type="text" id="edit-order-id" name="order_id" readonly>
            </div>
            <div class="form-group">
                <label for="edit-product">Product:</label>
                <select id="edit-product" name="product_id" required class="form-control">
                    @foreach($products as $product)
                    <option value="{{ $product->product_id }}">{{ $product->product_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="edit-customer-type">Customer Type:</label>
                <select id="edit-customer-type" name="customer_type_id" required class="form-control">
                    @foreach($customerTypes as $type)
                    <option value="{{ $type->customer_type_id }}">{{ $type->customer_type_description }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="edit-payment-type">Payment Type:</label>
                <select id="edit-payment-type" name="payment_type_id" required class="form-control">
                    @foreach($paymentTypes as $type)
                    <option value="{{ $type->payment_type_id }}">{{ $type->payment_type_description }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="edit-order-quantity">Order Quantity:</label>
                <input type="number" id="edit-order-quantity" name="order_quantity" min="1" required class="form-control">
            </div>
            <div class="form-group">
                <label for="edit-order-date-time">Order Date & Time:</label>
                <input type="datetime-local" id="edit-order-date-time" name="order_date_time" required class="form-control">
            </div>
            <div class="form-group">
                <label for="edit-order-status">Order Status:</label>
                <input type="text" id="edit-order-status" name="order_status" required class="form-control">
            </div>
            <div class="modal-buttons">
                <button type="submit" class="btn btn-primary">Update Order</button>
                <button type="button" class="btn btn-danger" onclick="handleDelete()">Delete Order</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Sidebar Toggle for Mobile
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    menuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
    });

    // Modal Functions
    function openAddModal() {
        document.getElementById('add-modal').style.display = 'block';
    }

    function closeAddModal() {
        document.getElementById('add-modal').style.display = 'none';
    }

    function openEditModal(orderId) {
        const modal = document.getElementById('edit-modal');
        const row = document.querySelector(`tr:has(td:first-child:contains("${orderId}")`);
        
        if (row) {
            document.getElementById('edit-order-id').value = orderId;
            document.getElementById('edit-product').value = row.cells[1].textContent;
            document.getElementById('edit-customer-type').value = row.cells[2].textContent;
            document.getElementById('edit-payment-type').value = row.cells[3].textContent;
            document.getElementById('edit-order-quantity').value = row.cells[4].textContent;
            document.getElementById('edit-order-date-time').value = formatDateTimeForInput(row.cells[5].textContent);
            document.getElementById('edit-order-status').value = row.cells[6].textContent;
            
            // Update form action
            const form = document.getElementById('edit-order-form');
            form.action = `/orders/${orderId}`;
            
            modal.style.display = 'block';
        }
    }

    function closeEditModal() {
        document.getElementById('edit-modal').style.display = 'none';
    }

    function formatDateTimeForInput(dateTimeString) {
        const date = new Date(dateTimeString);
        return date.toISOString().slice(0, 16);
    }

    // Close Modals When Clicking Outside
    window.addEventListener('click', (e) => {
        const editModal = document.getElementById('edit-modal');
        const addModal = document.getElementById('add-modal');
        if (e.target === editModal) {
            closeEditModal();
        }
        if (e.target === addModal) {
            closeAddModal();
        }
    });
</script>
@endpush
@endsection