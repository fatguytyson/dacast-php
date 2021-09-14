<?php

namespace FGC\DacastPhp\OptionResolver\Vod;

use FGC\DacastPhp\Traits\OptionsResolverTrait;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Upload
{
    use OptionsResolverTrait;
    protected static OptionsResolver $resolver;

    protected static function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->define('source')
            ->default(sprintf('video %s', rand(0, 15)))
            ->allowedTypes('string')
            ->info('This is the file name to be uploaded.');
        $resolver->define('callback_url')
            ->default('http://dacast.com')
            ->allowedTypes('string')
            ->info('Due to the async nature of the process, the callback URL is mandatory in order to be informed when the process is over and the file is available.');
        $resolver->define('token_js')
            ->default(true)
            ->allowedTypes('bool')
            ->info('This option is not documented.'); // TODO
        $resolver->define('upload_type')
            ->allowedValues('curl', 'ajax', 'ajax_queue')
            ->default('ajax')
            ->info('Documentation says `ajax|curl|` but passes `ajax_queue`...'); // TODO
        $resolver->define('auto_encoding')
            ->default(0)
            ->allowedValues(0, 1, true, false)
            ->normalize(function (Options $options, $value) {
                return ((bool) $value) ? 1 : 0;
            })
            ->info('Launch autoencoding of the file after integration (passthrough). Documentation says boolean, but lists `0|1`....'); // TODO
        $resolver->define('parent_id')
            ->allowedTypes('string')
            ->info('ID of the Vod parent. Use it to bind 2 or more vods. After uploading the hightest quality of a vod, you can upload lower quality and bind them to the main file to create multibitrate videos');
    }
}
