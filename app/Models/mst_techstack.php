<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class mst_techstack extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'section_id',
        'name',
        'is_active',
    ];
    
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function section()
    {
        return $this->belongsTo(mst_section::class, 'section_id', 'id');
    }

    public function tbl_techstacks()
    {
        return $this->hasMany(tbl_techstack_resource::class, 'techstack_id', 'id');
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
