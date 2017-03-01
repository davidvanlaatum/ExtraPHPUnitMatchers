<?php

namespace DavidvanLaatum\PHPUnitMatchers;

class MethodReturns extends \PHPUnit_Framework_Constraint {

    protected $method;
    protected $matcher;
    protected $arguments = [];
    /** @var \Exception */
    protected $lastException = null;
    protected $lastReturn = null;

    public function __construct($method, \PHPUnit_Framework_Constraint $matcher) {
        parent::__construct();
        $this->method = $method;
        $this->matcher = $matcher;
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString() {
        return sprintf("%s(%s) return value %s", $this->method, $this->argsToString(), $this->matcher->toString());
    }

    protected function argsToString() {
        $rt = [];
        foreach ($this->arguments as $value) {
            $rt[] = $this->exporter->shortenedExport($value);
        }
        return implode(",", $rt);
    }

    public function addArg($arg) {
        $this->arguments[] = $arg;
        return $this;
    }

    protected function getValue($other) {
        $reflect = new \ReflectionClass($other);
        $method = $reflect->getMethod($this->method);
        return $method->invokeArgs($other, $this->arguments);
    }

    protected function matches($other) {
        try {
            $this->lastReturn = $this->getValue($other);
            return $this->matcher->evaluate($this->lastReturn, '', true);
        } catch (\Exception $ex) {
            $this->lastException = $ex;
            return false;
        }
    }

    protected function failureDescription($other) {
        if ($this->lastException) {
            return sprintf('%s got exception %s(%s) invoking method', $this->toString(), get_class($this->lastException), $this->exporter->export($this->lastException->getMessage()));
        } else {
            return $this->toString() . ' got ' . $this->exporter->export($this->lastReturn);
        }
    }

    protected function additionalFailureDescription($other) {
        return $this->lastException ? (string)$this->lastException : '';
    }
}
