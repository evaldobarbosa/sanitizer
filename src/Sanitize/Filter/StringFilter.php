<?php
namespace Sanitize\Filter;

use Sanitize\AbstractSanitizeFilterOptions;

class StringFilter extends AbstractSanitizeFilterOptions {
	function getCurrent() {
		return FILTER_SANITIZE_STRING;
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

	function encodeLow() {
		$this->addFlag( FILTER_FLAG_ENCODE_LOW );

		return $this;
	}

	function encodeHigh() {
		$this->addFlag( FILTER_FLAG_ENCODE_HIGH );

		return $this;
	}

	function encodeAmp() {
		$this->addFlag( FILTER_FLAG_ENCODE_AMP );

		return $this;
	}

	function noEncode() {
		$this->addFlag( FILTER_FLAG_NO_ENCODE_QUOTES );

		return $this;
	}
}