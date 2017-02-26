<?php

namespace DavidvanLaatum\PHPUnitMatchers;


class ArrayHasItemsTest extends \PHPUnit_Framework_TestCase {

    public function test() {
        self::assertThat([1,2], new ArrayHasItems([1,2]));
        self::assertThat([1,2,3], new ArrayHasItems([1,2]));
    }
}
