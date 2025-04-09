<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Product Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Product Management</h2>

    <!-- Add Product Form -->
    <div class="card mb-4">
        <div class="card-header">Add New Product</div>
        <div class="card-body">
            <form id="addProductForm">
                <div class="row g-3">
                    <!-- Required Fields -->
                    <div class="col-md-4">
                        <input type="text" name="fldName" class="form-control" placeholder="Product Name" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="fldDescription" class="form-control" placeholder="Description">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="fldShortDescription" class="form-control" placeholder="Short Description">
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="fldPrice" class="form-control" step="0.0001" placeholder="Price" required>
                    </div>
                    <div class="col-md-4">
                        <select name="fldCategoryID" class="form-select" required>
                            <option value="">-- Select Category --</option>
                        </select>
                    </div>

                    <!-- Optional Fields -->
                    <div class="col-md-4"><input type="text" name="fldBrand" class="form-control" placeholder="Brand"></div>
                    <div class="col-md-4"><input type="text" name="fldFDARegistration" class="form-control" placeholder="FDA Registration"></div>
                    <div class="col-md-4"><input type="date" name="fldExpiryDate" class="form-control" placeholder="Expiry Date"></div>
                    <div class="col-md-4"><input type="text" name="fldMaterial" class="form-control" placeholder="Material"></div>
                    <div class="col-md-2"><input type="number" name="fldWeight" class="form-control" placeholder="Weight"></div>
                    <div class="col-md-2"><input type="number" name="fldWidth" class="form-control" placeholder="Width"></div>
                    <div class="col-md-2"><input type="number" name="fldLength" class="form-control" placeholder="Length"></div>
                    <div class="col-md-2"><input type="number" name="fldHeight" class="form-control" placeholder="Height"></div>
                    <div class="col-md-2"><input type="text" name="fldDimension" class="form-control" placeholder="Dimension"></div>
                    <div class="col-md-2"><input type="text" name="fldUnit" class="form-control" placeholder="Unit"></div>
                    <div class="col-md-2"><input type="text" name="fldWarranty" class="form-control" placeholder="Warranty"></div>
                    <div class="col-md-4"><input type="text" name="fldWarrantyPolicy" class="form-control" placeholder="Warranty Policy"></div>
                    <div class="col-md-2"><input type="text" name="fldCondition" class="form-control" placeholder="Condition"></div>
                    <div class="col-md-2"><input type="number" name="fldSpecialPrice" class="form-control" step="0.0001" placeholder="Special Price"></div>
                    <div class="col-md-2"><input type="text" name="fldVariation1" class="form-control" placeholder="Variation 1"></div>
                    <div class="col-md-2"><input type="text" name="fldVariation2" class="form-control" placeholder="Variation 2"></div>

                    <!-- Boolean Flags -->
                    <div class="col-md-2">
                        <select name="fldIsBattery" class="form-select"><option value="0">Battery: No</option><option value="1">Battery: Yes</option></select>
                    </div>
                    <div class="col-md-2">
                        <select name="fldIsFlammable" class="form-select"><option value="0">Flammable: No</option><option value="1">Flammable: Yes</option></select>
                    </div>
                    <div class="col-md-2">
                        <select name="fldIsLiquid" class="form-select"><option value="0">Liquid: No</option><option value="1">Liquid: Yes</option></select>
                    </div>
                    <div class="col-md-2">
                        <select name="fldIsPublished" class="form-select"><option value="1">Published</option><option value="0">Unpublished</option></select>
                    </div>
                    <div class="col-md-2">
                        <select name="fldIsCompanyOwned" class="form-select"><option value="1">Company-Owned</option><option value="0">Not Company-Owned</option></select>
                    </div>
                    <div class="col-md-2">
                        <select name="fldIsSoldOut" class="form-select"><option value="0">Available</option><option value="1">Sold Out</option></select>
                    </div>
                    <div class="col-md-2">
                        <select name="fldIsVisible" class="form-select"><option value="1">Visible</option><option value="0">Hidden</option></select>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Add Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Product Table -->
    <table class="table table-bordered table-sm" id="productsTable">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Desc</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Special</th>
            <th>Published</th>
            <th>Sold Out</th>
            <th>Battery</th>
            <th>Liquid</th>
            <th>Flammable</th>
            <th>Actions</th>
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
        

        document.getElementById('addProductForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const form = new FormData(this);

            axios.post('/api/products', Object.fromEntries(form.entries()))
                .then(() => {
                    this.reset();
                    loadProducts();
                    alert('Product added!');
                });
        });
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
                        <td><input type="text" id="name-${product.fldID}" class="form-control form-control-sm" value="${product.fldName || ''}"></td>
                        <td><input type="text" id="desc-${product.fldID}" class="form-control form-control-sm" value="${product.fldDescription || ''}"></td>
                        <td><input type="text" id="brand-${product.fldID}" class="form-control form-control-sm" value="${product.fldBrand || ''}"></td>
                        <td><input type="number" id="price-${product.fldID}" class="form-control form-control-sm" value="${product.fldPrice || 0}" step="0.0001"></td>
                        <td><input type="number" id="sprice-${product.fldID}" class="form-control form-control-sm" value="${product.fldSpecialPrice || 0}" step="0.0001"></td>
                        <td>
                            <select id="ispublished-${product.fldID}" class="form-select form-select-sm">
                                <option value="1" ${product.fldIsPublished == 1 ? 'selected' : ''}>Yes</option>
                                <option value="0" ${product.fldIsPublished == 0 ? 'selected' : ''}>No</option>
                            </select>
                        </td>
                        <td>
                            <select id="issoldout-${product.fldID}" class="form-select form-select-sm">
                                <option value="0" ${product.fldIsSoldOut == 0 ? 'selected' : ''}>No</option>
                                <option value="1" ${product.fldIsSoldOut == 1 ? 'selected' : ''}>Yes</option>
                            </select>
                        </td>
                        <td>
                            <select id="isbattery-${product.fldID}" class="form-select form-select-sm">
                                <option value="0" ${product.fldIsBattery == 0 ? 'selected' : ''}>No</option>
                                <option value="1" ${product.fldIsBattery == 1 ? 'selected' : ''}>Yes</option>
                            </select>
                        </td>
                        <td>
                            <select id="isliquid-${product.fldID}" class="form-select form-select-sm">
                                <option value="0" ${product.fldIsLiquid == 0 ? 'selected' : ''}>No</option>
                                <option value="1" ${product.fldIsLiquid == 1 ? 'selected' : ''}>Yes</option>
                            </select>
                        </td>
                        <td>
                            <select id="isflammable-${product.fldID}" class="form-select form-select-sm">
                                <option value="0" ${product.fldIsFlammable == 0 ? 'selected' : ''}>No</option>
                                <option value="1" ${product.fldIsFlammable == 1 ? 'selected' : ''}>Yes</option>
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-success" onclick="updateProduct(${product.fldID})">Update</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteProduct(${product.fldID})">Delete</button>
                        </td>
                    </tr>
                `;
            });
        });
}


    function loadCategories() {
        axios.get('/api/categories')
        .then(response => {
            const categorySelect = document.querySelector('select[name="fldCategoryID"]');
            categorySelect.innerHTML = '<option value="">-- Select Category --</option>';

            response.data.forEach(category => {
                categorySelect.innerHTML += `<option value="${category.fldID}">${category.fldName}</option>`;
            });
        });

    }
    function updateProduct(id) {
        axios.put(`/api/products/${id}`, {
            fldName: document.getElementById(`name-${id}`).value,
            fldDescription: document.getElementById(`desc-${id}`).value,
            fldBrand: document.getElementById(`brand-${id}`).value,
            fldPrice: document.getElementById(`price-${id}`).value,
            fldSpecialPrice: document.getElementById(`sprice-${id}`).value,
            fldIsPublished: document.getElementById(`ispublished-${id}`).value,
            fldIsSoldOut: document.getElementById(`issoldout-${id}`).value,
            fldIsBattery: document.getElementById(`isbattery-${id}`).value,
            fldIsLiquid: document.getElementById(`isliquid-${id}`).value,
            fldIsFlammable: document.getElementById(`isflammable-${id}`).value
        }).then(() => {
            alert('Product updated!');
            loadProducts();
        });
    }


    function deleteProduct(id) {
        if (!confirm('Are you sure you want to delete this product?')) return;

        axios.delete(`/api/products/${id}`)
            .then(() => {
                alert('Product deleted!');
                loadProducts();
            });
    }


    document.addEventListener('DOMContentLoaded', () => {
        loadCategories(); 
    });

   


</script>
</body>
</html>
