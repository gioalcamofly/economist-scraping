<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ScraperService;

class ScraperController extends Controller
{

    public function getNewsList(ScraperService $scraperService) {

        $url = getenv('ECONOMIST_WEBSITE');
        $rawData = $scraperService->scrapList($url);

        $parsedData = [];
        foreach ($rawData['titles'] as $key => $title) {
            $rawData['links'][$key] = str_replace($url, '/', $rawData['links'][$key]);
            array_push($parsedData, array(
                'title' => $title, 
                'description' => $rawData['descriptions'][$key],
                'link' => $rawData['links'][$key]
            ));
        }

        return response()->json(
            $parsedData,
            200
        );

    }

    public function getArticle($articleUrl, ScraperService $scraperService) {

        $url = getenv('ECONOMIST_WEBSITE');
        $rawData = $scraperService->scrapArticle($url . '/' . $articleUrl);

        return response()->json(
            $rawData,
            200
        );

    }

}
