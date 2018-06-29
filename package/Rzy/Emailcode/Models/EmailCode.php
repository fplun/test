<?php

namespace Rzy\Emailcode\Models;

use Illuminate\Database\Eloquent\Model;

class EmailCode extends Model
{
    const STATUS_UNUSED = 0;
    const STATUS_USED = 1;

    protected $table = 'email_code';
}
