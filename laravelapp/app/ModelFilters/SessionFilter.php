<?php

namespace App\ModelFilters;

use App\Models\Session;
use EloquentFilter\ModelFilter;

class SessionFilter extends ModelFilter
{
    public function mapName($map_name)
    {
        return $this->where('map_name', $map_name);
    }
}
