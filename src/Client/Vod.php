<?php

namespace FGC\DacastPhp\Client;

use FGC\DacastPhp\Exception\RestException;
use FGC\DacastPhp\Objects\Vod\Video;
use FGC\DacastPhp\Objects\Vod\Video\EmbedCode;
use FGC\DacastPhp\Objects\Vod\Videos;
use FGC\DacastPhp\OptionResolver\Vod\Embed;
use FGC\DacastPhp\OptionResolver\Vod\Search;
use FGC\DacastPhp\OptionResolver\Vod\Upload;
use FGC\DacastPhp\Traits\ClientTrait;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

class Vod
{
    use ClientTrait;

    public function list(array $options = []): Videos
    {
        return $this->send(
            'get',
            '/v2/vod',
            [
                RequestOptions::QUERY => Search::resolve($options),
                RequestOptions::HEADERS => [
                    'X-Format' => 'default',
                ],
            ],
            Videos::class
        );
    }

    public function fetchDetail(string $id): Video
    {
        return $this->send(
            'get',
            sprintf('/v2/vod/%s', $id),
            [],
            Video::class
        );
    }

    public function fetch(string $id): Videos\Video
    {
        return $this->send(
            'get',
            sprintf('/v2/vod/%s', $id),
            [
                RequestOptions::HEADERS => [
                    'X-Format' => 'default',
                ],
            ],
            Videos\Video::class
        );
    }

    public function embed(string $id, array $options = [])
    {
        $options = Embed::resolve($options);
        return $this->send(
            'get',
            sprintf('/v2/vod/%s/embed/%s', $id, $options['embed_type']),
            [
                RequestOptions::QUERY => array_intersect_key(
                    $options,
                    ['height' => true, 'width' => true]
                ),
            ],
            EmbedCode::class
        );
    }

    public function delete(string $id): void
    {
        $this->send('delete',sprintf('/v2/vod/%s', $id));
    }

    public function upload($handle, array $options = [], callable $progress = null, callable $complete = null)
    {
        if (!is_resource($handle)) {
            throw new \InvalidArgumentException('$handle must be a resource to upload.');
        }
        $options = Upload::resolve($options);
        try {
            $tokenResponse = $this->client->request(
                'post',
                '/v2/vod',
                [
                    RequestOptions::JSON => $options,
                    RequestOptions::HEADERS => [
                        'X-Api-Key' => $this->apiKey,
                        'X-Format' => 'default',
                    ],
                ]
            );
        } catch (GuzzleException $e) {
            throw new RestException($e);
        }
        $token = $this->serializer->decode($tokenResponse->getBody()->getContents(), 'json');
        $file = [];
        foreach ([
            'acl',
            'bucket',
            'key',
            'policy',
            'success_action_status',
            'x-amz-algorithm',
            'x-amz-credential',
            'x-amz-date',
            'x-amz-signature',
            'file',
                     ] as $key) {
            if (array_key_exists($key, $token)) {
                $file[] = [
                    'name' => $key,
                    'contents' => $token[$key]
                ];
            } elseif ('file' === $key) {
                $file[] = [
                    'name' => 'file',
                    'filename' => $options['source'],
                    'contents' => $handle,
                ];
            }
        }
        $request = $this->client->requestAsync(
            'post',
            'https://upload.dacast.com', //'https://vzaar-upload.s3.amazonaws.com/', //
            [
                RequestOptions::MULTIPART => $file,
                RequestOptions::PROGRESS => function ($downloadTotal, $downloadedBytes, $uploadTotal, $uploadedBytes) use ($progress) {
                    if (null !== $progress && $uploadTotal > 0 && $uploadedBytes > 0) {
                        $progress([
                            'status' => 200,
                            'message' => 'File is still uploading',
                            'progress' => ($uploadedBytes / $uploadTotal) * 100,
                        ]);
                    }
                },
            ]
        );
        if (is_callable($complete)) {
            $request->then(function () use ($complete, $token) {
                return $complete($token);
            });
        }

        return $request->wait();
    }
}
