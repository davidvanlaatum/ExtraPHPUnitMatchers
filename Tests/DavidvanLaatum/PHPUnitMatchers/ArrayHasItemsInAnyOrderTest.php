<?php

namespace Tests\DavidvanLaatum\PHPUnitMatchers;

use DavidvanLaatum\PHPUnitMatchers\ArrayHasItemsInAnyOrder;

/**
 * @covers \DavidvanLaatum\PHPUnitMatchers\ArrayHasItemsInAnyOrder
 * @covers \DavidvanLaatum\PHPUnitMatchers\DiagnosingMatcher
 * @covers \DavidvanLaatum\PHPUnitMatchers\ExtraMatchers::arrayHasItemsInAnyOrder()
 * @covers \DavidvanLaatum\PHPUnitMatchers\ExtraMatchers::assertArrayHasItemsInAnyOrder()
 */
class ArrayHasItemsInAnyOrderTest extends ConstraintTester {

    public function test() {
        self::assertConstraintMatches(new ArrayHasItemsInAnyOrder([1, 2]), [1, 2]);
        self::assertConstraintDoesntMatch(new ArrayHasItemsInAnyOrder([1, 2]), [1, 2, 3], self::equalTo("unmatched 3"));
        self::assertConstraintDoesntMatch(new ArrayHasItemsInAnyOrder([1, 2, 3]), [1, 2], self::equalTo("missing is equal to 3"));
        self::assertInstanceOf(ArrayHasItemsInAnyOrder::class, self::arrayHasItemsInAnyOrder([1, 2]));
        self::assertArrayHasItemsInAnyOrder([1, 2], [2, 1]);
        self::assertEquals('array contains items in any order matching (is equal to 1
is equal to 2)', self::arrayHasItemsInAnyOrder([1, 2])->toString());
    }
}
