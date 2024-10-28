<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tbl_techstack_resource extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'techstack_id',
        'resource_id',
        'level',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function techstack()
    {
        return $this->belongsTo(mst_techstack::class, 'techstack_id', 'id');
    }

    public function resource()
    {
        return $this->belongsTo(mst_resource::class, 'resource_id', 'id');
    }
}
