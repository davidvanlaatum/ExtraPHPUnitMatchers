<?php

namespace Tests\DavidvanLaatum\PHPUnitMatchers;

use DavidvanLaatum\PHPUnitMatchers\ArrayHasItems;

/**
 * @covers \DavidvanLaatum\PHPUnitMatchers\ArrayHasItems
 * @covers \DavidvanLaatum\PHPUnitMatchers\DiagnosingMatcher
 * @covers \DavidvanLaatum\PHPUnitMatchers\ExtraMatchers::arrayHasItems()
 * @covers \DavidvanLaatum\PHPUnitMatchers\ExtraMatchers::assertArrayHasItems()
 */
class ArrayHasItemsTest extends ConstraintTester {

    public function test() {
        self::assertConstraintMatches(new ArrayHasItems([1, 2]), [1, 2]);
        self::assertConstraintDoesntMatch(new ArrayHasItems([1, 2]), [1, 2, 3], self::equalTo("0 => matched
1 => matched
2 => unexpected value 3"));
        self::assertConstraintDoesntMatch(new ArrayHasItems([1, 2, 3]), [1, 2], self::equalTo("0 => matched
1 => matched
2 => missing key is equal to 3"));
        self::assertConstraintDoesntMatch(new ArrayHasItems([2, 1]), [1, 2], self::equalTo("0 => failed 1 is equal to 2
1 => failed 2 is equal to 1"));

        self::assertArrayHasItems([1, 2], [1, 2]);
        self::assertInstanceOf(ArrayHasItems::class, self::arrayHasItems([1, 2]));
    }
}
