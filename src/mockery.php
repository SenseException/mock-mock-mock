<?php

require __DIR__ . '/../vendor/autoload.php';

use MockMockMock\Code\Countdown;
use Testify\Testify;
use MockMockMock\Code\MathInterface;
use MockMockMock\Code\Math;

$testify = new Testify('Mockery Mocks');



$testify->test('Simple Mock', function (Testify $testify) {
    $math = Mockery::mock(MathInterface::class);
    $math->shouldReceive('sum')
        ->once()
        ->with(1, 1)
        ->andReturn(2);

    $testify->assertEquals(2, $math->sum(1, 1));
});


$testify->test('Mock for static methods', function (Testify $testify) {
    $math = Mockery::mock('alias:' . Math::class);
    $math->shouldReceive('operator')
        ->once()
        ->andReturn('-');

    $testify->assertEquals('-', Math::operator());
});


$testify->test('Mock for final classes', function (Testify $testify) {
    $countdown = Mockery::mock(new Countdown());
    $countdown->shouldReceive('current')
        ->once()
        ->andReturn(2);

    $testify->assertEquals(2, $countdown->current());
    $testify->assertFalse($countdown instanceof Countdown);
});


$testify->afterEach(function () {
    Mockery::close();
});



try {
    $testify->run();
} catch (Exception $e) {
    echo $e->getMessage();
}