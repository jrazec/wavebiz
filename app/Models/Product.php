<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false; 
    protected $table = 'products';

    protected $primaryKey = 'fldID';

    protected $fillable = [
        'fldName',
        'fldDescription',
        'fldShortDescription',
        'fldPrice',
        'fldCategoryID',
        'fldBrand',
        'fldFDARegistration',
        'fldExpiryDate',
        'fldMaterial',
        'fldWeight',
        'fldWidth',
        'fldLength',
        'fldHeight',
        'fldDimension',
        'fldUnit',
        'fldWarranty',
        'fldWarrantyPolicy',
        'fldCondition',
        'fldSpecialPrice',
        'fldVariation1',
        'fldVariation2',
        'fldIsBattery',
        'fldIsFlammable',
        'fldIsLiquid',
        'fldIsPublished',
        'fldIsCompanyOwned',
        'fldIsSoldOut',
        'fldIsVisible',
        'fldIsDeleted',
    ];
    

}
