<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';
    protected $primaryKey = 'fldID';
    public $timestamps = false; 

    protected $fillable = [
        'fldName',
        'fldDescription',
        'fldSeqNo',
        'fldImage',
        'fldDateCreated',
        'fldCreatedBy',
        'fldModified',
        'fldDateModified',
        'fldModifiedBy',
        'fldIsDeleted',
        'fldDateDeleted',
        'fldDeletedBy',
        'subCategoryId',
    ];
}
