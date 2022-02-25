<?php

namespace Nirdysh\EloquentEav\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Nirdysh\EloquentEav\Exceptions\InvalidEavModelException;
use Nirdysh\EloquentEav\Exceptions\MissingEavModelException;
use Nirdysh\EloquentEav\Relations\HasEavThrough;

trait HasEav
{
    /**
     * @param string $attribute
     * @param string $value
     * @param string $attrLocalKey
     * @param string $attrForeignKey
     * @param string $attrValueLocalKey
     * @param string $attrValueForeignKey
     * @param string $valueLocalKey
     * @param string $valueForeignKey
     * @return HasEavThrough
     */
    public function hasEavThrough(
        string $attribute,
        string $value,
        string $attrLocalKey,
        string $attrForeignKey,
        string $attrValueLocalKey,
        string $attrValueForeignKey,
        string $valueLocalKey,
        string $valueForeignKey,
        string $attributeKey,
        string $valueKey,
    ): HasEavThrough {
        assert(! empty($attribute), MissingEavModelException::make($this, true));
        assert(is_a(Model::class, $attribute), InvalidEavModelException::make($this, $attribute, true));
        assert(! empty($value), MissingEavModelException::make($this, false));
        assert(is_a(Model::class, $value), InvalidEavModelException::make($this, $value, false));

        $attribute = $this->newRelatedInstance($attribute);
        $value = $this->newRelatedInstance($value);

        $attrLocalKey = $attrLocalKey ?? $this->getKeyName();
        $attrForeignKey = $attrForeignKey ?? $this->getForeignKey();
        $attrValueLocalKey = $attrValueLocalKey ?? $attrLocalKey;
        $attrValueForeignKey = $attrValueForeignKey ?? $attrForeignKey;
        $valueLocalKey = $valueLocalKey ?? $attribute->getKeyName();
        $valueForeignKey = $valueForeignKey ?? $value->getForeignKey();
        $attributeKey = $attributeKey ?? 'slug';
        $valueKey = $valueKey ?? 'value';

        return $this->newHasEav(
            $attribute->newQuery(),
            $this,
            $attribute,
            $value,
            $attrLocalKey,
            $attrForeignKey,
            $attrValueLocalKey,
            $attrValueForeignKey,
            $valueLocalKey,
            $valueForeignKey,
            $attributeKey,
            $valueKey,
        );
    }

    protected function newHasEav(
        Builder $query,
        Model $parent,
        Model $attribute,
        Model $value,
        string $attrLocalKey,
        string $attrForeignKey,
        string $attrValueLocalKey,
        string $attrValueForeignKey,
        string $valueLocalKey,
        string $valueForeignKey,
        string $attributeKey,
        string $valueKey,
    ): HasEavThrough {
        return new HasEavThrough(
            $query,
            $parent,
            $attribute,
            $value,
            $attrLocalKey,
            $attrForeignKey,
            $attrValueLocalKey,
            $attrValueForeignKey,
            $valueLocalKey,
            $valueForeignKey,
            $attributeKey,
            $valueKey,
        );
    }

    // From Illuminate\Database\Eloquent\Model
    abstract public function getKey(): string;
    abstract public function getKeyName(): string;
    abstract public function getForeignKey(): string;

    // From Illuminate\Database\Eloquent\Concerns\HasRelationships
    abstract protected function newRelatedInstance($class): mixed;
}
