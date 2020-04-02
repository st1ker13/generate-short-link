<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Generate extends Model
{
    protected $table = 'generates';

    protected $guarded = [];

    const LENGTH_TOKEN = 6;
    const DEFAULT_EXCEPTION_MESSAGE = 'pls. try again';
    const LINK_NOT_FOUND = 'sorry. link not found';

    public static function generateToken($length = self::LENGTH_TOKEN)
    {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}
