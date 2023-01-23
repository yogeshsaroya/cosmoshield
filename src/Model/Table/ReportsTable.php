<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;


use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Validation\Validator;



class ReportsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        // adding model validation for fields
        $validator

            ->requirePresence("domain")
            ->notEmptyString("domain", "Domain name is required")
            ->add("domain", [
                'unique' => ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Domain name is already submitted'],
            ]);
        return $validator;
    }

}
