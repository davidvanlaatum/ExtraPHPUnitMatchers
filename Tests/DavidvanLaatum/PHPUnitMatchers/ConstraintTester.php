<?php
namespace Tests\DavidvanLaatum\PHPUnitMatchers;

use DavidvanLaatum\PHPUnitMatchers\ExtraMatchers;

class ConstraintTester extends \PHPUnit_Framework_TestCase {
    use ExtraMatchers;

    public static function assertConstraintMatches(\PHPUnit_Framework_Constraint $constraint, $other) {
        if (!$constraint->evaluate($other, '', true)) {
            self::fail('Constraint didn\'t match ' . $constraint->toString());
        }
    }

    public static function assertConstraintDoesntMatch(\PHPUnit_Framework_Constraint $constraint, $other, \PHPUnit_Framework_Constraint $description = null) {
        if (!$description) {
            $description = self::anything();
        }
        if ($constraint->evaluate($other, '', true)) {
            self::fail('Constraint matched when it shouldn\'t ' . $constraint->toString());
        } else {
            try {
                $method = new \ReflectionMethod($constraint, 'failureDescription');
                $method->setAccessible(true);
                self::assertThat($method->invoke($constraint, $other), $description);
            } catch(\Exception $ex) {
                self::fail('Got exception invoking failureDescription: ' . get_class($ex) . ' ' . $ex);
            }
        }
    }
}
