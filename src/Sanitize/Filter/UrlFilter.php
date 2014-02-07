<?php
namespace Sanitize\Filter;

use Sanitize\AbstractSanitizeFilterStrict;

class UrlFilter extends AbstractSanitizeFilterStrict {
	function getCurrent() {
		return FILTER_SANITIZE_URL;
	}

	function sanitize($value) {
		if ( !$this->strict ) {
			return parent::sanitize($value);
		} else {
			$matches = parse_url($value);
				
			$regex = '/([a-z0-9]+\.[a-z0-9]+\.[a-z0-9]{2,3}|[a-z0-9]+\.[a-z0-9]+\.[a-z0-9]{2,4}[\.]{1}[a-z0-9]{2})$/';
			if ( !isset($matches['host']) ) {
				throw new \Exception('You do not have url');
			}
				
			$host = preg_replace('([^0-9a-z_\.\-]+)','',$matches['host']);
			$value = str_replace( $matches['host'], $host, $value );
				
			if ( isset($matches['uri']) ) {
				$uri = preg_replace('([^$-_\.\+!\*\'\(\),{}\|\\\^~\[\]`"><\#%;/\?:@&=]+)','',$matches['uri']);
				$value = str_replace( $matches['uri'], $uri, $value );
			}
				
			return $value;
		}
	}
}