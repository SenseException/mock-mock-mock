<?php

require __DIR__ . '/../vendor/autoload.php';

use Testify\Testify;

$testify = new Testify('PHPUnit Mock');



$testify->test('Simple Mock', function(Testify $testify) {
    /* @var PHPUnit_Framework_MockObject_Generator $mockFw */
    $mockFw = $testify->data->mockFw;

    /* @var PHPUnit_Framework_MockObject_MockObject $math */
    $math = $mockFw->getMock('MockMockMock\Code\MathInterface');

    $math->expects(new PHPUnit_Framework_MockObject_Matcher_InvokedAtLeastOnce())
        ->method('sum')
        ->with(1, 1)
        ->willReturn(2);

    $testify->assertEquals(2, $math->sum(1, 1));
});




$testify->beforeEach(function(Testify $testify) {
    $testify->data->mockFw = new PHPUnit_Framework_MockObject_Generator();
});

$testify->run();