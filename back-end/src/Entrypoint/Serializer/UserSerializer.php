<?php

use Fmb\Infra\Database\Entity\User;

class UserSerializer
{
    public static function serialize(mixed $users) {
        if(is_array($users)){
            return array_map(function (User $user) {
                return [
                    'id' => $user->getId(),
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'roles' => $user->getRoles(),
                ];
            }, $users);

        }
        if($users instanceof User){
            return [
                'id' => $users->getId(),
                'name' => $users->getName(),
                'email' => $users->getEmail(),
                'roles' => $users->getRoles(),
            ];
        }
        return [];
    }
}
