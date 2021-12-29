<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\HttpClientService;
use App\Services\Sites\aromaService;
use App\Services\Sites\romproviderService;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    private $azromServicve;
    private $romproviderService;
    public function __construct(aromaService $azromServicve, romproviderService $romproviderService)
    {
        $this->azromServicve = $azromServicve;
        $this->romproviderService = $romproviderService;
    }


    public function list(Request $request)
    {

        $type = $request->type;
        $url = $request->site;
        $data = [];

        if ($type === HttpClientService::AZROM){
            $data =  $this->azromServicve->getList($url) ?? [];
        }elseif ($type === HttpClientService::ROMPROVIDER){
            $data =  $this->romproviderService->getList($url) ?? [];
        }
        return response(['status' => true, 'data' => $data]);
    }
    public function getLink(Request $request){
        $type = (int) $request->type;
        $url = $request->url;

        $data = [];
        if ($type === HttpClientService::AZROM){
            $data = $this->azromServicve->getLinkDownload($url) ?? [];
        }elseif ($type === HttpClientService::ROMPROVIDER){
            $data =  $this->romproviderService->getLinkDownload($url) ?? [];
        }
        return response(['status' => true, 'data' => $data]);
    }

}
