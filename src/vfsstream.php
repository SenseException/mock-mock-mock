<?php

require __DIR__ . '/../vendor/autoload.php';

use Testify\Testify;
use org\bovigo\vfs\vfsStream;

$testify = new Testify('vfsStream filesystem Mocks');



$testify->test('Create directory in vfsStream filesystem', function (Testify $testify) {
    /* @var $baseDir org\bovigo\vfs\vfsStreamDirectory */
    $baseDir = vfsStream::setup('dir');

    mkdir(vfsStream::url('dir')  . '/' . 'myDir');

    $testify->assertTrue($baseDir->hasChild('myDir'));
    $testify->assertTrue(file_exists(vfsStream::url('dir') . '/myDir'));
});


$testify->test('Create whole directory structure at initialisation', function (Testify $testify) {
    /* @var $baseDir org\bovigo\vfs\vfsStreamDirectory */
    $baseDir = vfsStream::setup('dir');
    $structure = array(
        'files' => array(
            'text' => array('config.yml' => 'db.username: test, db.password: pass'),
            'php' => array(
                'lib' => array('Library.php' => 'phpinfo();'),
                'util' => array(
                    'Finder.php' => '',
                    'Foo.php' => '$foo = "Foo"; var_dump($foo);',
                ),
            ),
        ),
    );
    vfsStream::create($structure, $baseDir);

    $testify->assertTrue(file_exists(vfsStream::url('dir') . '/files/php/util/Finder.php'));
});


$testify->test('Create from existing directory structure', function (Testify $testify) {
    /* @var $baseDir org\bovigo\vfs\vfsStreamDirectory */
    $baseDir = vfsStream::setup('dir');
    vfsStream::copyFromFileSystem(__DIR__ . '/Code');

    $testify->assertTrue(file_exists(vfsStream::url('dir') . '/Math.php'));
});



try {
    $testify->run();
} catch (Exception $e) {
    echo $e->getMessage();
}