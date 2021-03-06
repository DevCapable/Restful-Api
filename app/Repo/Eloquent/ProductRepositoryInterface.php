<?php

namespace App\Repo\Eloquent;

interface ProductRepositoryInterface
{
    public function create(array $data);

    public function update(array $data);

    public function findById($id);

    public function destroy($id);

    public function searchByName($name);
}
