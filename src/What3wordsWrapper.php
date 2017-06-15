<?php

namespace Piffek\What3words;
use Piffek\What3words\ClientInterface;

class What3wordsWrapper implements ClientInterface
{
	protected $key;
	
	public function __construct(string $key){
		
		$this->key = $key;
		
	}

	
	public function wordsToCoords($words, $language = 'en') : array{

		$url = "https://api.what3words.com/v2/forward?addr=%s&key=%s&lang=%s&format=json&display=full";

		$sprintURL = sprintf($url, $words, $this->key, $language);
		
		$res = json_decode($this->curlOptions($sprintURL), true);

		return $res['geometry'];
		
	}
	
	public function coordsToWords($lat, $lng, $language = 'en') : string{

		$url = "https://api.what3words.com/v2/reverse?coords=%s,%s&key=%s&lang=%s&format=json&display=full";
		
		$sprintURL = sprintf($url, $lat, $lng, $this->key, $language);
		
		$word = json_decode($this->curlOptions($sprintURL), true);
		
		return $word['words'];
		
	}
	
	public function getLanguages() : array{
		
	}
	
	public function getBlend($words, array $nearby = null) : array{
		
	}
	
	public function autosuggest($words, array $nearby = null, $radius = 10) : array{
		
	}
	
	private function curlOptions($sprintURL){
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
				CURLOPT_URL => $sprintURL,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		return $response;
	}
	
}