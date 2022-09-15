<?php

namespace App\Transformers;

use App\Models\File;
use Flugg\Responder\Transformers\Transformer;

class FileTransformer extends Transformer
{
    public function transform(File $file): array
    {
        return [
            'id' => $file->id,
            'name' => $file->name,
            'path' => $file->path,
        ];
    }
}
