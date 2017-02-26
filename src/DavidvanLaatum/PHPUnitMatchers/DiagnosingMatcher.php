<?php
namespace DavidvanLaatum\PHPUnitMatchers;

abstract class DiagnosingMatcher extends \PHPUnit_Framework_Constraint {

    /**
     * {@inheritDoc}
     */
    protected final function matches($other) {
        list($matches, $description) = $this->matchesWithDescription($other);
        return $matches;
    }

    protected abstract function matchesWithDescription($other);

    /**
     * {@inheritDoc}
     */
    protected function failureDescription($other) {
        list($matches, $description) = $this->matchesWithDescription($other);
        return $description;
    }
}
