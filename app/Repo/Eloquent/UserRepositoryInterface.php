<?php

namespace App\Repo\Eloquent;

interface UserRepositoryInterface
{
    public function create($data);

    public function update(array $data);

    public function findById($id);

    public function destroy($id);

    public function searchByName($name);
}
