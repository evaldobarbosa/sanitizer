<?php
namespace Sanitize\Filter;

use Sanitize\AbstractSanitizeFilter;

class MagicQuotesFilter extends AbstractSanitizeFilter {
	function getCurrent() {
		return FILTER_SANITIZE_MAGIC_QUOTES;
	}
}