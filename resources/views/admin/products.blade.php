@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Welcome, Admin')

@section('content')
<h2 class="text-2xl font-bold mb-4">Products</h2>

<!-- Top bar with Add button -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <!-- Placeholder for future category filters -->
        <strong>Filter by:</strong>
        <select class="form-select d-inline-block w-auto">
            <option value="">All Categories</option>
            {{-- Add dynamic categories here --}}
        </select>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
        + Add New Product
    </button>
</div>

<!-- Products Table -->
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-sm" id="productsTable">
            <thead class="table-light">
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
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <form id="addProductForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Basic Info -->
                        <div class="col-md-4">
                            <input type="text" name="fldName" class="form-control" placeholder="Product Name" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="fldDescription" class="form-control" placeholder="Description">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="fldShortDescription" class="form-control" placeholder="Short Description">
                        </div>

                        <!-- Pricing & Category -->
                        <div class="col-md-2">
                            <input type="number" name="fldPrice" class="form-control" step="0.0001" placeholder="Price" required>
                        </div>
                        <div class="col-md-4">
                            <select name="fldCategoryID" class="form-select" required>
                                <option value="">-- Select Category --</option>
                                {{-- Dynamically load categories --}}
                            </select>
                        </div>

                        <!-- Optional Info -->
                        <div class="col-md-4"><input type="text" name="fldBrand" class="form-control" placeholder="Brand"></div>
                        <div class="col-md-4"><input type="text" name="fldFDARegistration" class="form-control" placeholder="FDA Registration"></div>
                        <div class="col-md-4"><input type="date" name="fldExpiryDate" class="form-control" placeholder="Expiry Date"></div>
                        <div class="col-md-4"><input type="text" name="fldMaterial" class="form-control" placeholder="Material"></div>

                        <!-- Dimensions -->
                        <div class="col-md-2"><input type="number" name="fldWeight" class="form-control" placeholder="Weight"></div>
                        <div class="col-md-2"><input type="number" name="fldWidth" class="form-control" placeholder="Width"></div>
                        <div class="col-md-2"><input type="number" name="fldLength" class="form-control" placeholder="Length"></div>
                        <div class="col-md-2"><input type="number" name="fldHeight" class="form-control" placeholder="Height"></div>
                        <div class="col-md-2"><input type="text" name="fldDimension" class="form-control" placeholder="Dimension"></div>

                        <!-- Warranty & Variations -->
                        <div class="col-md-2"><input type="text" name="fldUnit" class="form-control" placeholder="Unit"></div>
                        <div class="col-md-2"><input type="text" name="fldWarranty" class="form-control" placeholder="Warranty"></div>
                        <div class="col-md-4"><input type="text" name="fldWarrantyPolicy" class="form-control" placeholder="Warranty Policy"></div>
                        <div class="col-md-2"><input type="text" name="fldCondition" class="form-control" placeholder="Condition"></div>
                        <div class="col-md-2"><input type="number" name="fldSpecialPrice" class="form-control" step="0.0001" placeholder="Special Price"></div>
                        <div class="col-md-2"><input type="text" name="fldVariation1" class="form-control" placeholder="Variation 1"></div>
                        <div class="col-md-2"><input type="text" name="fldVariation2" class="form-control" placeholder="Variation 2"></div>

                        <!-- Flags -->
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Product</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
