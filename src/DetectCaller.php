<?php declare(strict_types=1);

namespace Horat1us;

/**
 * @method static string function(int $deep = 0)
 * @method static string class(int $deep = 0)
 * @method static string file(int $deep = 0)
 * @method static int line(int $deep = 0)
 * @method static string type(int $deep = 0)
 */
final class DetectCaller
{
    final public static function backtrace(int $deep = 0): array
    {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, $deep + 2);
        return $backtrace[array_key_last($backtrace)];
    }

    final public static function __callStatic($name, $arguments)
    {
        try {
            return static::backtrace(($arguments[0] ?? 0) + 1)[$name];
        } catch (\Throwable $exception) {
            throw new \BadMethodCallException("Method {$name} not exists!", 0, $exception);
        }
    }
}
