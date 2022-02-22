<?php

namespace App\Repo\Eloquent;

interface UserRepositoryInterface
{
    public function create(array $data);

    public function update(array $data);

    public function findByEmail($data);

    public function destroy($id);

    public function searchByName($name);
}
