<?php

namespace Nirdysh\EloquentEav\Relations;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Concerns\InteractsWithDictionary;
use Illuminate\Database\Eloquent\Relations\Relation;

class HasEavThrough extends Relation
{
    use InteractsWithDictionary;

    public function __construct(
        protected Builder $query,
        protected Model $parent,
        protected Model $attribute,
        protected Model $value,
        protected string $attrLocalKey,
        protected string $attrForeignKey,
        protected string $attrValueLocalKey,
        protected string $attrValueForeignKey,
        protected string $valueLocalKey,
        protected string $valueForeignKey,
        protected string $attributeKey,
        protected string $valueKey,
    ) {
        parent::__construct($query, $parent);
    }

    public function addConstraints()
    {
        // TODO: Implement addConstraints() method.
    }

    public function addEagerConstraints(array $models)
    {
        // TODO: Implement addEagerConstraints() method.
    }

    public function initRelation(array $models, $relation)
    {
        // TODO: Implement initRelation() method.
    }

    public function match(array $models, Collection $results, $relation)
    {
        // TODO: Implement match() method.
    }

    public function getResults()
    {
        // TODO: Implement getResults() method.
    }
}
