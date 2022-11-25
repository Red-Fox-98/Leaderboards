<?php

namespace App\ModelFilters;

use App\Models\Session;
use EloquentFilter\ModelFilter;

class SessionFilter extends ModelFilter
{
    public function mapName(string $mapName)
    {
        return $this->where('map_name', $mapName);
    }
}
