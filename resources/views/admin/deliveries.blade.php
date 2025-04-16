@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Welcome, Admin')

@section('content')
<h2 class="text-xl font-bold mb-2 text-black">Deliveries</h2>
            
<div class="flex mb-4 gap-4">
    <div>
        <label class="block text-sm font-medium mb-1">From Date</label>
        <input type="date" class="border p-2 rounded">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">To Date</label>
        <input type="date" class="border p-2 rounded">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Status</label>
        <select class="border p-2 rounded">
            <option>All</option>
            <option>Pending</option>
            <option>Shipped</option>
            <option>Delivered</option>
            <option>Cancelled</option>
        </select>
    </div>
    <div class="self-end">
        <button class="bg-yellow-500 text-black px-4 py-2 rounded">Filter</button>
    </div>
</div>

<table class="min-w-full border">
    <thead>
        <tr>
            <th class="border px-4 py-2">Order #</th>
            <th class="border px-4 py-2">Date</th>
            <th class="border px-4 py-2">Customer</th>
            <th class="border px-4 py-2">Items</th>
            <th class="border px-4 py-2">Status</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="border px-4 py-2">ORD-1001</td>
            <td class="border px-4 py-2">2025-04-10</td>
            <td class="border px-4 py-2">John Doe</td>
            <td class="border px-4 py-2">3</td>
            <td class="border px-4 py-2"><span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">Pending</span></td>
            <td class="border px-4 py-2">
                <button class="bg-yellow-500 text-black px-2 py-1">View</button>
            </td>
        </tr>
        <tr>
            <td class="border px-4 py-2">ORD-1002</td>
            <td class="border px-4 py-2">2025-04-09</td>
            <td class="border px-4 py-2">Jane Smith</td>
            <td class="border px-4 py-2">2</td>
            <td class="border px-4 py-2"><span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Shipped</span></td>
            <td class="border px-4 py-2">
                <button class="bg-yellow-500 text-black px-2 py-1">View</button>
            </td>
        </tr>
        <tr>
            <td class="border px-4 py-2">ORD-1003</td>
            <td class="border px-4 py-2">2025-04-08</td>
            <td class="border px-4 py-2">Alice Johnson</td>
            <td class="border px-4 py-2">5</td>
            <td class="border px-4 py-2"><span class="bg-green-100 text-green-800 px-2 py-1 rounded">Delivered</span></td>
            <td class="border px-4 py-2">
                <button class="bg-yellow-500 text-black px-2 py-1">View</button>
            </td>
        </tr>
        <tr>
            <td class="border px-4 py-2">ORD-1004</td>
            <td class="border px-4 py-2">2025-04-07</td>
            <td class="border px-4 py-2">Bob Brown</td>
            <td class="border px-4 py-2">1</td>
            <td class="border px-4 py-2"><span class="bg-red-100 text-red-800 px-2 py-1 rounded">Cancelled</span></td>
            <td class="border px-4 py-2">
                <button class="bg-yellow-500 text-black px-2 py-1">View</button>
            </td>
        </tr>
    </tbody>
</table>
@endsection
