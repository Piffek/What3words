<?php 

namespace Wrapper\What3words\What3wordsWrapper;

use Wrapper\What3words\W3wOld\Geocoder;

class What3wordsWrapper{
	
	protected $geocoder;
	protected $key;
	
	public function __construct($key){
	
		$this->geocoder = new Geocoder($key);
		
	}
	
	public function get(){
		
		return $this->geocoder;
		
	}
	
}