<?php

namespace FGC\DacastPhp\Objects\Vod\Video;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Metadata
{
    /** @var string */
    public string $id;
    /**
     * @var string
     * @SerializedName("storage-id")
    **/
    public string $storageId;
    /** @var string */
    public string $title;
    /** @var bool */
    public bool $autoplay;
    /** @var bool */
    public bool $online;
    /**
     * @var bool
     * @SerializedName("start-muted")
    **/
    public bool $startMuted;
    /** @var bool */
    public bool $loop;
    /** @var string */
    public string $description;
    /**
     * @var string|null
     * @SerializedName("geo-restriction-id")
    **/
    public ?string $geoRestrictionId;
    /**
     * @var string|null
     * @SerializedName("domain-restriction-id")
    **/
    public ?string $domainRestrictionId;
    /**
     * @var string|null
     * @SerializedName("password-protection-password")
    **/
    public ?string $passwordProtectionPassword;
    /**
     * @var string|null
     * @SerializedName("end-screen-text")
    **/
    public ?string $endScreenText;
    /**
     * @var string|null
     * @SerializedName("end-screen-link")
    **/
    public ?string $endScreenLink;
    /**
     * @var bool
     * @SerializedName("aes-enabled")
    **/
    public bool $aesEnabled;
    /**
     * @var string
     * @SerializedName("player-show-big-play-button-before-playback")
    **/
    public string $playerShowBigPlayButtonBeforePlayback;
    /**
     * @var string
     * @SerializedName("player-show-controls-before-playback")
    **/
    public string $playerShowControlsBeforePlayback;
    /**
     * @var string|null
     * @SerializedName("countdown-timestamp")
    **/
    public ?string $countdownTimestamp;
    /**
     * @var string|null
     * @SerializedName("watermark-position")
    **/
    public ?string $watermarkPosition;
    /**
     * @var string|null
     * @SerializedName("watermark-size")
    **/
    public ?string $watermarkSize;
    /**
     * @var string|null
     * @SerializedName("watermark-image-asset-id")
    **/
    public ?string $watermarkImageAssetId;
    /**
     * @var string|null
     * @SerializedName("watermark-link-urk")
    **/
    public ?string $watermarkLinUrk;
    /**
     * @var string|null
     * @SerializedName("watermark-opacity")
    **/
    public ?string $watermarkOpacity;
    /**
     * @var string|null
     * @SerializedName("text-watermark-text")
    **/
    public ?string $textWatermarkText;
    /**
     * @var string|null
     * @SerializedName("text-watermark-url")
    **/
    public ?string $textWatermarkUrl;
    /**
     * @var string|null
     * @SerializedName("content-scheduling-start-time")
    **/
    public ?string $contentSchedulingStartTime;
    /**
     * @var string|null
     * @SerializedName("content-scheduling-end-time")
    **/
    public ?string $contentSchedulingEndTime;
    /**
     * @var bool
     * @SerializedName("enable-preview-thubnail")
    **/
    public bool $enablePreviewThubnail;
    /**
     * @var int
     * @SerializedName("creation-date")
    **/
    public int $creationDate;
    /**
     * @var bool
     * @SerializedName("paywall-enabled")
    **/
    public bool $paywallEnabled;
    /**
     * @var string|null
     * @SerializedName("countdown-timezone")
    **/
    public ?string $countdownTimezone;
    /**
     * @var string|null
     * @SerializedName("watermark-padding")
    **/
    public ?string $watermarkPadding;
    /**
     * @var string|null
     * @SerializedName("content-scheduling-start-time-timezone")
    **/
    public ?string $contentSchedulingStartTimeTimezone;
    /**
     * @var string|null
     * @SerializedName("content-scheduling-end-time-timezone")
    **/
    public ?string $contentSchedulingEndTimeTimezone;
    /**
     * @var string|null
     * @SerializedName("title-as-text-water-mark-text")
    **/
    public ?string $titleAsTextWaterMarkText;
    /**
     * @var string|null
     * @SerializedName("google-analytics-code")
    **/
    public ?string $googleAnalyticsCode;
    /** @var string|null */
    public ?string $ads;
    /**
     * @var Info
     * @SerializedName("video-info")
    **/
    public Info $videoInfo;
    /**
     * @var Rendition[]
     * @SerializedName("rendition-list")
    **/
    public array $renditionList;
    /**
     * @var string
     * @SerializedName("iframe-link")
    **/
    public string $iframeLink;
    /**
     * @var string
     * @SerializedName("file-name")
    **/
    public string $fileName;
    /** @var string|null */
    public ?string $hls;
}
