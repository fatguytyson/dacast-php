<?php

namespace FGC\DacastPhp\Objects\Vod\Video;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Properties
{
    /**
     * @var string
     * @SerializedName("asset-storage-id")
    **/
    public string $assetStorageId;
    /**
     * @var string
     * @SerializedName("asset-storage-url")
    **/
    public string $assetStorageUrl;
    /**
     * @var string
     * @SerializedName("language-long-name")
    **/
    public string $languageLongName;
    /**
     * @var string
     * @SerializedName("language-short-name")
    **/
    public string $languageShortName;
    /** @var string */
    public string $name;
}
