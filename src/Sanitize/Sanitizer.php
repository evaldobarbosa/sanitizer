<?php
namespace Infra\Sanitize;

class Sanitizer {
	static $instance;
	private $roles = array();
	
	static function init() {
		if (!isset(self::$instance)) {
			$c = __CLASS__;
			self::$instance = new $c;
		}
		
		return self::$instance;
	}
	
	static function add( $role, $name ) {
		self::init();
		
		switch ($role) {
			case "string":
			default:
				self::$instance->roles[$name] = new StringRole();
				return self::$instance->roles[$name];
				break;
			case "email":
				self::$instance->roles[$name] = new EMailRole();
				return self::$instance->roles[$name];
				break;
			case "url":
				self::$instance->roles[$name] = new UrlRole();
				return self::$instance->roles[$name];
				break;
			case "quotes":
				self::$instance->roles[$name] = new MagicQuotesRole();
				return self::$instance->roles[$name];
				break;
			case "int":
				self::$instance->roles[$name] = new NumberIntRole();
				return self::$instance->roles[$name];
				break;
			case "float":
				self::$instance->roles[$name] = new NumberFloatRole();
				return self::$instance->roles[$name];
				break;
			case "phone":
				self::$instance->roles[$name] = new PhoneRole();
				return self::$instance->roles[$name];
				break;
		}
	}
	
	function getRole($name) {
		return $this->roles[$name];
	}
}

abstract class AbstractSanitizeRole {
	protected $role;
	private $flags = array();
	private $options = array();
	
	abstract function setRole();
	
	function __construct() {
		$this->setRole();
	}
	
	function getRole() {
		return $this->role;
	}
	
	function addFlag($flag) {
		$this->flags[ $flag ] = $flag;
	}
	
	function addOption($option) {
		$this->options[ $option ] = $option;
	}
	
	function getFlags() {
		$sum = 0;
		foreach ( $this->flags as $flag ) {
			$sum += $flag;
		}
		
		return $sum;
	}
	
	function sanitize($value) {
		return filter_var(
			$value,
			$this->role,
			$this->getFlags()
		);
	}
}

class NumberIntRole extends AbstractSanitizeRole {
	function setRole() {
		$this->role = FILTER_SANITIZE_NUMBER_INT;
	}
}

class NumberFloatRole extends AbstractSanitizeRole {
	function setRole() {
		$this->role = FILTER_SANITIZE_NUMBER_FLOAT;
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

class UrlRole extends AbstractSanitizeRole {
	function setRole() {
		$this->role = FILTER_SANITIZE_URL;
	}
}

class EMailRole extends AbstractSanitizeRole {
	private $strict = false;
	
	function setRole() {
		$this->role = FILTER_SANITIZE_EMAIL;
	}
	
	function strict() {
		$this->strict = true;
		
		return $this;
	}
	
	function sanitize($value) {
		if ( !$this->strict ) {
			return parent::sanitize($value);
		} else {
			return preg_replace('([^0-9a-z_@\.]+)','',$value);
		}
	}
}

class MagicQuotesRole extends AbstractSanitizeRole {
	function setRole() {
		$this->role = FILTER_SANITIZE_MAGIC_QUOTES;
	}
}

class PhoneRole extends AbstractSanitizeRole {
	function setRole() {
		$this->role = 0;
	}
	
	function sanitize($value) {
		$regex = '/((([0-9]{0,2}[ \.\-\+]{0,1})[0-9]{0,2}[ \.\-]{0,1})[0-9]{4}[ \.\-]{0,1}[0-9]{4})$/';
		
		$matches = array();
		
		preg_match_all( $regex, $value, $matches );

		$value = preg_split("([ \-\.\+])", $matches[0][0]);
		
		return implode("",$value);
	}
}

class StringRole extends AbstractSanitizeRole {
	function setRole() {
		$this->role = FILTER_SANITIZE_STRING;
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

class SpecialCharsRole extends AbstractSanitizeRole {
	function setRole() {
		$this->role = FILTER_SANITIZE_SPECIAL_CHARS;
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

	function encodeHigh() {
		$this->addFlag( FILTER_FLAG_ENCODE_HIGH );

		return $this;
	}
	
	function full($encode=true) {
		$this->role = FILTER_SANITIZE_SPECIAL_CHARS;
		$this->flags = array();
		
		if ( !$encode ) {
			$this->addFlag( FILTER_SANITIZE_FULL_SPECIAL_CHARS );
		}
		
		return $this;
	}
}