<?php

error_reporting(-1);

require __DIR__ . '/../vendor/autoload.php';

use Testify\Testify;
use MockMockMock\Code\MathInterface;
use MockMockMock\Code\Math;

$testify = new Testify('PHPUnit Mock');



$testify->test('Simple Mock', function(Testify $testify) {
    /* @var PHPUnit_Framework_MockObject_Generator $mockFw */
    $mockFw = $testify->data->mockFw;

    /* @var PHPUnit_Framework_MockObject_MockObject $math */
    $math = $mockFw->getMock(MathInterface::class);

    $math->expects(new PHPUnit_Framework_MockObject_Matcher_InvokedAtLeastOnce())
        ->method('sum')
        ->with(1, 1)
        ->willReturn(2);

    $testify->assertEquals(2, $math->sum(1, 1));
});

$testify->test('Proxy Mock', function(Testify $testify) {
    /* @var PHPUnit_Framework_MockObject_Generator $mockFw */
    $mockFw = $testify->data->mockFw;

    /* @var PHPUnit_Framework_MockObject_MockObject $math */
    $math = $mockFw->getMock(Math::class, [], [], '', false, false, true, false, true);

    $math->expects(new PHPUnit_Framework_MockObject_Matcher_InvokedAtLeastOnce())
        ->method('sum');

    $testify->assertEquals(2, $math->sum(1, 1));
});

$testify->test('Mocks on Static methods', function(Testify $testify) {
//    /* @var PHPUnit_Framework_MockObject_Generator $mockFw */
//    $mockFw = $testify->data->mockFw;
//
//    /* @var PHPUnit_Framework_MockObject_MockObject $math */
//    $math = $mockFw->getMock(Math::class);
//
//    $math->expects(new PHPUnit_Framework_MockObject_Matcher_InvokedAtLeastOnce())
//        ->method('sum')
//        ->with(1, 1)
//        ->willReturn(2);
//
//    $testify->assertEquals('+', $math->operator());


    $math = new Math();
    $testify->assertEquals('+', $math->operator());
});




$testify->beforeEach(function(Testify $testify) {
    $testify->data->mockFw = new PHPUnit_Framework_MockObject_Generator();
});


try {
    $testify->run();
} catch (Exception $e) {
    echo $e->getMessage();
}