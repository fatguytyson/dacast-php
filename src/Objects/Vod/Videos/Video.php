<?php

namespace FGC\DacastPhp\Objects\Vod\Videos;

use DateTimeImmutable;
use Symfony\Component\Serializer\Annotation\SerializedName;

class Video
{
    /** @var int|null **/
    public ?int $abitrate = null;
    /** @var string|null **/
    public ?string $acodec = null;
    /** @var array|null **/
    public ?array $ads = null;
    /**
     * @var string|null
     * @SerializedName("associated_packages")
    **/
    public ?string $associatedPackages = null;
    /** @var bool|null **/
    public ?bool $autoplay = null;
    /**
     * @var int|null
     * @SerializedName("category_id")
    **/
    public ?int $categoryId = null;
    /** @var string **/
    public string $container;
    /**
     * @var string
     * @SerializedName("countries_id")
    **/
    public string $countriesId;
    /**
     * @var DateTimeImmutable
     * @SerializedName("creation_date")
    **/
    public DateTimeImmutable $creationDate;
    /**
     * @var array|null
     * @SerializedName("custom_data")
    **/
    public ?array $customData;
    /** @var string **/
    public string $description;
    /**
     * @var int
     * @SerializedName("disk_usage")
    **/
    public int $diskUsage;
    /** @var string **/
    public string $duration;
    /**
     * @var bool
     * @SerializedName("enable_coupon")
    **/
    public bool $enableCoupon;
    /**
     * @var bool
     * @SerializedName("enable_payperview")
    **/
    public bool $enablePayperview;
    /**
     * @var bool
     * @SerializedName("enable_subscription")
    **/
    public bool $enableSubscription;
    /**
     * @var string
     * @SerializedName("external_video_page")
    **/
    public string $externalVideoPage;
    /** @var string **/
    public string $filename;
    /** @var string **/
    public string $filesize;
    /**
     * @var int
     * @SerializedName("google_analytics")
    **/
    public int $googleAnalytics;
    /**
     * @var int
     * @SerializedName("group_id")
    **/
    public int $groupId;
    /** @var string **/
    public string $hds;
    /** @var string **/
    public string $hls;
    /** @var string **/
    public string $id;
    /**
     * @var bool
     * @SerializedName("is_secured")
    **/
    public bool $isSecured;
    /**
     * @var int
     * @SerializedName("noframe_security")
    **/
    public int $noframeSecurity;
    /** @var bool **/
    public bool $online;
    /**
     * @var string
     * @SerializedName("original_id")
    **/
    public string $originalId;
    /** @var string **/
    public string $password;
    /** @var Pictures **/
    public Pictures $pictures;
    /**
     * @var int
     * @SerializedName("player_height")
    **/
    public int $playerHeight;
    /**
     * @var int
     * @SerializedName("player_width")
    **/
    public int $playerWidth;
    /**
     * @var bool
     * @SerializedName("publish_on_dacast")
    **/
    public bool $publishOnDacast;
    /**
     * @var string
     * @SerializedName("referers_id")
    **/
    public string $referersId;
    /**
     * @var DateTimeImmutable
     * @SerializedName("save_date")
    **/
    public DateTimeImmutable $saveDate;
    /**
     * @var ShareCode
     * @SerializedName("share_code")
    **/
    public ShareCode $shareCode;
    /**
     * @var int
     * @SerializedName("splashscreen_id")
    **/
    public int $splashscreenId;
    /** @var int **/
    public int $streamable;
    /** @var array|null **/
    public ?array $subtitles;
    /**
     * @var int
     * @SerializedName("template_id")
    **/
    public int $templateId;
    /**
     * @var int
     * @SerializedName("thumbnail_id")
    **/
    public int $thumbnailId;
    /** @var string **/
    public string $title;
    /** @var int **/
    public int $vbitrate;
    /** @var string **/
    public string $vcodec;
    /**
     * @var int
     * @SerializedName("video_height")
    **/
    public int $videoHeight;
    /**
     * @var int
     * @SerializedName("video_width")
    **/
    public int $videoWidth;
}
