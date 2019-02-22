<?php

namespace Phinder;

use Phinder\Error\InvalidRule;
use Webmozart\Glob\Glob;
use function Funct\Strings\startsWith;

final class Rule
{

    public $id;

    public $xpath;

    public $message;

    public $justifications;

    public $fail_patterns;

    public $pass_patterns;

    public $ignore_patterns;

    public function __construct(
        $id,
        $xpath,
        $message,
        $justifications,
        $pass_patterns,
        $fail_patterns,
        $ignore_patterns
    ) {
        $this->id = $id;
        $this->xpath = $xpath;
        $this->message = $message;
        $this->justifications = $justifications;
        $this->pass_patterns = $pass_patterns;
        $this->fail_patterns = $fail_patterns;
        $this->ignore_patterns = $ignore_patterns;
    }

    public function ignore($path)
    {
        $path = realpath($path);
        foreach ($this->ignore_patterns as $p) {
            $p = startsWith($p, '/') ? $p : "/$p";
            if (Glob::match($path, $p)) {
                return true;
            }
        }
        return false;
    }

}
