<?php

namespace FGC\DacastPhp\Objects\Vod\Video;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Target
{
    /**
     * @var string
     * @SerializedName("target-id")
    **/
    public string $targetId;
    /**
     * @var string
     * @SerializedName("target-type")
    **/
    public string $targetType;
    /**
     * @var Properties
     * @SerializedName("target-properties")
    **/
    public Properties $targetProperties;
}
