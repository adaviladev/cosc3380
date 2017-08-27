<?php
    /**
     * Basic stub for storing database entities in their appropriate class
     */

    use App\Models\Model;

    class Package extends Model
    {

        public $id;
        public $userId;
        public $postOfficeId;
        public $typeId;
        public $destinationId;
        public $returnAddressId;
        public $contents;
        public $weight;
        public $priority;
        public $packageStatus;
        public $modifiedBy;
        public $createdAt;
        public $modifiedAt;
        public $user;
        public $destination;
        public $returnAddress;
        public $status;

        public function __construct()
        {
            // silence is golden
        }

        public function __sleep()
        {
            // silence is golden
            return [
                'id',
                'userId',
                'postOfficeId',
                'typeId',
                'transactionId',
                'destinationId',
                'returnAddressId',
                'contents',
                'weight',
                'priority',
                'packageStatus',
                'modifiedBy',
                'createdAt',
                'modifiedAt',
            ];
        }

        public function __wakeup()
        {
            // silence is golden
            return [
                'id',
                'userId',
                'postOfficeId',
                'typeId',
                'transactionId',
                'destinationId',
                'returnAddressId',
                'contents',
                'weight',
                'priority',
                'packageStatus',
                'modifiedBy',
                'createdAt',
                'modifiedAt',
            ];
        }

        private function user()
        {
            $this->user = User::find()
                              ->where(
                                  ['id'],
                                  ['='],
                                  [$this->userId]
                              )
                              ->get();
        }

        private function destination()
        {
            $this->destination        = Address::find()
                                               ->where(
                                                   ['id'],
                                                   ['='],
                                                   [$this->destinationId]
                                               )
                                               ->get();
            $this->destination->state = State::find()
                                             ->where(
                                                 ['id'],
                                                 ['='],
                                                 [$this->destination->stateId]
                                             )
                                             ->get()->state;
        }

        private function returnAddress()
        {
            $this->returnAddress        = Address::find()
                                                 ->where(
                                                     ['id'],
                                                     ['='],
                                                     [$this->returnAddressId]
                                                 )
                                                 ->get();
            $this->returnAddress->state = State::find()
                                               ->where(
                                                   ['id'],
                                                   ['='],
                                                   [$this->returnAddress->stateId]
                                               )
                                               ->get()->state;
        }

        private function status()
        {
            $this->status = PackageStatus::find()
                                         ->where(
                                             ['id'],
                                             ['='],
                                             [$this->packageStatus]
                                         )
                                         ->get()->type;
        }

        public function hydrate()
        {
            $this->user();
            $this->status();
            $this->destination();
            $this->returnAddress();
        }
    }