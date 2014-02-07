<?php
namespace Sanitize;

class Sanitizer {
	static $instance;
	protected $filters = array();
	
	static function init() {
		if (!isset(self::$instance)) {
			$c = __CLASS__;
			self::$instance = new $c;
		}
		
		return self::$instance;
	}
	
	static function add( $Filter, $name ) {
		self::init();
		
		switch ($Filter) {
			case "string":
			default:
				self::$instance->filters[$name] = new Filter\StringFilter();
				return self::$instance->filters[$name];
				break;
			case "email":
				self::$instance->filters[$name] = new Filter\EMailFilter();
				return self::$instance->filters[$name];
				break;
			case "url":
				self::$instance->filters[$name] = new Filter\UrlFilter();
				return self::$instance->filters[$name];
				break;
			case "quotes":
				self::$instance->filters[$name] = new Filter\MagicQuotesFilter();
				return self::$instance->filters[$name];
				break;
			case "int":
				self::$instance->filters[$name] = new Filter\NumberIntFilter();
				return self::$instance->filters[$name];
				break;
			case "float":
				self::$instance->filters[$name] = new Filter\NumberFloatFilter();
				return self::$instance->filters[$name];
				break;
			case "phone":
				self::$instance->filters[$name] = new Filter\PhoneFilter();
				return self::$instance->filters[$name];
				break;
			case "chars":
				self::$instance->filters[$name] = new Filter\SpecialCharsFilter();
				return self::$instance->filters[$name];
				break;
		}
	}
	
	function getFilter($name) {
		return $this->filters[$name];
	}
}