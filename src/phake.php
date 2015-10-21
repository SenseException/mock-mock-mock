<?php

require __DIR__ . '/../vendor/autoload.php';

use Testify\Testify;
use MockMockMock\Code\MathInterface;

$testify = new Testify('Phake Mocks');



$testify->test('Simple Mock', function (Testify $testify) {
    $math = \Phake::mock(MathInterface::class);

    Phake::when($math)->sum(1, 1)->thenReturn(2);

    Phake::verifyNoInteraction($math);

    $testify->assertEquals(2, $math->sum(1, 1));
    Phake::verify($math, Phake::times(1))->sum(1, 1);
});


$testify->test('Check if interaction with mock happended', function (Testify $testify) {
    $math = \Phake::mock(MathInterface::class);

    Phake::when($math)->sum(1, 1)->thenReturn(2);

    Phake::verifyNoInteraction($math);

    $testify->assertEquals(2, $math->sum(1, 1));
    Phake::verify($math, Phake::times(1))->sum(1, 1);
});



try {
    $testify->run();
} catch (Exception $e) {
    echo $e->getMessage();
}