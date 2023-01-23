<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\ORM\TableRegistry;

class DataHelper extends Helper
{


    public function getLastMsg($id = null)
    {
        if (!empty($id)) {
            $tbl = TableRegistry::get('Messages');
            try {
                $data = $tbl
                    ->find()
                    ->where(['Messages.user_id' => $id])
                    ->order(['Messages.created' => 'desc'])
                    ->first();
                if(isset($data->message)){
                    return $data->message;
                }    
            } catch (\Throwable $th) { }
        }
    }
}
