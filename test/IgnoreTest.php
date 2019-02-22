<?php

use PHPUnit\Framework\TestCase;
use Phinder\API;


class IgnoreTest extends TestCase
{

    function testParseRule()
    {
        $i = 0;
        foreach (API::phind('./test/res/yml/ignore.yml', './test/res/php/valid') as $m) {
            $i++;
        }
        $this->assertSame($i, 2);
    }
}
