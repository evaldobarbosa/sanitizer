<?php
namespace Sanitize\Filter;

use Sanitize\AbstractSanitizeFilterOptions;

class SpecialCharsFilter extends AbstractSanitizeFilterOptions {
	function getCurrent() {
		return FILTER_SANITIZE_SPECIAL_CHARS;
	}

	function stripped() {
		$this->low()->high();

		return $this;
	}

	function low() {
		$this->addFlag( FILTER_FLAG_STRIP_LOW );

		return $this;
	}

	function high() {
		$this->addFlag( FILTER_FLAG_STRIP_HIGH );

		return $this;
	}

	function encodeHigh() {
		$this->addFlag( FILTER_FLAG_ENCODE_HIGH );

		return $this;
	}

	function full($encode=true) {
		$this->Filter = FILTER_SANITIZE_SPECIAL_CHARS;
		$this->flags = array();

		if ( !$encode ) {
			$this->addFlag( FILTER_SANITIZE_FULL_SPECIAL_CHARS );
		}

		return $this;
	}
	
	function reset() {
		parent::reset();
		
		$this->flags = array();
		
		return $this;
	}
}