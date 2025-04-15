<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';
    public $timestamps = false; 
    protected $primaryKey = 'fldID';

    protected $fillable = [
        'fldUserID',
        'fldUserName',
        'fldFirstName',
        'fldMiddleName',
        'fldLastName',
        'fldNickName',
        'fldPassword',
        'fldBirthDate',
        'fldCivilStatus',
        'fldGender',
        'fldNationality',
        'fldOrderLimitPerMonth',
        'fldAgreeTerms',
        'fldTermsAndCondition',
        'fldUpdateNeeded',
        'fldDateCreated',
        'fldCreatedBy',
        'fldDateModified',
        'fldModifiedBy',
        'fldIsDeleted',
        'fldDateDeleted',
        'fldDeletedBy',
        'fldEmailAdd',
        'fldCellphone',
        'fldLandline',
        'fldBeneficiary',
        'fldRelationship',
        'fldTIN',
        'fldPackageID',
        'fldStatus',
        'fldSponsorID',
        'fldDirectSponsorID',
    ];
    
}
