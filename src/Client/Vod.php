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
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;
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
            ],
            Videos::class
        );
    }

    public function fetch(string $id): Video
    {
        return $this->send(
            'get',
            sprintf('/v2/vod/%s', $id),
            [],
            Video::class
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
                ]
            );
        } catch (GuzzleException $e) {
            throw new RestException($e);
        }
        $token = $this->serializer->decode($tokenResponse->getBody()->getContents(), 'json');
        $file = [[
            'name' => 'file',
            'filename' => $options['source'],
            'contents' => $handle,
        ]];
        foreach ($token as $key => $value) {
            $file[] = [
                'name'      => $key,
                'contents'  => $value
            ];
        }
        dump($file);
        $request = $this->client->requestAsync(
            'post',
            'http://upload.dacast.com',
            [
                RequestOptions::MULTIPART => $file,
                RequestOptions::HEADERS => null,
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
