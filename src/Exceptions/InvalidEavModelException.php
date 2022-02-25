<?php

namespace Nirdysh\EloquentEav\Exceptions;

use Illuminate\Database\Eloquent\Model;
use RuntimeException;

class InvalidEavModelException extends RuntimeException
{
    /**
     * The name of the affected Eloquent model.
     *
     * @var string
     */
    public string $model;

    /**
     * The name of the related Eloquent model.
     *
     * @var string
     */
    public string $related;

    /**
     * The relationship type.
     *
     * @var string
     */
    public string $type;

    /**
     * Create a new exception instance.
     *
     * @param  object  $model
     * @param  string  $related
     * @param  bool    $attribute
     * @return static
     */
    public static function make(object $model, string $related, bool $attribute = true)
    {
        $class = get_class($model);
        $type = $attribute ? 'attribute' : 'model';
        $eloquent = Model::class;

        $instance = new static(
            "EAV '$type' model on [{$class}] is of type [{$related}], which is not a subclass of [{$eloquent}]."
        );

        $instance->model = $class;
        $instance->related = $related;
        $instance->type = $type;

        return $instance;
    }
}
