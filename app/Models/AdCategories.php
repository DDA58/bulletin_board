<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class AdCategories extends Model
{
    use HasFactory;

    public array $listOfChildCategories;

    /**
     * Expand tree categories structure to collection
     *
     * @param Collection $categories
     * @return Collection
     */
    public static function treeToList(Collection $categories) : Collection
    {
        return collect(static::treeToArray($categories));
    }

    /**
     * Expand tree categories structure to array
     *
     * @param Collection $categories
     * @param array $list_storage
     * @return array
     */
    public static function treeToArray(Collection $categories, array &$list_storage = []) : array {
        foreach ($categories as $category) {
            $list_storage[] = $category;
            static::treeToArray($category->childCategories, $list_storage);
        }
        return $list_storage;
    }

    /**
     * Get collection with all parents by given AdCategory
     *
     * @param AdCategories $category
     * @return Collection
     */
    public static function getAllParents(AdCategories $category) : Collection {
        $parents = [];

        while($category) {
            if($category->parentCategory) {
                $parents[] = $category->parentCategory;
                $category = $category->parentCategory;
            } else
                break;
        }
        return collect($parents);
    }

    public function childCategories()
    {
        return $this->hasMany(AdCategories::class, 'parent_id', 'id')->with('childCategories')->orderBy('title');
    }

    public function parentCategory() {
        return $this->belongsTo(AdCategories::class, 'parent_id', 'id')->with('parentCategory');
    }

    /**
     * Is it this category to be root?
     *
     * @return bool
     */
    public function isRoot() : bool {
    	return (bool)$this->parent_id;
    }

    /**
     * Is it this category to has children?
     *
     * @return bool
     */
    public function hasChildren() : bool {
    	return (bool)count($this->childCategories);
    }
}
