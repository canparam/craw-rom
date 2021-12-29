<?php

namespace App\Services;

use App\Models\Template;
use App\Services\Base\BaseRepository;

class TemplateService extends BaseRepository
{

    public function model()
    {
        // TODO: Implement model() method.
        return Template::class;
    }
}
