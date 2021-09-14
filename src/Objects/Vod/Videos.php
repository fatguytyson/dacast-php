<?php

namespace FGC\DacastPhp\Objects\Vod;

use FGC\DacastPhp\Objects\Paging;
use FGC\DacastPhp\Objects\Vod\Videos\Video;
use Symfony\Component\Serializer\Annotation\SerializedName;

class Videos
{
    /** @var Video[] */
    public array $data = [];
    /** @var Paging */
    public Paging $paging;
    /**
     * @var string
     * @SerializedName("total_count")
     */
    public string $totalCount;
}
