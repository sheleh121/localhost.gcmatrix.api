<?php

namespace App\Http\Modules\Manufacturers;

class ManufacturersQueryFilter extends \App\Http\QueryFilter
{
    public array $filters = [
        'id',
        'name',
        'country',
        'city',
        'street',
        'email',
        'description',
        'files_count',
        'vendors_count'
    ];

    protected function files_count($value) {
        $this->builder->having('files_count', '=', $value);
    }

    protected function vendors_count($value) {
        $this->builder->having('vendors_count', '=', $value);
    }
}
