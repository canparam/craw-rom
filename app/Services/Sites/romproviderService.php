<?php

namespace App\Services\Sites;

use App\Services\HttpClientService;

class romproviderService
{
    private $http;
    private $list = ['mega.nz','drive.google.com','androidfilehost','terabox','sharepoint.com','motorola.com','1drv.ms'];
    public function __construct(HttpClientService $httpClientService)
    {
        $this->http = $httpClientService;
    }
    public function getList($url = "")
    {

        $craw = $this->http->get($url);

        $data = $craw->filter('.entry-title > a')->each(function ($node) {
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

        $links = $craw->filter('.td-main-content a')->each(function ($node) {
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
        if ($this->strposa($craw->attr('href'), $this->list, 1)) {
            return $craw->attr('href');
        }
    }
    private function strposa($haystack, $needles=array(), $offset=0) {
        $chr = array();
        foreach($needles as $needle) {
            $res = strpos($haystack, $needle, $offset);
            if ($res !== false) $chr[$needle] = $res;
        }
        if(empty($chr)) {
            return false;
        }
        return min($chr);
    }
}
