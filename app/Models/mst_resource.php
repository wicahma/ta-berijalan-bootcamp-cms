<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class mst_resource extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'section_id',
        'role_id',
        'type_id',
        'category_id',
        'name',
        'npk',
        'email',
        'phone_number',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];


    public function section()
    {
        return $this->belongsTo(mst_section::class);
    }

    public function role()
    {
        return $this->belongsTo(mst_role::class);
    }

    public function type()
    {
        return $this->belongsTo(mst_type::class);
    }

    public function category()
    {
        return $this->belongsTo(mst_category::class, 'category_id', 'id');
    }

    public function tbl_techstacks()
    {
        return $this->hasMany(tbl_techstack_resource::class, 'resource_id', 'id')->with('techstack');
    }

    public function delete()
    {
        if ($this->tbl_techstacks()->exists())
            $this->tbl_techstacks()->delete();
        return parent::delete();
    }

    protected static function boot()
    {
        parent::boot();

        static::restoring(function ($resource) {
            $resource->tbl_techstacks()->restore();
        });
    }

}
