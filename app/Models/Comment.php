<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends \Actuallymab\LaravelComment\Models\Comment
{
    protected $table = 'comments';

    public function commented()
    {
        return parent::commented(); // TODO: Change the autogenerated stub
    }
}
