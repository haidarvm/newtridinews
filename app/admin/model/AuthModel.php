<?php

namespace app\admin\model;

use support\Model;

class AuthModel extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    // public $timestamps = true;
    // const UPDATED_AT = 'last_login';

    public function login($username, $pass) {
        // return  $this->where([['user_login', '=', $username], ['user_pass', '=', $pass]])->get();
        return $this->where(['user_login' => $username, 'user_pass' => sha1($pass)])->first();
    }


}
