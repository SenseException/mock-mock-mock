<?php

require __DIR__ . '/../vendor/autoload.php';

use Testify\Testify;
use MockMockMock\Code\MathInterface;
use MockMockMock\Code\Math;

$testify = new Testify('PHPUnit Mocks');



$testify->test('Simple Mock', function (Testify $testify) {
    /* @var PHPUnit\Framework\MockObject\Generator $mockFw */
    $mockFw = $testify->data->mockFw;

    /* @var PHPUnit\Framework\MockObject\MockObject&MathInterface $math */
    $math = $mockFw->getMock(MathInterface::class);

    $math->expects(new PHPUnit\Framework\MockObject\Rule\InvokedAtLeastOnce())
        ->method('sum')
        ->with(1, 1)
        ->willReturn(2);

    $testify->assertEquals(2, $math->sum(1, 1));

    $math->__phpunit_verify();
});

$testify->test('Proxy Mock', function (Testify $testify) {
    /* @var PHPUnit\Framework\MockObject\Generator $mockFw */
    $mockFw = $testify->data->mockFw;

    /* @var PHPUnit\Framework\MockObject\MockObject&MathInterface $math */
    // type, methods, arguments, mock class name, call orig. constructor, call orig. clone, call autoload, cloneArguments, callOriginalMethods, proxyTarget
    $math = $mockFw->getMock(Math::class, [], [], '', true, false, true, false, true);

    $math->expects(new PHPUnit\Framework\MockObject\Rule\InvokedAtLeastOnce())
        ->method('sum');

    $testify->assertEquals(2, $math->sum(1, 1));

    $math->__phpunit_verify();
});


$testify->beforeEach(function (Testify $testify) {
    $testify->data->mockFw = new PHPUnit\Framework\MockObject\Generator();
});


try {
    $testify->run();
} catch (Exception $e) {
    echo $e->getMessage();
}