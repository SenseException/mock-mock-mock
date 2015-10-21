<?php

namespace MockMockMock\Code;

interface MathInterface
{
    /**
     * @param int|float $value1
     * @param int|float $value2
     *
     * @return int|float
     */
    public function sum($value1, $value2);

    /**
     * @return MathInterface
     */
    public function getSelf();
}