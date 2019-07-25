<?php

namespace App\Repositories;

use App\Exceptions\RepositoryException;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository implements RepositoryContract
{
    protected $fillable = [];
    /**
     * @var Container
     */
    private $container;
    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $query;
    /**
     * BaseRepository constructor.
     *
     * @param Container $container
     * @throws RepositoryException
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->makeQuery();
    }
    /**
     * This method will fill the given $object by the given $array.
     * If the $fillable parameter is not available it will use the fillable
     * array of the class.
     *
     * @param array $data
     * @param Model $object
     * @param array $fillable
     * @return mixed
     */
    public function fill(array $data, $object, array $fillable = [])
    {
        if (empty($fillable)) {
            $fillable = $this->fillable;
        }
        if (!empty($fillable)) { // just fill when fillable array is not empty
            $object->fillable($fillable)->fill($data);
        }
        return $object;
    }
    /**
     * Load $object
     *
     * @param $object
     * @return mixed
     */
    public function load($object)
    {
        return $object;
    }
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    abstract function model();
    /**
     * Return all rows from table.
     *
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'))
    {
        return $this->load($this->query->get($columns));
    }
    /**
     * Return multi rows from table.
     *
     * @param int $perPage
     * @param array $columns
     * @return LengthAwarePaginator
     */
    public function paginate($perPage = 25, $columns = ['*'])
    {
        return $this->load($this->query->paginate($perPage, $columns));
    }
    /**
     * Save values in table.
     *
     * @param array $data
     * @param array $fillable
     * @return mixed
     * @throws RepositoryException
     */
    public function create(array $data, array $fillable = [])
    {
        $object = $this->fill($data, $this->makeModel(), $fillable);
        $object->save();
        return $object;
    }
    /**
     * Update values in table.
     *
     * @param array $data
     * @param Model|int $object
     * @param array $fillable
     * @return mixed
     */
    public function update(array $data, $object, array $fillable = [])
    {
        if (!($object instanceof Model)) {
            $object = $this->find($object);
        }
        $object = $this->fill($data, $object, $fillable);
        $object->save();
        return $object;
    }
    /**
     * Delete row from table.
     *
     * @param Model|int $object
     * @return bool|null
     * @throws \Exception
     */
    public function delete($object)
    {
        if (is_numeric($object)) {
            $object = $this->find($object)->first();
        }
        return $object->delete();
    }
    /**
     * Find a row from table.
     *
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find(int $id, $columns = array('*'))
    {
        return $this->load($this->query->find($id, $columns));
    }
    /**
     * Find by column and value from table.
     *
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*'))
    {
        return $this->load($this->query->where($attribute, '=', $value)->first($columns));
    }
    /**
     * Make query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws RepositoryException
     */
    public function makeQuery()
    {
        return $this->query = $this->makeModel()->newQuery();
    }

    /**
     * @return mixed
     * @throws RepositoryException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function makeModel()
    {
        $model = $this->container->make($this->model());
        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        return $model;
    }
}
