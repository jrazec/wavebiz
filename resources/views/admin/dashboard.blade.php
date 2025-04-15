<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Dashboard Charts</h2>

    <!-- Product Table -->
    <table class="table table-bordered table-striped table-sm" id="productsTable">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Brand</th>
                <th>Price</th>
                <th>Special Price</th>
                <th>Published</th>
                <th>Sold Out</th>
                <th>Battery</th>
                <th>Liquid</th>
                <th>Flammable</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>


</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token;

    document.addEventListener('DOMContentLoaded', () => {
        loadProducts();
        loadAuditLogs();
    });

    function loadProducts() {
        axios.get('/api/products')
            .then(response => {
                const tbody = document.querySelector('#productsTable tbody');
                tbody.innerHTML = '';

                response.data.forEach(product => {
                    tbody.innerHTML += `
                        <tr>
                            <td>${product.fldID}</td>
                            <td>${product.fldName || ''}</td>
                            <td>${product.fldDescription || ''}</td>
                            <td>${product.fldBrand || ''}</td>
                            <td>${parseFloat(product.fldPrice).toFixed(4)}</td>
                            <td>${parseFloat(product.fldSpecialPrice).toFixed(4)}</td>
                            <td>${product.fldIsPublished == 1 ? 'Yes' : 'No'}</td>
                            <td>${product.fldIsSoldOut == 1 ? 'Yes' : 'No'}</td>
                            <td>${product.fldIsBattery == 1 ? 'Yes' : 'No'}</td>
                            <td>${product.fldIsLiquid == 1 ? 'Yes' : 'No'}</td>
                            <td>${product.fldIsFlammable == 1 ? 'Yes' : 'No'}</td>
                        </tr>
                    `;
                });
            });
    }

</script>
</body>
</html>
