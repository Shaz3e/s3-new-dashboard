<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Shaz3e\EmailBuilder\App\Models\GlobalEmailTemplate as ModelsGlobalEmailTemplate;

class GlobalEmailTemplate extends ModelsGlobalEmailTemplate
{
    use SoftDeletes;
}
