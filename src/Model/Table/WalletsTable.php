<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;


use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Validation\Validator;



class WalletsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
        $this->hasMany('Unbondings');
        $this->belongsTo('Users');
    }

    public function validationDefault(Validator $validator): Validator
    {
        // adding model validation for fields
        $validator
            ->requirePresence("name")
            ->notEmptyString("name", "Name to identify this wallet is required")

            ->requirePresence("seed")
            ->notEmptyString("seed", "Seed or private key is required")
            ;
           
        return $validator;
    }
}
