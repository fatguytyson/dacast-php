<?php

namespace Tests\OptionResolver;

use FGC\DacastPhp\OptionResolver\PageOptions;
use PHPUnit\Framework\TestCase;

/**
 * @covers \FGC\DacastPhp\OptionResolver\PageOptions
 */
class PageOptionsTest extends OptionResolverTest
{
    public function scenarioProvider(): array
    {
        return [
            [
                'options' => [],
                'result' => [
                    'page' => 1,
                    'perpage' => 10,
                ],
            ],
            [
                'options' => [
                    'page' => 2,
                ],
                'result' => [
                    'page' => 2,
                    'perpage' => 10,
                ],
            ],
            [
                'options' => [
                    'perpage' => 25,
                ],
                'result' => [
                    'page' => 1,
                    'perpage' => 25,
                ],
            ],
            [
                'options' => [
                    'sort' => 'ASC',
                ],
                'result' => [
                    'page' => 1,
                    'perpage' => 10,
                    'sort' => 'ASC',
                ],
            ],
            [
                'options' => [
                    'sort' => 'asc',
                ],
                'result' => null,
            ],
        ];
    }

    protected function getOptionResolverClass(): string
    {
        return PageOptions::class;
    }
}
