<?php

namespace Awesovel\Defaults;

use Awesovel\Helpers\Parse;
use Awesovel\Helpers\Path;
use Awesovel\Provider;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{

    /**
     * @var string
     */
    protected $connection = 'mysql';
    /**
     *
     * @var type
     */
    protected $_items;

    /**
     *
     * @param type $module
     * @param type $entity
     * @param array $attributes
     */
    public function __construct($module = null, $entity = null, array $attributes = [])
    {

        parent::__construct($attributes);

        $this->connection = awesovel_config('database');

        if ($module && $entity) {

            $this->scaffold($module, $entity);
        }
    }

    /**
     *
     * @param type $module
     * @param type $entity
     */
    public function scaffold($module, $entity)
    {

        $scaffold = Parse::scaffold($module, $entity);

        $this->_items = $scaffold->items;

        foreach ($scaffold->extends as $property => $value) {
            $this->$property = $value;
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

        foreach ($this->_items as $item) {
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
        foreach ($instance->_items as $item) {
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
                break;
            case 'many-to-one':

                return $this->belongsTo($related, $relationship->key, $relationship->local);
            default:
                break;
        }
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->_items;
    }

}
