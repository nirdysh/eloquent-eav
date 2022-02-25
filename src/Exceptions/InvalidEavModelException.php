<?php
namespace Nirdysh\EloquentEav\Exceptions;

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
     * The relationship type.
     *
     * @var string
     */
    public string $type;

    /**
     * Create a new exception instance.
     *
     * @param  object  $model
     * @param  bool    $attribute
     * @return static
     */
    public static function make(object $model, bool $attribute = true)
    {
        $class = get_class($model);
        $type = $attribute ? 'attribute' : 'model';

        $instance = new static("Undefined EAV '{$type}' model on [{$class}].");

        $instance->model = $class;
        $instance->type = $type;

        return $instance;
    }
}