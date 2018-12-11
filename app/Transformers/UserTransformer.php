<?php
/**
 * Created by PhpStorm.
 * User: lvhuan
 * Date: 2018/12/10
 * Time: 19:38
 */

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user){
        return [
            'id' => $user['id'],
            'name' => $user['name']
        ];
    }
}
