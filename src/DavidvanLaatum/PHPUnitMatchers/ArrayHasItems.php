<?php
namespace DavidvanLaatum\PHPUnitMatchers;

class ArrayHasItems extends DiagnosingMatcher {
    protected $items;

    /**
     * ArrayHasItems constructor.
     * @param array $items
     */
    public function __construct($items) {
        parent::__construct();
        $this->items = $items;
        foreach ($this->items as $index => $value) {
            if (!($value instanceof \PHPUnit_Framework_Constraint)) {
                $this->items[$index] = new \PHPUnit_Framework_Constraint_IsEqual($value);
            }
        }
    }

    protected function matchesWithDescription($other) {
        $data = array_map(function (\PHPUnit_Framework_Constraint $matcher, $key) use ($other) {
            if (array_key_exists($key, $other)) {
                if (!$matcher->evaluate($other[$key], '', true)) {
                    return [false, 'failed ' . $matcher->failureDescription($other[$key])];
                } else {
                    return [true, 'matched'];
                }
            } else {
                return [false, 'missing ' . $matcher->toString()];
            }
        }, $this->items, array_keys($this->items));

        $matched = true;
        $descriptions = [];

        foreach ($data as $key => $item) {
            if (!$item[0]) {
                $matched = false;
            }
            $descriptions[$key] = $item[1];
        }

        foreach (array_keys($other) as $key) {
            if (!array_key_exists($key, $this->items)) {
                $matched = false;
                $descriptions[$key] = "unexpected";
            }
        }

        return [$matched, $this->exporter->export($descriptions)];
    }

    /**
     * {@inheritDoc}
     */
    public function toString() {
        return "array contains items matching (" . implode("\n", array_map(function (\PHPUnit_Framework_SelfDescribing $a, $i) {
                return $i . ' => ' . $a->toString();
            }, $this->items, array_keys($this->items))) . ")";
    }
}
