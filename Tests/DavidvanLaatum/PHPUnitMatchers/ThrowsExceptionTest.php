<?php

namespace Tests\DavidvanLaatum\PHPUnitMatchers;

use DavidvanLaatum\PHPUnitMatchers\ThrowsException;

/**
 * @covers \DavidvanLaatum\PHPUnitMatchers\ThrowsException
 * @covers \DavidvanLaatum\PHPUnitMatchers\ExtraMatchers::throwsException()
 * @covers \DavidvanLaatum\PHPUnitMatchers\ExtraMatchers::assertThrowsException
 */
class ThrowsExceptionTest extends ConstraintTester {

    public function test() {
        self::assertConstraintMatches(new ThrowsException(self::isInstanceOf(\Exception::class)), function () {
            throw new \Exception("Test");
        });
        self::assertConstraintDoesntMatch(new ThrowsException(self::isInstanceOf(\Exception::class)), function () {
        }, self::equalTo('exception was thrown'));
        self::assertConstraintDoesntMatch(new ThrowsException(self::isInstanceOf(\InvalidArgumentException::class)), function () {
            throw new \Exception("Test");
        }, self::equalTo('thrown exception Exception Object (...) is an instance of class "InvalidArgumentException"'));
        self::assertThrowsException(function () {
            throw new \Exception();
        }, self::isInstanceOf(\Exception::class));
        self::assertEquals('exception matching is instance of class "Exception" is thrown', self::throwsException(self::isInstanceOf(\Exception::class))->toString());
    }
}
