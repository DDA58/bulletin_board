<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdCategories extends Model
{
    use HasFactory;

    public function childCategories()
    {
        return $this->hasMany(AdCategories::class, 'parent_id', 'id')->with('childCategories');
    }

    public function isRoot() : bool {
    	return (bool)$this->parent_id;
    }

    public function hasChilders() : bool {
    	return (bool)count($this->childCategories);
    }
}
