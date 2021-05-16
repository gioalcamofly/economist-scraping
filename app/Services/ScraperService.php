<?php
namespace App\Services;

use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class ScraperService {
    
    /**
     * Make a call to to specified url and return formatted data
     * 
     * @param string $url
     * 
     * @return array
     */
    public function scrapList($url) {
        
        $client  = new Client(HttpClient::create(['timeout' => 60]));
        $crawler = $client->request('GET', $url);
       
        //Get the job title
        $titles = $crawler->filter('.teaser__text h3')->each(function ($node) {
            return $node->text();
        });

        $descriptions = $crawler->filter('.teaser__text p')->each(function($node) {
            return $node->text();
        });

        $links = $crawler->filter('.teaser__text h3 > a')->each(function($node) {
            return $node->attr('href');
        });
        
        return compact('titles', 'descriptions', 'links');
    }

    public function scrapArticle($url) {

        $client  = new Client(HttpClient::create(['timeout' => 60]));
        $crawler = $client->request('GET', $url);
        
        $title = $crawler->filter('.article__headline')->each(function ($node) {
            return $node->text();
        })[0];

        $description = $crawler->filter('.article__description')->each(function ($node) {
            return $node->text();
        })[0];

        $body = $crawler->filter('.article__body-text')->each(function ($node) {
            return $node->text();
        });

        return compact('title', 'description', 'body');
    }
}