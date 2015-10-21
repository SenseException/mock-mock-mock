<?php

require __DIR__ . '/../vendor/autoload.php';

use bovigo\callmap\NewInstance;
use bovigo\callmap;
use Testify\Testify;
use MockMockMock\Code\MathInterface;

$testify = new Testify('bovigo/callmap Mocks');



$testify->test('Simple Mock', function (Testify $testify) {
    $math = NewInstance::of(MathInterface::class)
        ->mapCalls(
            [
                'sum' => 2,
            ]
        );

    $testify->assertEquals(2, $math->sum(1, 2));
    callmap\verify($math, 'sum')->wasCalledOnce();
});


$testify->test('Simple Mock', function (Testify $testify) {
    $math = NewInstance::of(MathInterface::class);

    $testify->assertTrue($math->getSelf() instanceof MathInterface);
    callmap\verify($math, 'getSelf')->wasCalledOnce();
});



try {
    $testify->run();
} catch (Exception $e) {
    echo $e->getMessage();
}