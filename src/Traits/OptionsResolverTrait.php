<?php

namespace FGC\DacastPhp\Traits;

use Symfony\Component\OptionsResolver\OptionsResolver;

trait OptionsResolverTrait
{
    public static function resolve(array $options = []): array
    {
        return static::getResolver()->resolve($options);
    }

    public static function getDefined(): array
    {
        return static::getResolver()->getDefinedOptions();
    }

    protected static function getResolver(): OptionsResolver
    {
        if (!isset(static::$resolver)) {
            static::$resolver = new OptionsResolver();
            static::configureOptions(static::$resolver);
        }

        return static::$resolver;
    }

    protected static function configureOptions(OptionsResolver $resolver): void
    {
    }
}
