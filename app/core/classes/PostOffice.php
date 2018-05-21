<?php
/**
 * Basic stub for storing database entities in their appropriate class
 */

use App\Models\Model;

class PostOffice extends Model
{
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