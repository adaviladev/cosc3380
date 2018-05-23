<?php

namespace App\Core;

use App\Core\Database\QueryBuilder;
use User;

class Auth
{
    /** @var User $user */
    protected $user;

    /**
     * @return bool
     */
    public static function user(): bool
    {
//            $_SESSION['user'] = serialize(User::find()->where(['id'],['='],[1])->get());
        return User::find()
                   ->where(['id'], ['='], [1])
                   ->get();
//			if( isset( $_SESSION[ 'user' ] ) ) {
//
//				return unserialize( $_SESSION[ 'user' ] );
//			}

        // $_SESSION[ 'user' ] = new User;
        return false;
    }

    public static function login(QueryBuilder $query)
    {
        // if( $user->username && $user->password ) {
        // }
        return $query->selectAll('users');
    }
}