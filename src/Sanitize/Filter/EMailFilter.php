<?php
namespace Sanitize\Filter;

use Sanitize\AbstractSanitizeFilterStrict;

class EMailFilter extends AbstractSanitizeFilterStrict {
	function getCurrent() {
		return FILTER_SANITIZE_EMAIL;
	}

	function sanitize($value) {
		if ( !$this->strict ) {
			return parent::sanitize($value);
		} else {
			return preg_replace('([^0-9a-z_@\.]+)','',$value);
		}
	}
}