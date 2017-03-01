<?php
namespace DavidvanLaatum\PHPUnitMatchers;

trait ExtraMatchers {
    public static function assertArrayHasItems($expected, $actual, $message = null) {
        self::assertThat($actual, self::arrayHasItems($expected), $message);
    }

    public static function arrayHasItems($expected) {
        return new ArrayHasItems($expected);
    }

    public static function arrayHasItemsInAnyOrder($expected) {
        return new ArrayHasItemsInAnyOrder($expected);
    }

    public static function assertArrayHasItemsInAnyOrder($expected, $actual, $message = null) {
        self::assertThat($actual, self::arrayHasItemsInAnyOrder($expected), $message);
    }

    public static function throwsException(\PHPUnit_Framework_Constraint $constraint) {
        return new ThrowsException($constraint);
    }

    public static function assertThrowsException(\Closure $func, \PHPUnit_Framework_Constraint $constraint) {
        self::assertThat($func, self::throwsException($constraint));
    }

    public static function methodReturns($method, \PHPUnit_Framework_Constraint $constraint) {
        return new MethodReturns($method, $constraint);
    }

    public static function assertMethodReturns($object, $method, \PHPUnit_Framework_Constraint $constraint) {
        self::assertThat($object, self::methodReturns($method, $constraint));
    }

    public static function xmlEquals($xml) {
        return new XMLEquals($xml);
    }
}
