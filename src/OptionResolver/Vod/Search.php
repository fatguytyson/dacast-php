<?php

namespace FGC\DacastPhp\OptionResolver\Vod;

use FGC\DacastPhp\OptionResolver\PageOptions;
use Symfony\Component\OptionsResolver\Exception\InvalidArgumentException;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Search extends PageOptions
{
    protected static OptionsResolver $resolver;

    protected static function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
        $resolver->define('title')
            ->allowedTypes('string');
        $resolver->define('online')
            ->allowedTypes('bool');
        $resolver->define('order_by')
            ->allowedValues('duration', 'title', 'online', 'streamable', 'creation_date');
        $resolver->define('creation_date')
            ->normalize(function (Options $options, $value) {
                return self::normalizeDate($options, $value);
            })
            ->info('format : \'YYYY-MM-DD\'');
        $resolver->define('start_date')
            ->normalize(function (Options $options, $value) {
                return self::normalizeDate($options, $value);
            })
            ->info('format : \'YYYY-MM-DD\'');
        $resolver->define('end_date')
            ->normalize(function (Options $options, $value) {
                return self::normalizeDate($options, $value);
            })
            ->info('format : \'YYYY-MM-DD\'');
    }

    private static function normalizeDate(Options $options, $value): string
    {
        try {
            return $value instanceof \DateTimeInterface
                ? $value->format('Y-m-d')
                : (new \DateTimeImmutable($value))->format('Y-m-d');
        } catch (\Exception $exception) {
            throw new InvalidArgumentException('Must be parsable to DateTime object.');
        }
    }
}
