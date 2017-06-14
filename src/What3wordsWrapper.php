<?php

namespace Piffek\What3words;
use Piffek\What3words\ClientInterface;

class What3wordsWrapper implements ClientInterface
{
	
	public function wordsToCoords($words, $language = 'en'){
		
		
	}
	
	public function coordsToWords($lat, $lng, $language = 'en'){
		
	}
	
	public function getLanguages(){
		
	}
	
	public function getBlend($words, array $nearby = null){
		
	}
	
	public function autosuggest($words, array $nearby = null, $radius = 10){
		
	}
	
}