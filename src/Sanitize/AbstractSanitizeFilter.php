<?php
namespace Sanitize;

abstract class AbstractSanitizeFilter {
	protected $filter;
	protected $flags = array();
	
	function addFlag($flag) {
		$this->flags[ $flag ] = $flag;
	}
	
	function getFlags() {
		$sum = 0;
		foreach ( $this->flags as $flag ) {
			$sum += $flag;
		}
	
		return $sum;
	}

	abstract function getCurrent();
	
	function sanitize($value) {
		return filter_var(
			$value,
			$this->filter,
			$this->getFlags()
		);
	}

	function __construct() {
		$this->filter = $this->getCurrent();
	}

	function getFilter() {
		return $this->filter;
	}
}