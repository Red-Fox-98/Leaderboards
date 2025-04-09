<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class SessionFilter extends ModelFilter
{
    public function mapName(string $mapName)
    {
        return $this->where('map_name', $mapName);
    }
    public function isRecord(bool $isRecord)
    {
        return $this->where('is_record', $isRecord);
    }
}
