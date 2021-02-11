<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait FilterScope {
    function scopeFilter(Builder $builder) : Builder {
		$oReflection = new \ReflectionClass($this);
        $creatorName ='\App\Services\Filters\\'.$oReflection->getShortName().'FilterCreator';
        $oFilterCreator = resolve($creatorName);
        $oFilterCreator->getFulltextSearch()->setModel($builder->getModel());

        return $oFilterCreator->apply($builder);
    }
}
