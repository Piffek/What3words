<?php
namespace Wrapper\What3words\Controllers;

use Wrapper\What3words\What3wordsWrapper\What3wordsWrapper;

class TestController
{
	public function index(){
		
		$options = [
				'key' => 'key',   // mandatory
				'timeout' => 10             // default: 10 secs
		];
		$params = [
				'lang' => 'en',         // ISO 639-1 2 letter code; default: en
				'display' => 'full',    // full or terse, default: full
				'format' => 'json'      // json, geojson or xml, default: json
		];
		$coords = [
				'lat' => 51.521251,
				'lng' => -0.203586
		];
		$what = new What3wordsWrapper($options);
		return $what->get()->reverseGeocode($coords, $params);
		
		//return view('views::index');
		
	}
	
	
}