<?php
namespace Sanitize;

use Sanitize\AbstractSanitizeFilter;

abstract class AbstractSanitizeFilterOptions extends AbstractSanitizeFilter implements ISanitizeReset {
	private $options = array();
	
	function addOption($option) {
		$this->options[ $option ] = $option;
	}
	
	function reset() {
		$this->options = array();
		$this->flags = array();

		return $this;
	}
}