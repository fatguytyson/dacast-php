<?php

namespace FGC\DacastPhp;

use FGC\DacastPhp\Client\Vod;
use FGC\DacastPhp\Traits\ClientTrait;

class Client
{
    use ClientTrait;

    private Vod $vod;

    public function vod(): Vod
    {
        return $this->vod = $this->vod ?? new Vod($this->apiKey, $this->client, $this->serializer);
    }
}
