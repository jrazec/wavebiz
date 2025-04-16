@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Welcome, Admin')

{{-- audit log content --}}
@section('content')
<h3 class="mt-5 mb-3">Audit Logs</h3>
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

{{-- audit log scripts --}}
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        loadAuditLogs();
    });

    function loadAuditLogs() {
        axios.get('/api/audit-logs') // expected: joined data with user info
            .then(response => {
                const tbody = document.querySelector('#auditLogsTable tbody');
                tbody.innerHTML = '';

                response.data.forEach(log => {
                    let oldVals = tryParseJSON(log.fldOldValue);
                    let newVals = tryParseJSON(log.fldNewValue);
                    let changes = [];

                    for (let key in newVals) {
                        if (oldVals && oldVals[key] !== newVals[key]) {
                            changes.push(`${key}: "${oldVals[key]}" → "${newVals[key]}"`);
                        }
                    }

                    tbody.innerHTML += `
                        <tr>
                            <td>${log.fldID}</td>
                            <td>${log.fldFirstName || ''}</td>
                            <td>${log.fldLastName || ''}</td>
                            <td>${log.role || ''}</td>
                            <td>${log.fldAction}</td>

                            <td>${new Date(log.created_at).toLocaleString()}</td>
                        </tr>
                    `;
                });
            });
    }
</script>
@endsection