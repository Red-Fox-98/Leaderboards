<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
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

//    /**
//     * @return array
//     */
//    public function getForComboBox(){
//        $columns = implode(', ', [
//            'last_name',
//            'name',
//            'middle_name',
//            'CONCAT (last_name, " ", name, " ", middle) AS full_name'
//        ]);
//
//        $result = $this
//            ->startConditions()
//            ->selectRaw($columns)
//            ->get();
//
//        return $result;
//    }

    public function getAllWithPaginate($perPage = null){
        $columns = ['id','user_id','last_name','name','middle_name'];

        $result = $this
            ->startConditions()
            ->select($columns)
//            ->with([
//                'parentCategory:id,title',
//            ])
            ->paginate($perPage);
        return $result;
    }
}
