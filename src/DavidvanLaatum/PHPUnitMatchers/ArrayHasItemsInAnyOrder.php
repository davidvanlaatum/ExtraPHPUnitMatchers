<?php
namespace DavidvanLaatum\PHPUnitMatchers;

class ArrayHasItemsInAnyOrder extends DiagnosingMatcher {
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
        $matches = $this->items;
        $tmpOther = $other;

        /** @var \PHPUnit_Framework_Constraint $matcher */
        foreach ($matches as $index => $matcher) {
            foreach ($tmpOther as $key => $item) {
                if ($matcher->evaluate($item, '', true)) {
                    unset($tmpOther[$key]);
                    unset($matches[$index]);
                    break;
                }
            }
        }

        $matched = empty($matches) && empty($tmpOther);
        $descriptions = [];

        foreach ($matches as $item) {
            $descriptions[] = sprintf('missing %s', $item->toString());
        }
        foreach ($tmpOther as $item) {
            $descriptions[] = sprintf('unmatched %s', $this->exporter->export($item));
        }


        return [$matched, implode("\n", $descriptions)];
    }

    /**
     * {@inheritDoc}
     */
    public function toString() {
        return "array contains items in any order matching (" . implode("\n", array_map(function (\PHPUnit_Framework_SelfDescribing $a) {
                return $a->toString();
            }, $this->items)) . ")";
    }
}
