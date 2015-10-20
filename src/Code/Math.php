<?php

namespace MockMockMock\Code;

class Math implements MathInterface
{
    /**
     * @param float|int $value1
     * @param float|int $value2
     *
     * @return float|int
     */
    public function sum($value1, $value2)
    {
        $this->numericCheck($value1);
        $this->numericCheck($value2);

        return $value1 + $value2;
    }

    /**
     * @param int|float $value
     */
    private function numericCheck($value)
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException('Not a numeric value. Shame on you.');
        }
    }

    /**
     * @return string
     */
    public static function operator()
    {
        return '+';
    }
}