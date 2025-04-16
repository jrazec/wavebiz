@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Welcome, Admin')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Deliveries</h2>

    <!-- Filter Section -->
    <div class = "d-flex justify-content-end align-items-center gap-3 mb-4">
        <div>
            <label for="fromDate" class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
            <input type="date" id="fromDate" name="from_date">
        </div>

        <div>
            <label for="toDate" class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
            <input type="date" id="toDate" name="to_date">
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select id="status" name="status">
                <option value="">All</option>
                <option value="Pending">Pending</option>
                <option value="Shipped">Shipped</option>
                <option value="Delivered">Delivered</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>

        <div class="self-end">
            <button class="btn btn-primary">Filter</button>
        </div>
    </div>

    <!-- Deliveries Table -->
    <div>
        <table class="table table-striped table-sm">
            <thead class="table-dark">
                <tr>
                    <th>Order #</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Items</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $deliveries = [
                        ['order' => 'ORD-1001', 'date' => '2025-04-10', 'customer' => 'John Doe', 'items' => 3, 'status' => 'Pending'],
                        ['order' => 'ORD-1002', 'date' => '2025-04-09', 'customer' => 'Jane Smith', 'items' => 2, 'status' => 'Shipped'],
                        ['order' => 'ORD-1003', 'date' => '2025-04-08', 'customer' => 'Alice Johnson', 'items' => 5, 'status' => 'Delivered'],
                        ['order' => 'ORD-1004', 'date' => '2025-04-07', 'customer' => 'Bob Brown', 'items' => 1, 'status' => 'Cancelled'],
                    ];
                    $statusColors = [
                        'Pending' => 'bg-blue-100 text-blue-800',
                        'Shipped' => 'bg-yellow-100 text-yellow-800',
                        'Delivered' => 'bg-green-100 text-green-800',
                        'Cancelled' => 'bg-red-100 text-red-800',
                    ];
                @endphp

                @foreach ($deliveries as $delivery)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $delivery['order'] }}</td>
                    <td class="border px-4 py-2">{{ $delivery['date'] }}</td>
                    <td class="border px-4 py-2">{{ $delivery['customer'] }}</td>
                    <td class="border px-4 py-2">{{ $delivery['items'] }}</td>
                    <td class="border px-4 py-2">
                        <span class="px-2 py-1 rounded {{ $statusColors[$delivery['status']] }}">
                            {{ $delivery['status'] }}
                        </span>
                    </td>
                    <td class="border px-4 py-2">
                        <button class="btn btn-primary">View</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
