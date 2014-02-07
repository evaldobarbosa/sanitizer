<?php
namespace Sanitize\Filter;

use Sanitize\AbstractSanitizeFilter;

class NumberIntFilter extends AbstractSanitizeFilter {
	function getCurrent() {
		return FILTER_SANITIZE_NUMBER_INT;
	}
}