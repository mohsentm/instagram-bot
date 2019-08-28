<?php


namespace App\Repositories;

interface RepositoryContract
{
    public function load($object);
    public function all($columns = array('*'));
    public function paginate($perPage = 25, $columns = array('*'));
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
    public function find(int $id, $columns = array('*'));
    public function findBy($field, $value, $columns = array('*'));
}