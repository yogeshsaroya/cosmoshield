<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;


use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Validation\Validator;



class UnbondingsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        // adding model validation for fields
        $validator
            ->requirePresence("wallet_address")
            ->notEmptyString("wallet_address", "Wallet address is required")

            ->requirePresence("coin")
            ->notEmptyString("coin", "Coin is required")

            ->requirePresence("wallet_id")
            ->notEmptyString("wallet_id", "Associated key/seed is required")
            ;
           
        return $validator;
    }
}
