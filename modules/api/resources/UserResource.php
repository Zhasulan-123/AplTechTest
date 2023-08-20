<?php

namespace app\modules\api\resources;


use app\models\User;

/**
 * Class UserResource
 *
 * @author Zhasulan Moldakulov <87028987788@mail.ru>
 * @package app\modules\api\resources
 */
class UserResource extends User
{
    public function fields()
    {
        return [
            'id', 'username', 'access_token'
        ];
    }
}