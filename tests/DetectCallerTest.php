<?php declare(strict_types=1);

namespace Horat1us\Tests;

use Horat1us\DetectCaller;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(DetectCaller::class)]
class DetectCallerTest extends TestCase
{
    public function testBacktrace(): void
    {
        $line = __LINE__ + 1;
        $backtrace = (fn() => DetectCaller::backtrace(0))();
        $expected = [
            'file' => __FILE__,
            'line' => $line,
            'function' => '{closure:' . __METHOD__ . '():' . $line . '}',
            'class' => __CLASS__,
            'type' => '->',
        ];
        $this->assertEquals($expected, $backtrace);
    }

    public static function callStaticDataProvider(): array
    {
        return [
            [__FUNCTION__, DetectCaller::function(),],
            [__CLASS__, DetectCaller::class(),],
            [DetectCaller::class(), (fn() => DetectCaller::class(1))(),],
            [(string)__LINE__, (fn() => DetectCaller::line())(),],
            ['::', DetectCaller::type(),],
        ];
    }

    /**
     * @param int|string $expected
     * @param int|string $actual
     */
    #[DataProvider('callStaticDataProvider')]
    public function testCallStatic($expected, $actual): void
    {
        $this->assertEquals($expected, $actual);
    }

    public function testInvalidCallStatic(): void
    {
        // The undefined key raises a warning. PHPUnit 9 converted warnings to exceptions,
        // like application error handlers usually do; PHPUnit 10+ does not.
        set_error_handler(static function (int $severity, string $message, string $file, int $line): bool {
            throw new \ErrorException($message, 0, $severity, $file, $line);
        });
        try {
            $this->expectException(\BadMethodCallException::class);
            $this->expectExceptionMessage('Method caesar not exists!');
            /** @noinspection PhpUndefinedMethodInspection */
            DetectCaller::caesar(2);
        } finally {
            restore_error_handler();
        }
    }
}
