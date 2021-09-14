<?php

namespace FGC\DacastPhp\OptionResolver;

use FGC\DacastPhp\Traits\OptionsResolverTrait;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PageOptions
{
    use OptionsResolverTrait;
    protected static OptionsResolver $resolver;

    protected static function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->define('page')
            ->default(1)
            ->allowedTypes('int')
            ->info('Page number of results.');
        $resolver->define('perpage')
            ->default(10)
            ->allowedTypes('int')
            ->info('Number of results to return per page.');
        $resolver->define('sort')
            ->allowedValues('ASC', 'DESC')
            ->info('If you want to sort by ascending (Asc) or descending (Desc) then add Query string param "sort" as shown below SORT = ASC, DESC');
    }
}
