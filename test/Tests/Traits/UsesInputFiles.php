<?php

namespace Tests\Traits;

use Illuminate\Support\Str;

use function Orchestra\Testbench\package_path;

trait UsesInputFiles
{
    public function getInputPath(string $appends = ''): string
    {
        $path = package_path('test/input');

        if ($appends) {
            $path .= str_starts_with($appends, '/') ? $appends : "/$appends";
        }

        return $path;
    }

    public function normalizeLineEndings(string $string): string
    {
        if (PHP_OS_FAMILY === 'Windows') {
            return Str::replace("\r\n", "\n", $string);
        }

        return $string;
    }

    public function getInputFileContents(string $path, bool $addEOL = false): string
    {
        $contents = file_get_contents($this->getInputPath($path));

        return $this->normalizeLineEndings($addEOL ? $contents . PHP_EOL : $contents);
    }

    public function getExpectedContent(string $path, bool $addEOL = false): string
    {
        return $this->getInputFileContents("expectations/$path", $addEOL);
    }
}
