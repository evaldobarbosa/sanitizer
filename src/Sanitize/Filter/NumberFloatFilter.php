<?php
namespace Sanitize\Filter;

use Sanitize\AbstractSanitizeFilterOptions;

class NumberFloatFilter extends AbstractSanitizeFilterOptions {
	function getCurrent() {
		return FILTER_SANITIZE_NUMBER_FLOAT;
	}

	function fraction() {
		$this->addFlag( FILTER_FLAG_ALLOW_FRACTION );

		return $this;
	}

	function thousand() {
		$this->addFlag( FILTER_FLAG_ALLOW_THOUSAND );

		return $this;
	}

	function scientific() {
		$this->addFlag( FILTER_FLAG_ALLOW_SCIENTIFIC );

		return $this;
	}
}