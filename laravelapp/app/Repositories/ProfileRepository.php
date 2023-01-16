<?php

namespace App\Repositories;

use App\Models\Profile as Model;

/**
 * Class ProfileRepository.
 */
class ProfileRepository extends CoreRepository
{
    /**
     * @return string
     *  Return the model
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param int $id
     * @return Model
     */
    public function getEdit($id){
        return $this->startConditions()->find($id);
    }

    public function getAllWithPaginate($perPage = null){
        $columns = ['id','user_id','last_name','name','middle_name'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->paginate($perPage);
        return $result;
    }
}
