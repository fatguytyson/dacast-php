<?php

namespace Tests\OptionResolver\Vod;

use FGC\DacastPhp\OptionResolver\PageOptions;
use FGC\DacastPhp\OptionResolver\Vod\Search;
use Tests\OptionResolver\OptionResolverTest;

/**
 * @covers \FGC\DacastPhp\OptionResolver\Vod\Search
 */
class SearchTest extends OptionResolverTest
{
    public function testInheritance()
    {
        self::assertNotEquals(Search::getDefined(), PageOptions::getDefined());
    }

    public function scenarioProvider(): array
    {
        $now = new \DateTime();
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
                    'title' => 'test',
                ],
                'result' => [
                    'page' => 1,
                    'perpage' => 10,
                    'title' => 'test',
                ],
            ],
            [
                'options' => [
                    'online' => true,
                ],
                'result' => [
                    'page' => 1,
                    'perpage' => 10,
                    'online' => true,
                ],
            ],
            [
                'options' => [
                    'creation_date' => '2000-12-31',
                ],
                'result' => [
                    'page' => 1,
                    'perpage' => 10,
                    'creation_date' => '2000-12-31',
                ],
            ],
            [
                'options' => [
                    'creation_date' => $now,
                ],
                'result' => [
                    'page' => 1,
                    'perpage' => 10,
                    'creation_date' => $now->format('Y-m-d'),
                ],
            ],
            [
                'options' => [
                    'creation_date' => 'bad date',
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'start_date' => '2000-12-31',
                ],
                'result' => [
                    'page' => 1,
                    'perpage' => 10,
                    'start_date' => '2000-12-31',
                ],
            ],
            [
                'options' => [
                    'end_date' => '2000-12-31',
                ],
                'result' => [
                    'page' => 1,
                    'perpage' => 10,
                    'end_date' => '2000-12-31',
                ],
            ],
        ];
    }

    protected function getOptionResolverClass(): string
    {
        return Search::class;
    }
}
