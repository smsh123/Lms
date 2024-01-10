<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class BaseModel extends Eloquent
{
    /**
     * The name of the collection.
     *
     * @var string
     */
    protected $collection;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['*'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setCollectionName();
    }

    /**
     * Set the collection name for the model.
     */
    protected function setCollectionName()
    {
        if (empty($this->collection)) {
            $this->collection = $this->getTable();
        }
    }

    public  static function getAlldWithFields($fields = [])
    {
        $result = self::all($fields);
        return is_object($result) ? $result->toArray() : $result;
    }

    public  static function getByIdWithFields($id, $fields = [])
    {
        $result = self::where('_id', $id)->first($fields);
        return is_object($result) ? $result->toArray() : $result;
    }
    public static function searchByFields($fields = [])
    {
        $result = [];
        if (!empty($fields)) {
            $query = self::query();

            foreach ($fields as $field => $value) {
                $query->where($field, 'regex', "/$value/i");
            }
            $result = $query->get();
        }
        return is_object($result) ? $result->toArray() : $result;
    }
    public static function paginateWithDefault($limit = 10, $columns = ['*'])
    {
        return static::paginate($limit, $columns);
    }
}
