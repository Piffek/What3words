<?php

namespace Piffek\What3words;
use Piffek\What3words\ClientInterface;

class What3wordsWrapper implements ClientInterface
{
	protected $key;
	protected $lan = array();
	
	const ENDPOINT = 'https://api.what3words.com/v2';
	
	public function __construct(string $key){
		
		$this->key = $key;
		
	}

	
	public function wordsToCoords($words, $language = 'en') : array{
		
		$url = self::ENDPOINT . "/forward?addr=%s&key=%s&lang=%s&format=json&display=full";

		$sprintURL = sprintf($url, $words, $this->key, $language);
		
		$coords= $this->curlOptions($sprintURL);
		
		return $this->validateMethod($coords, 'geometry', $language);
		
	}
	
	public function coordsToWords($lat, $lng, $language = 'en') : string{

		//$this->hasLanguage($language);
		
		$url = self::ENDPOINT . '/reverse?coords=%s,%s&key=%s&lang=%s&format=json&display=full';
		
		$sprintURL = sprintf($url, $lat, $lng, $this->key, $language);
		
		$word = $this->curlOptions($sprintURL);
		
		return $this->validateMethod($word, 'words', $language);
		
	}
	
	public function getLanguages() : array{
		
		$url = 'https://api.what3words.com/v2/languages?key=%s';
		
		$sprintURL = sprintf($url, $this->key);
		
		return $this->curlOptions($sprintURL);
		
	}
	
	public function getBlend($words, array $nearby = null) : array{
		
		$url = self::ENDPOINT . '/standardblend?addr=%s&lang=en&focus=%s,%s&format=json&key=%s';
		
		$sprintURL = sprintf($url, $words, $nearby['0'], $nearby['1'], $this->key);
		
		return $this->curlOptions($sprintURL);
	}
	
	public function autosuggest($words, array $nearby = null, $radius = 10) : array{
		
		$url = self::ENDPOINT . '/autosuggest?addr=%s&clip=radius(%s,%s,%s)&lang=en&key=%s';
		
		$sprintURL = sprintf($url, $words, $nearby['0'], $nearby['1'], $radius, $this->key);
		
		return $this->curlOptions($sprintURL);
		
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
		
		return json_decode($response, true);
	}
	
	
	private function hasLanguage($language){
		
		$allLanguages = $this->getLanguages();
		
		foreach ($allLanguages['languages'] as $lang){
			
			$this->lan[] = $lang['code'];
			
		}
			
		return $this->errorDuringLanguageNotFound($language);
		
	}
	
	private function errorDuringLanguageNotFound($language){
		
		if(!in_array($language, $this->lan)){
			
			throw new \Exception('Language not found');
			
		}
	}
	
	private function validateMethod($resource, $what, $language){
		
		if(isset($resource[$what])){
			
			return $resource[$what];
			
		}else if(!isset($resource['message'])){
			
			$this->hasLanguage($language);
			
		}else if(!isset($resource[$what])){
			
			throw new \Exception($resource['message']);
			
		}
		
	}
	
	
}