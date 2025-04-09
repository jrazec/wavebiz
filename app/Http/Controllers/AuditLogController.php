<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index()
    {


        $logs = AuditLog::join('users', 'audit_logs.fldUserID', '=', 'users.fldID')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($log) {
                return [
                    'fldID' => $log->fldID,
                    'fldFirstName' => $log->fldFirstName,
                    'fldLastName' => $log->fldLastName,
                    'role' => $log->fldRoleName,
                    'fldAction' => $log->fldAction,
                    'fldTableName' => $log->fldTableName,
                    'fldRecordID' => $log->fldRecordID,
                    'old_values' => json_decode($log->fldOldValue, true),
                    'new_values' => json_decode($log->fldNewValue, true),
                    'differences' => $this->getDifferences($log->fldOldValue, $log->fldNewValue),
                    'created_at' => $log->created_at->format('Y-m-d H:i:s'),
                ];
            });
            
        return response()->json($logs);
    }

    private function getDifferences($oldJson, $newJson)
    {
        $old = json_decode($oldJson, true) ?? [];
        $new = json_decode($newJson, true) ?? [];
        $diffs = [];

        foreach ($new as $key => $value) {
            if (!array_key_exists($key, $old) || $old[$key] != $value) {
                $diffs[$key] = [
                    'old' => $old[$key] ?? null,
                    'new' => $value,
                ];
            }
        }

        return $diffs;
    }
}
