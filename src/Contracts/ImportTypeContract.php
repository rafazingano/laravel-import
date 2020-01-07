<?php

namespace ConfrariaWeb\Import\Contracts;

interface ImportTypeContract
{

    public function all();

    public function create(array $data);

    public function destroy($id);

    public function find($id);

    public function findBy($field, $value);

    public function update(array $data, $id);

    public function where(array $data);
}
