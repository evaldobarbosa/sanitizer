<?php
namespace Sanitize\Filter;

use Sanitize\AbstractSanitizeFilter;

class PhoneFilter extends AbstractSanitizeFilter {
	function getCurrent() {
		return 0;
	}

	function sanitize($value) {
		$matches = preg_split("([^0-9 \-\.\+])", $value);
		if ( count($matches) > 0 ) {
			$value = implode("",$matches);
		}

		$regex = '/((([0-9]{0,2}[ \.\-\+]{0,1})[0-9]{0,2}[ \.\-]{0,1})[0-9]{4}[ \.\-]{0,1}[0-9]{4})$/';

		$matches = array();

		preg_match_all( $regex, $value, $matches );

		if ( count($matches[0]) == 0 ) {
			throw new \Exception('You do not have a phone number');
		}

		$value = preg_split("([ \-\.\+])", $matches[0][0]);

		return implode("",$value);
	}
}