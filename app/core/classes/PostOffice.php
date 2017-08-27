<?php
/**
 * Basic stub for storing database entities in their appropriate class
 */

use App\Models\Model;

class PostOffice extends Model
{

    public $id;
    public $name;
    public $address;
    public $city;
    public $stateId;
    public $zipCode;
    public $createdAt;
    public $modifiedAt;
    public $state;
    public $packages;

    public function __construct()
    {
        // silence is golden
    }

    public function __sleep()
    {
        // silence is golden
    }

    public function __wakeup()
    {
        // silence is golden
    }

    public function state()
    {
        $this->state = State::find()
            ->where(['id'], ['='], [$this->stateId])
            ->get()->state;
    }

    public function hydrate()
    {
        $this->packages();
        $this->state();
    }

    private function packages()
    {
        $this->packages = Package::findAll()
            ->where(['postOfficeId'], ['='], [$this->id])
            ->get();
    }
}