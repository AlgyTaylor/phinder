<?php

namespace Phinder\Parser;

use RecursiveIteratorIterator as RecItrItr;
use RecursiveDirectoryIterator as RecDirItr;
use Phinder\Error\FileNotFound;

abstract class FileParser
{
    protected $extensions = [];

    public function parse($path)
    {
        if (\is_dir($path)) {
            foreach (new RecItrItr(new RecDirItr($path)) as $itr) {
                $p = $itr->getPathname();
                if ($this->support($p)) {
                    yield from $this->parseFile($p);
                }
            }
        } elseif (\is_file($path)) {
            yield from $this->parseFile($path);
        } else {
            throw new FileNotFound($path);
        }
    }

    protected function getContent($path)
    {
        $code = @\file_get_contents($path);

        return $code;
    }

    abstract protected function parseFile($path);
}
