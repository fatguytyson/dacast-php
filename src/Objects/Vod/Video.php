<?php

namespace FGC\DacastPhp\Objects\Vod;

use FGC\DacastPhp\Objects\Vod\Video\Metadata;
use FGC\DacastPhp\Objects\Vod\Video\Target;
use FGC\DacastPhp\Objects\Vod\Video\Theme;
use Symfony\Component\Serializer\Annotation\SerializedName;

class Video
{
    /** @var Metadata */
    public Metadata $metadata;
    /** @var Target[] */
    public array $targets;
    /** @var string[] */
    public array $folders;
    /** @var Theme */
    public Theme $theme;
    /**
     * @var string|null
     * @SerializedName("legacy_id")
    **/
    public ?string $legacyId;
    /**
     * @var string
     * @SerializedName("user_id")
    **/
    public string $userId;
    /**
     * @var string
     * @SerializedName("account_id")
    **/
    public string $accountId;
}
