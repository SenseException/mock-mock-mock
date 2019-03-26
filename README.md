# Mock Mock Mock

Mock Mock Mock is part of a talk about Mocking-Frameworks and provides example code for in the talk mentioned mocks.
The slides to that talk are available [here](https://senseexception.github.io/mock-mock-mock-talk/).

To keep the Frameworks in the foreground of the examples, the micro testing Framework Testify is used.

The following Mocking-Frameworks are handled:

* PHPUnit_MockObject
* Prophecy
* Mockery
* vfsStream
* Phake
* bovigo/callmap
* php-mock
* aspect-mock

### Installation

``` bash
git clone git@github.com:SenseException/mock-mock-mock.git
cd mock-mock-mock
composer.phar install
```
Start a webserver to run the tests in browser:

``` bash
php -S localhost:8080 -t src/
```
