<?php

namespace App\Http\Modules\Vendors;

class VendorsQueryFilter extends \App\Http\QueryFilter
{
    public array $filters = [
        'id',
        'name',
        'address',
        'email',
        'description',
        'files_count',
        'manufacturers_count'
    ];

    protected function files_count($value) {
        $this->builder->having('files_count', '=', $value);
    }

    protected function manufacturers_count($value) {
        $this->builder->having('manufacturers_count', '=', $value);
    }

    protected function address($value) {
        $this->builder->where('address', 'LIKE','%' . $value . '%');
    }
}
