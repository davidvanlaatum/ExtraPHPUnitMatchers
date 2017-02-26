<?php
namespace DavidvanLaatum\PHPUnitMatchers;

trait ExtraMatchers {
    public static function assertArrayHasItems($expected, $actual, $message = null) {
        self::assertThat($actual, self::arrayHasItems($expected), $message);
    }

    public static function arrayHasItems($expected) {
        return new ArrayHasItems($expected);
    }
}
