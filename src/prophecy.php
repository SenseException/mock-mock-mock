<?php

require __DIR__ . '/../vendor/autoload.php';

use Testify\Testify;
use MockMockMock\Code\MathInterface;
use Prophecy\Prophet;
use Prophecy\Argument\Token\AnyValueToken;

$testify = new Testify('PHPUnit Mock');



$testify->test('Simple Mock', function (Testify $testify) {
    /* @var Prophet $mockFw */
    $mockFw = $testify->data->mockFw;

    $prophecy = $mockFw->prophesize(MathInterface::class);
    $prophecy->sum(1, 1)
        ->willReturn(2)
        ->shouldBeCalledTimes(1);

    $prophecy->sum(2, 2)
        ->willReturn(4)
        ->shouldBeCalledTimes(1);

    $math = $prophecy->reveal();

    $testify->assertEquals(2, $math->sum(1, 1));
    $testify->assertEquals(4, $math->sum(2, 2));
});

$testify->test('Mock with token check', function (Testify $testify) {
    /* @var Prophet $mockFw */
    $mockFw = $testify->data->mockFw;

    $prophecy = $mockFw->prophesize(MathInterface::class);
    $prophecy->sum(new AnyValueToken(), new AnyValueToken())
        ->willReturn(true)
        ->shouldBeCalledTimes(1);

    $math = $prophecy->reveal();

    $testify->assertEquals(2, $math->sum(1, 1));
});


$testify->beforeEach(function (Testify $testify) {
    $testify->data->mockFw = new Prophet();
});


$testify->afterEach(function (Testify $testify) {
    // Checking if predictions were correct. Ususally happens somewhere hidden in the testing FW
    $testify->data->mockFw->checkPredictions();
});



try {
    $testify->run();
} catch (Exception $e) {
    echo $e->getMessage();
}