<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Shaz3e\EmailBuilder\App\Models\EmailTemplate as ModelsEmailTemplate;

class EmailTemplate extends ModelsEmailTemplate
{
    use SoftDeletes;
}
