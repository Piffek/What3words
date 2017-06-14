<?php

namespace Piffek\What3words;

interface Client
{
    /**
     * Translate 3-word address to array of lat & lng coordinates (AKA forward geocoding).
     * @link https://docs.what3words.com/api/v2/#forward
     *
     * @param  string $words     What3words address in specified language
     * @param  string $language  ISO 639-1 2 letter code @see self::getLanguages
     *
     * @return array          ['lat' => LATITUDE, 'lng' => LONGITUDE]
     */
    public function wordsToCoords($words, $language = 'en') : array;

    /**
     * Translate coordinates to 3-word address (AKA reverse geocoding).
     * @link https://docs.what3words.com/api/v2/#reverse
     *
     * @param  float $lat
     * @param  float $lng
     * @param  string $language  ISO 639-1 2 letter code @see self::getLanguages
     *
     * @return string
     */
    public function coordsToWords($lat, $lng, $language = 'en') : string;

    /**
     * Get list of supported languages.
     * @link https://docs.what3words.com/api/v2/#lang
     *
     * @return array
     */
    public function getLanguages() : array;

    /**
     * Get blend of 3 most relevant locations given partial 3-word address and optionally focus location.
     * @link https://docs.what3words.com/api/v2/#standardblend
     *
     * @param  string $words
     * @param  array $nearby  ['lat' => LATITUDE, 'lng' => LONGITUDE]
     *
     * @return array
     */
    public function getBlend($words, array $nearby = null) : array;

    /**
     * Get autosuggest of up to 100 locations given partial 3-word address and optionally focus location & radius [km].
     * @link https://docs.what3words.com/api/v2/#autosuggest
     *
     * @param  string $words
     * @param  array $nearby  ['lat' => LATITUDE, 'lng' => LONGITUDE]
     * @param  int $radius    Radius from the nearby point in km
     *
     * @return array
     */
    public function autosuggest($words, array $nearby = null, $radius = 10) : array;
}
