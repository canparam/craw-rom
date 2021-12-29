<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TemplateService;
use http\Client\Request;

class TemplateController extends  Controller
{
    private $templateService;
    public function __construct(TemplateService $templateService)
    {
        $this->templateService = $templateService;
    }
    public function search(Request $request){

    }
    public function create(Request $request){

    }
    public function edit(Request $request){

    }
}
