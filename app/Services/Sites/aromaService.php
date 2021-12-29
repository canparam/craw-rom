<?php

namespace App\Services\Sites;

use App\Services\HttpClientService;

class aromaService
{
    private $http;
    public function __construct(HttpClientService $httpClientService)
    {
        $this->http = $httpClientService;
    }

    public function getList($url = "")
    {

        $craw = $this->http->get($url);

        $data = $craw->filter('.pt-cv-title > a')->each(function ($node) {
            return [
                'title' => $node->text(),
                'href' => $node->attr('href')
            ];
        });
        return $data;
    }


    public function getLinkDownload($url)
    {
        $craw = $this->http->get($url);
        $des = $craw->filterXpath('//meta[@property="og:description"]')->attr('content');
        $tile = $craw->filter('title')->text();

        $links = $craw->filter('#main a')->each(function ($node) {
           $ads = $this->filterLink($node->filter('a'));
           return $ads;
        });
        $links = array_filter($links);
        $data = [
            'title' => $tile,
            'des' => $des,
            'link' => $links
        ];

        return $data;
    }

    protected function filterLink($craw)
    {
       if (strrpos($craw->attr('href'), '?url=')){
           $link = explode("=",$craw->attr('href'));
           $link = urldecode($link[1]);
           return [
               'title' => $craw->text(),
               'href'=> $link
           ];
       }
    }
}
