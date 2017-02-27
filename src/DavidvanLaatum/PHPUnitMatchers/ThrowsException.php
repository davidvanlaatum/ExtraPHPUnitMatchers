<?php
namespace DavidvanLaatum\PHPUnitMatchers;

class ThrowsException extends \PHPUnit_Framework_Constraint {
    /** @var \PHPUnit_Framework_Constraint */
    protected $exceptionMatcher;
    /** @var \Exception */
    protected $lastException;

    /**
     * ThrowsException constructor.
     * @param \PHPUnit_Framework_Constraint $exceptionMatcher
     */
    public function __construct(\PHPUnit_Framework_Constraint $exceptionMatcher) {
        parent::__construct();
        $this->exceptionMatcher = $exceptionMatcher;
    }

    protected function matches($other) {
        $this->lastException = null;
        try {
            $other();
            return false;
        } catch (\Exception $ex) {
            $this->lastException = $ex;
            return $this->exceptionMatcher->evaluate($ex, '', true);
        }
    }

    protected function failureDescription($other) {
        if ($this->lastException) {
            return sprintf('thrown exception %s', $this->exceptionMatcher->failureDescription($this->lastException));
        } else {
            return 'exception was thrown';
        }
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString() {
        return sprintf('exception matching %s is thrown', $this->exceptionMatcher->toString());
    }
}
