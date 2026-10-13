<?php

namespace app\admin\model;

use support\Model;

class UserModel extends Model {
   
    protected $table = 'users';

   
    protected $primaryKey = 'ID';
    
    public function getAllUser(){
        return $this->get();
    }


}