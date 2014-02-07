<?php
namespace Sanitize;

abstract class AbstractSanitizeFilterStrict extends AbstractSanitizeFilter implements ISanitizeReset {
	protected $strict = false;

	function strict() {
		$this->strict = true;

		return $this;
	}

	function reset() {
		$this->strict = false;

		return $this;
	}
}