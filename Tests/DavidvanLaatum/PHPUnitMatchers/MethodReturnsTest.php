<?php

namespace Tests\DavidvanLaatum\PHPUnitMatchers;

use DavidvanLaatum\PHPUnitMatchers\MethodReturns;

/**
 * @covers \DavidvanLaatum\PHPUnitMatchers\MethodReturns
 * @covers \DavidvanLaatum\PHPUnitMatchers\ExtraMatchers::methodReturns
 * @covers \DavidvanLaatum\PHPUnitMatchers\ExtraMatchers::assertMethodReturns
 */
class MethodReturnsTest extends ConstraintTester {
    public function test() {
        self::assertConstraintMatches(new MethodReturns('dummyFunction', self::equalTo('bla')), $this);
        self::assertConstraintDoesntMatch(new MethodReturns('dummyFunction', self::equalTo('bla2')), $this,
            self::equalTo('dummyFunction() return value is equal to <string:bla2> got \'bla\''));
        self::assertConstraintDoesntMatch(self::methodReturns('dummyFunction', self::equalTo('bla2'))->addArg('abc')->addArg('xyz'), $this,
            self::equalTo('dummyFunction(\'abc\',\'xyz\') return value is equal to <string:bla2> got \'bla\''));
        self::assertThat($this, self::methodReturns('dummyFunction2', self::equalTo("abc xyz"))->addArg("abc")->addArg("xyz"));
        self::assertMethodReturns($this, 'dummyFunction', self::equalTo('bla'));
        self::assertConstraintDoesntMatch(self::methodReturns('notAMethod', self::equalTo(null)), $this,
            self::equalTo('notAMethod() return value is equal to null got exception ReflectionException(\'Method notAMethod does not exist\') invoking method'));

        try {
            self::assertMethodReturns($this, 'bla', self::anything());
            throw new \InvalidArgumentException('Failed to throw exception');
        } catch (\PHPUnit_Framework_ExpectationFailedException $ex) {
            if (version_compare('7.0', phpversion()) < 0) {
                self::assertStringStartsWith('Failed asserting that bla() return value is anything got exception ReflectionException(\'Method bla does not exist\') invoking method.
ReflectionException: Method bla does not exist in ', $ex->getMessage());
            } else {
                self::assertStringStartsWith('Failed asserting that bla() return value is anything got exception ReflectionException(\'Method bla does not exist\') invoking method.
exception \'ReflectionException\' with message \'Method bla does not exist\' in ', $ex->getMessage());
            }
        }
    }

    public function dummyFunction() {
        return 'bla';
    }

    public function dummyFunction2($arg1, $arg2) {
        return "$arg1 $arg2";
    }
}
