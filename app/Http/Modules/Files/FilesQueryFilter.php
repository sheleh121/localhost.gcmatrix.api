<?php

namespace App\Http\Modules\Files;

class FilesQueryFilter extends \App\Http\QueryFilter
{
    public array $filters = [
        'id',
        'name',
    ];
}
