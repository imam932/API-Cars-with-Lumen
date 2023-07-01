<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Audit;

class Brand extends Model
{
    use Audit;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'logo',
        'created_by',
        'updated_by'
    ];

    // protected $appends = [
    //     'logo_url',
    // ];
}
