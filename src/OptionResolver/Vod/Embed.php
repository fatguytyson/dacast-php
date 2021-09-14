<?php

namespace FGC\DacastPhp\OptionResolver\Vod;

use FGC\DacastPhp\Traits\OptionsResolverTrait;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Embed
{
    use OptionsResolverTrait;
    protected static OptionsResolver $resolver;

    protected static function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->define('embed_type')
            ->allowedValues('javascript', 'iframe')
            ->default('javascript');
        $resolver->define('width')
            ->allowedTypes('int', 'float');
        $resolver->define('height')
            ->allowedTypes('int', 'float');
    }
}