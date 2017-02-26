<?php
namespace Tests\DavidvanLaatum\PHPUnitMatchers;

class ConstraintTester extends \PHPUnit_Framework_TestCase {
    public static function assertConstraintMatches(\PHPUnit_Framework_Constraint $constraint, $other) {
        self::assertTrue($constraint->evaluate($other, '', true), 'Constraint didn\'t match ' . $constraint->toString());
    }

    public static function assertConstraintDoesntMatch(\PHPUnit_Framework_Constraint $constraint, $other, \PHPUnit_Framework_Constraint $description = null) {
        if (!$description) {
            $description = self::anything();
        }
        if ($constraint->evaluate($other, '', true)) {
            self::fail('Constraint matched when it shouldn\'t ' . $constraint->toString());
        } else {
            $method = new \ReflectionMethod($constraint, "failureDescription");
            $method->setAccessible(true);
            self::assertThat($method->invoke($constraint, $other), $description);
        }
    }
}
