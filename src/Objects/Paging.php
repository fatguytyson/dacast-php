<?php

namespace FGC\DacastPhp\Objects;

class Paging
{
    /** @var string */
    public string $first;
    /** @var string */
    public string $last;
    /** @var string|null */
    public ?string $next;
    /** @var string|null */
    public ?string $previous;
}
