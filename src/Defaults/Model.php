<?php

namespace Awesovel\Defaults;

use Awesovel\Helpers\Config;
use Awesovel\Helpers\Path;
use Awesovel\Provider;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{

    /**
     *
     * @var type
     */
    protected $items = [];

    /**
     *
     * @param type $module
     * @param type $entity
     * @param array $attributes
     */
    public function __construct($module = null, $entity = null, array $attributes = [])
    {

        parent::__construct($attributes);

        if ($module && $entity) {
            $this->setConfig($module, $entity);
        }
    }

    /**
     *
     * @param type $module
     * @param type $entity
     */
    public function setConfig($module, $entity)
    {

        $config = Config::parse($module, $entity);

        foreach ($config as $prop => $value) {
            $this->$prop = $value;
        }
    }

    /**
     * Get a relationship.
     *
     * @param  string $key
     * @return mixed
     */
    public function getRelationValue($key)
    {

        $return = parent::getRelationValue($key);

        if (is_null($return)) {
            $return = $this->getRelationshipFromMethod($key);
        }

        return $return;
    }

    /**
     * Get all of the models from the database.
     *
     * @param  array|mixed $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function all($columns = ['*'])
    {

        if (func_num_args() === 0) {
            $columns = self::fields();
        }

        return parent::all($columns);
    }

    /**
     *
     * @param type $name
     * @param type $args
     * @return type
     */
    public function __call($name, $args)
    {

        foreach ($this->items as $item) {
            switch ($item->behavior) {
                case 'relationship':
                    if ($name === $item->relationship->method) {

                        return $this->relationshipDefaultModel($item);
                    }
                    break;
            }
        }

        return parent::__call($name, $args);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public static function get($id, $columns = ['*'])
    {

        if (func_num_args() === 1) {
            $columns = self::fields();
        }

        return parent::find($id, $columns);
    }

    /**
     *
     * @return array
     */
    protected static function fields()
    {

        $instance = new static;

        $fields = [];
        foreach ($instance->items as $item) {
            $retrieve = true;

            if (isset($item->dao)) {
                $retrieve = (bool)$item->dao->R;
            }

            if ($retrieve) {
                $fields[] = $item->id;
            }
        }

        return $fields;
    }

    /**
     *
     * @param type $item
     * @return type
     */
    public function relationshipDefaultModel($item)
    {

        $relationship = $item->relationship;
        $related = Path::name($relationship->module, $relationship->entity);
        $type = $relationship->type;

        switch ($type) {
            case 'one-to-one':

                return $this->hasOne($related, $relationship->key);
            case 'one-to-many':

                return $this->hasMany($related, $relationship->key, $relationship->local);
            default:
                break;
        }
    }

}
