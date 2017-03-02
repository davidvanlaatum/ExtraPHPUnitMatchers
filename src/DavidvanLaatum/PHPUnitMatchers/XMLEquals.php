<?php
namespace DavidvanLaatum\PHPUnitMatchers;

use PHPUnit_Util_XML;
use SebastianBergmann\Comparator\ComparisonFailure;

class XMLEquals extends \PHPUnit_Framework_Constraint_IsEqual {
    public function __construct($expected) {
        parent::__construct(self::toDOMDocument($expected));
    }

    protected function fail($other, $description, ComparisonFailure $comparisonFailure = null) {
        parent::fail(self::toDOMDocument($other), $description, $comparisonFailure);
    }

    protected static function toDOMDocument($value) {
        if (is_string($value)) {
            return PHPUnit_Util_XML::load($value);
        }
        return $value;
    }

    public function evaluate($other, $description = '', $returnResult = false) {
        return parent::evaluate(self::toDOMDocument($other), $description, $returnResult);
    }

    protected function additionalFailureDescription($other) {
        return parent::additionalFailureDescription(self::toDOMDocument($other));
    }

    protected function failureDescription($other) {
        try {
            $this->evaluate($other);
            // @codeCoverageIgnoreStart
            return parent::failureDescription($other);
            // @codeCoverageIgnoreEnd
        } catch (\PHPUnit_Framework_ExpectationFailedException $ex) {
            $x = ($ex->getComparisonFailure() ? : $ex);
            return $x->toString();
        }
    }

    protected function matches($other) {
        return parent::matches(self::toDOMDocument($other));
    }
}
