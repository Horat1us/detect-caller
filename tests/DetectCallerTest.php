<?php declare(strict_types=1);

namespace Horat1us\Tests;

use Horat1us\DetectCaller;
use PHPUnit\Framework\TestCase;

class DetectCallerTest extends TestCase
{
    /**
     * @covers \Horat1us\DetectCaller::backtrace
     */
    public function testBacktrace(): void
    {
        $line = __LINE__ + 1;
        $backtrace = (fn() => DetectCaller::backtrace(0))();
        $expected = [
            'file' => __FILE__,
            'line' => $line,
            'function' => 'Horat1us\Tests\{closure}',
            'class' => __CLASS__,
            'type' => '->',
        ];
        $this->assertEquals($expected, $backtrace);
    }

    public function callStaticDataProvider(): array
    {
        return [
            [__FUNCTION__, DetectCaller::function(),],
            [__CLASS__, DetectCaller::class(),],
            [DetectCaller::class(), (fn() => DetectCaller::class(1))(),],
            [(string)__LINE__, (fn() => DetectCaller::line())(),],
            ['->', DetectCaller::type(),],
        ];
    }

    /**
     * @dataProvider callStaticDataProvider
     * @covers       \Horat1us\DetectCaller::__callStatic
     * @param int|string $expected
     * @param int|string $actual
     */
    public function testCallStatic($expected, $actual): void
    {
        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers \Horat1us\DetectCaller::__callStatic
     */
    public function testInvalidCallStatic(): void
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('Method caesar not exists!');
        /** @noinspection PhpUndefinedMethodInspection */
        DetectCaller::caesar(2);
    }
}
