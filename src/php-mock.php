<?php

namespace MockMockMock;

require __DIR__ . '/../vendor/autoload.php';

use Testify\Testify;
use phpmock\spy\Spy;
use phpmock\MockBuilder;

$testify = new Testify('PHP Mock');


$testify->test('Stub of time function', function (Testify $testify) {
    $builder = new MockBuilder();
    $builder->setNamespace(__NAMESPACE__)
        ->setName('time')
        ->setFunction(
            function () {
                return 0;
            }
        );

    $stub = $builder->build();

    $stub->enable();
    $testify->assertSame(0, time());
    $stub->disable(); // disable to not influence other tests
});

$testify->test('PHP Mock Spy', function (Testify $testify) {
    $spy = new Spy(__NAMESPACE__, 'implode');
    $spy->enable();

    implode(', ', [1,2,3,4,]);

    $testify->assertSame([', ', [1,2,3,4]], $spy->getInvocations()[0]->getArguments());
    $testify->assertSame('1, 2, 3, 4', $spy->getInvocations()[0]->getReturn());
});



try {
    $testify->run();
} catch (\Exception $e) {
    echo $e->getMessage();
}