@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Welcome, Admin')
@section('styles')
<style>
  .grid {
    max-height: 70vh;
    overflow-y: auto;
  }
</style>
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Business metrics charts
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(salesCtx, {
    type: 'bar',
    data: {
        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
        datasets: [{
            label: 'Weekly Sales ($)',
            data: [12500, 18750, 15600, 21000],
            backgroundColor: 'rgba(75, 192, 192, 0.5)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Amount ($)'
                }
            }
        }
    }
});

const membersCtx = document.getElementById('membersChart').getContext('2d');
const membersChart = new Chart(membersCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr'],
        datasets: [{
            label: 'Active Members',
            data: [85, 112, 135, 168],
            backgroundColor: 'rgba(153, 102, 255, 0.5)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1,
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const deliveryCtx = document.getElementById('deliveryChart').getContext('2d');
    const deliveryChart = new Chart(deliveryCtx, {
        type: 'doughnut',
        data: {
            labels: ['Delivered', 'Pending', 'Shipped', 'Cancelled'],
            datasets: [{
                data: [65, 15, 12, 8],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 99, 132, 0.5)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right',
                }
            }
        }
    });
});
</script>
@section('content')
<h1 class="text-2xl font-bold mb-4">Dashboard</h1>
<div id="landing-page" class="mb-4">
    <h2 class="text-xl font-bold mb-4">Business Analytics</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-bold mb-2">Weekly Sales</h3>
            <canvas id="salesChart" width="400" height="200"></canvas>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-bold mb-2">Member Growth</h3>
            <canvas id="membersChart" width="400" height="200"></canvas>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-bold mb-2">Delivery Status</h3>
            <canvas id="deliveryChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>
@endsection
