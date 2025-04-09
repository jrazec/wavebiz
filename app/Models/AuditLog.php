<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class AuditLog extends Model
{
    protected $table = 'audit_logs';
    protected $primaryKey = 'fldID';

    protected $fillable = [
        'fldUserID',
        'fldAction',
        'fldTableName',
        'fldRecordID',
        'fldOldValue',
        'fldNewValue',
    ];

        // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'fldUserID');
    }
}
