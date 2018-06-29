<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    const STATUS_UNREAD = 0;
    const STATUS_READED = 1;
}
