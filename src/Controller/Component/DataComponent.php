<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use PhpParser\Node\Stmt\TryCatch;
use Cake\ORM\Locator\LocatorAwareTrait;


class DataComponent extends Component
{
    public $components = array('Session');


    public function fetch($url, $to_arr = 1)
    {
        if (function_exists('curl_exec')) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.80 Safari/537.36');
            $response = curl_exec($ch);
        }
        if (empty($response)) {
            try {
                $response = @file_get_contents($url);
            } catch (\Throwable $th) {
                
            }
        }
        if ($to_arr == 1) {
            return json_decode($response, true);
        } 
    }


    public function getUser($id = null)
    {
        if (!empty($id)) {
            $tbl = TableRegistry::get('Users');
            try {
                $query = $tbl->find('all', ['contain'=>['Profiles'],'conditions' => ['Users.id' => $id]]);
                return $query->first();
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    
}
