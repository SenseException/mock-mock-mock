<?php

namespace MockMockMock;

require __DIR__ . '/../vendor/autoload.php';

use AspectMock\Kernel;
use Testify\Testify;
use AspectMock\Test;
use MockMockMock\Code\Math;

$testify = new Testify('AspectMock');


$testify->test('AspectMock double', function (Testify $testify) {
    $mathMock = Test::double(Math::class, ['sum' => 0]);

    $math = new Math();
    $testify->assertSame(0, $math->sum(1, 2));

    $mathMock->verifyInvokedOnce('sum', [1, 2]);
});

$testify->test('AspectMock function', function (Testify $testify) {
    Test::func(__NAMESPACE__, 'time', 0);

    $testify->assertSame(0, time());
});

$testify->test('AspectMock static method', function (Testify $testify) {
    $math = Test::double(Math::class, ['operator' => '*']);

    $testify->assertSame('*', Math::operator());
    $math->verifyInvokedOnce('operator');
});

$testify->test('AspectMock classic mock + proxy', function (Testify $testify) {
    $mathMock = Test::double(new Math(), ['getSelf' => null]);

    // Mocked method
    $testify->assertSame(null, $mathMock->getSelf());
    // The real deal
    $testify->assertSame(3, $mathMock->sum(1, 2));

    $mathMock->verifyInvokedOnce('getSelf');
    $mathMock->verifyInvokedOnce('sum', [1, 2]);
});

$testify->afterEach(function () {
    Test::clean();
});

$testify->before(function () {
    $kernel = Kernel::getInstance();
    $kernel->init([
        'debug' => true,
        'appDir'    => __DIR__ . '/Code',
    ]);
});



try {
    $testify->run();
} catch (\Exception $e) {
    echo $e->getMessage();
}