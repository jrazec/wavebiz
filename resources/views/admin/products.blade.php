@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Welcome, Admin')

@section('content')
<h3 class="mt-5 mb-3">Product Management</h3>
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
@endsection
