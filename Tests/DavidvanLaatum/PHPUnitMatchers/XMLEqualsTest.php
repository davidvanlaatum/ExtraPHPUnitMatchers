<?php
namespace Tests\DavidvanLaatum\PHPUnitMatchers;

/**
 * @covers \DavidvanLaatum\PHPUnitMatchers\XMLEquals
 * @covers \DavidvanLaatum\PHPUnitMatchers\ExtraMatchers::xmlEquals
 */
class XMLEqualsTest extends ConstraintTester {

    public function test() {
        self::assertConstraintMatches(self::xmlEquals('<test/>'), '<test/>');
        self::assertConstraintDoesntMatch(self::xmlEquals('<test/>'), '<test><bla/></test>', self::equalTo('Failed asserting that two DOM documents are equal.

--- Expected
+++ Actual
@@ @@
 <?xml version="1.0"?>
-<test/>
+<test>
+  <bla/>
+</test>
 
'));
        self::assertConstraintDoesntMatch(self::xmlEquals('<test/>'), null,self::equalTo('null does not match expected type "object".'));
    }
}
