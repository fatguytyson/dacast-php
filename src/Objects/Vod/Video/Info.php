<?php

namespace FGC\DacastPhp\Objects\Vod\Video;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Info
{
    /**
     * @var int
     * @SerializedName("video-bitrate-byte-per-sec")
    **/
    public int $videoBitrateBytePerSec;
    /**
     * @var int
     * @SerializedName("audio-bitrate-byte-per-sec")
    **/
    public int $audioBitrateBytePerSec;
    /**
     * @var float
     * @SerializedName("duration-sec")
    **/
    public float $durationSec;
    /** @var int */
    public int $width;
    /** @var int */
    public int $height;
    /**
     * @var int
     * @SerializedName("rotation-metadata-degrees")
    **/
    public int $rotationMetadataDegrees;
    /** @var int */
    public int $framerate;
    /**
     * @var string
     * @SerializedName("video-codec")
    **/
    public string $videoCodec;
    /**
     * @var string
     * @SerializedName("audio-codec")
    **/
    public string $audioCodec;
    /**
     * @var int
     * @SerializedName("audio-sample-rate-hz")
    **/
    public int $audioSampleRateHz;
    /**
     * @var int
     * @SerializedName("nb-audio-channel")
    **/
    public int $nbAudioChannel;
    /**
     * @var int
     * @SerializedName("file-size")
    **/
    public int $fileSize;
}
