<?php

declare(strict_types=1);

namespace FGC\DacastPhp\Objects\Vod;

use Symfony\Component\Serializer\Annotation\SerializedName;

class UploadResponse
{
    /**
     * @var string
     * @SerializedName("Location")
     */
    public string $location;
    /**
     * @var string
     * @SerializedName("Bucket")
     */
    public string $bucket;
    /**
     * @var string
     * @SerializedName("Key")
     */
    public string $key;
    /**
     * @var string
     * @SerializedName("ETag")
     */
    public string $eTag;
}