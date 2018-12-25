<?php
namespace Snowplow\RefererParser;

class Referer
{
    /** @var string */
    protected $medium;

    /** @var string */
    protected $source;

    /** @var string|null */
    protected $searchTerm;

    protected function __construct()
    {}

    public static function createKnown($source, $medium, $searchTerm = null)
    {
        $referer = new self();
        $referer->source = $source;
        $referer->medium = $medium;
        $referer->searchTerm = $searchTerm;

        return $referer;
    }
	
	public static function createKnownByHost($refererParts)
	{
		$referer = new self();
		$referer->source = $refererParts['host'] ?: Source::UNKNOWN;
		
		return $referer;
	}
    
    public static function createUnknown()
    {
        $referer = new self();
		$referer->source = Source::UNKNOWN;

        return $referer;
    }

    public static function createInternal()
    {
        $referer = new self();
        $referer->source = Source::INTERNAL;

        return $referer;
    }

    public static function createInvalid()
    {
        $referer = new self();
        $referer->source = Source::INVALID;

        return $referer;
    }

    /** @return boolean */
    public function isValid()
    {
        return $this->source !== Source::INVALID;
    }

    /** @return boolean */
    public function isKnown()
    {
        return !in_array($this->source, [Source::UNKNOWN, Source::INTERNAL, Source::INVALID], true);
    }
    
    /** @return string */
    public function getMedium()
    {
        return $this->medium;
    }

    public function getSource()
    {
        return $this->source;
    }

    public function getSearchTerm()
    {
        return $this->searchTerm;
    }
}
