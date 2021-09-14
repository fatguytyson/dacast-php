<?php

namespace FGC\DacastPhp\Objects\Vod\Video;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Rendition
{
    /**
     * @var string
     * @SerializedName("file-location")
    **/
    public string $fileLocation;
    /**
     * @var string
     * @SerializedName("rendition-id")
    **/
    public string $renditionId;
    /**
     * @var string
     * @SerializedName("rendition-name")
    **/
    public string $renditionName;
    /**
     * @var string
     * @SerializedName("transcoding-job-id")
    **/
    public string $transcodingJobId;
    /**
     * @var Info
     * @SerializedName("video-info")
    **/
    public Info $videoInfo;
}
