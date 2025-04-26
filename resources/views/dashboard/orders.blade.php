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
        <table id="orders-table">
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
            <tbody>
                @foreach($orders as $order)
                <tr data-order="{{ json_encode([
                    'order_id' => $order->order_id,
                    'product_id' => $order->product_id,
                    'customer_type_id' => $order->customer_type_id,
                    'payment_type_id' => $order->payment_type_id,
                    'order_quantity' => $order->order_quantity,
                    'order_date_time' => $order->order_date_time,
                    'order_status' => $order->order_status,
                ]) }}">
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->product->product_name }}</td>
                    <td>{{ $order->customerType->customer_type_description }}</td>
                    <td>{{ $order->paymentType->payment_type_description }}</td>
                    <td>{{ $order->order_quantity }}</td>
                    <td>{{ $order->order_date_time }}</td>
                    <td>{{ $order->order_status }}</td>
                    <td>
                        <button class="edit-btn" onclick="openEditModal(this)">Edit</button>
                        <form action="{{ route('orders.destroy', $order->order_id) }}" method="POST" style="display:inline;">
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

<!-- Add Modal -->
<div id="add-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeAddModal()">×</span>
        <h2>Add New Order</h2>
        <form id="add-order-form" action="{{ route('orders.store') }}" method="POST">
            @csrf
            <!-- Form fields same as before -->
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
                <input type="text" id="add-order-status" name="order_status" required class="form-control">
            </div>
            <div class="modal-buttons">
                <button type="submit" class="btn btn-primary">Add Order</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="edit-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">×</span>
        <h2>Edit Order</h2>
        <form id="edit-order-form" method="POST">
            @csrf
            @method('PUT') <!-- PUT method for updating -->

            <div class="form-group">
                <label for="edit-order-id">Order ID:</label>
                <input type="text" id="edit-order-id" name="order_id" readonly>
            </div>
            <div class="form-group">
                <label for="edit-product">Product:</label>
                <select id="edit-product" name="product_id" required>
                    @foreach($products as $product)
                    <option value="{{ $product->product_id }}">{{ $product->product_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="edit-customer-type">Customer Type:</label>
                <select id="edit-customer-type" name="customer_type_id" required>
                    @foreach($customerTypes as $type)
                    <option value="{{ $type->customer_type_id }}">{{ $type->customer_type_description }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="edit-payment-type">Payment Type:</label>
                <select id="edit-payment-type" name="payment_type_id" required>
                    @foreach($paymentTypes as $type)
                    <option value="{{ $type->payment_type_id }}">{{ $type->payment_type_description }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="edit-order-quantity">Order Quantity:</label>
                <input type="number" id="edit-order-quantity" name="order_quantity" min="1" required>
            </div>
            <div class="form-group">
                <label for="edit-order-date-time">Order Date & Time:</label>
                <input type="datetime-local" id="edit-order-date-time" name="order_date_time" required>
            </div>
            <div class="form-group">
                <label for="edit-order-status">Order Status:</label>
                <input type="text" id="edit-order-status" name="order_status" required>
            </div>
            <div class="modal-buttons">
                <button type="submit" class="btn btn-primary">Update Order</button>
            </div>
        </form>
    </div>
</div>


@push('scripts')
<script>
    function openAddModal() {
        document.getElementById('add-modal').style.display = 'block';
    }

    function closeAddModal() {
        document.getElementById('add-modal').style.display = 'none';
    }

    function openEditModal(button) {
        const modal = document.getElementById('edit-modal');
        const data = JSON.parse(button.closest('tr').dataset.order);

        document.getElementById('edit-order-id').value = data.order_id;
        document.getElementById('edit-product').value = data.product_id;
        document.getElementById('edit-customer-type').value = data.customer_type_id;
        document.getElementById('edit-payment-type').value = data.payment_type_id;
        document.getElementById('edit-order-quantity').value = data.order_quantity;
        document.getElementById('edit-order-date-time').value = data.order_date_time.slice(0, 16);
        document.getElementById('edit-order-status').value = data.order_status;

        const form = document.getElementById('edit-order-form');
        form.action = `/orders/${data.order_id}`;

        modal.style.display = 'block';
    }

    function closeEditModal() {
        document.getElementById('edit-modal').style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById('edit-modal')) {
            closeEditModal();
        }
        if (event.target == document.getElementById('add-modal')) {
            closeAddModal();
        }
    }
</script>
@endpush

@endsection
