<?php namespace App\Controllers;

use Elasticsearch\ClientBuilder;

class Home extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}
    public function test2()
    {
        $host = "localhost";
        $port = 9200;
        $client = ClientBuilder::create()->build();
        $client->setHosts($host);
        $params = [
            'index' => 'bank',
            'id'=>'75',

            'body'  => ['city' => 'Limestone']
        ];

        $response = $client->index($params);
        print_r($response);
    }
}
	//--------------------------------------------------------------------

