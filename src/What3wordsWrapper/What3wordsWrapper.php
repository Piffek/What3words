<?php 

namespace Wrapper\What3words\What3wordsWrapper;

use Wrapper\What3words\W3wOld\Geocoder;

class What3wordsWrapper{
	
	protected $geocoder;
	
	public function __construct(Geocoder $geocoder){
		
		$this->geocoder = $geocoder;
		
	}
	
	public function get(){
		
		return $this->geocoder;
		
	}
	
}