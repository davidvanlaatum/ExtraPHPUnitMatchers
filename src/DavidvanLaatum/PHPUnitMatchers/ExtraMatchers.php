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
}
