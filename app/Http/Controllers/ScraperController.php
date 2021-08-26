<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

class ScraperController extends Controller
{

    private $result = array();

    public function index(){
        $client = new Client();
        $url = "https://www.worldometers.info/coronavirus/";
        $page = $client->request('GET',$url);

        // echo $page->filter('.maincounter-number')->text();

        $page->filter('#maincounter-wrap')->each(function($item){
            $this->result[$item->filter('h1')->text()] = $item->filter('.maincounter-number')->text();
        });

        $data = $this->result;

        return view('scraper',compact('data'));
    }
}
