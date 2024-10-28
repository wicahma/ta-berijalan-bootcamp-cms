<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class mst_section extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'is_active',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function mst_techstacks()
    {
        return $this->hasMany(mst_techstack::class);
    }

    public function resources()
    {
        return $this->hasMany(tbl_techstack_resource::class);
    }

    public function delete()
    {
        if ($this->resources()->exists())
            $this->resources()->delete();
        if ($this->mst_techstacks()->exists())
            $this->mst_techstacks()->delete();
        return parent::delete();
    }

    protected static function boot()
    {
        parent::boot();

        static::restoring(function ($resource) {
            $resource->resources()->restore();
            $resource->mst_techstacks()->restore();
        });
    }
}
