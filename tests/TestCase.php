<?php
namespace Tests;

abstract class TestCase
{
    protected function signIn($user = null){
        $user = $user ?: create('App\User');
        $this->actingAs($user);
        return $this;
    }
}