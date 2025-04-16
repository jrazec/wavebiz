@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Welcome, Admin')

@section('content')
<h2 class="text-2xl font-bold mb-4">Members</h2>
  <table class="table table-striped table-sm" id="auditLogsTable">
      <thead class="table-dark">
          <tr>
              <th>fldID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>User Role</th>
              <th>Action</th>
              <th>Date</th>
          </tr>
      </thead>
      <tbody></tbody>
  </table>
@endsection
