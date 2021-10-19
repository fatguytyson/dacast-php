<?php

namespace FGC\DacastPhp\Traits;

use Doctrine\Common\Annotations\AnnotationReader;
use FGC\DacastPhp\Exception\RestException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

trait ClientTrait
{
    private string $apiKey;
    private ClientInterface $client;
    private SerializerInterface $serializer;

    public function __construct(string $apiKey, ClientInterface $client = null, SerializerInterface $serializer = null)
    {
        $this->apiKey = $apiKey;
        $this->client = $client ?? new Client([
            'base_uri' => 'https://developer.dacast.com/',
        ]);
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $this->serializer = $serializer ?? new Serializer([
            new DateTimeNormalizer(),
            new ObjectNormalizer(
                $classMetadataFactory,
                new MetadataAwareNameConverter($classMetadataFactory),
                null,
                new PhpDocExtractor()
            ),
            new ArrayDenormalizer(),
        ], [
            new JsonEncoder(),
            new XmlEncoder()
        ]);
    }

    /**
     * @throws ExceptionInterface
     * @throws RestException
     * @template ReturnClass of object
     * @psalm-param class-string<ReturnClass> $returnClass
     * @psalm-return ReturnClass
     */
    protected function send(string $method, string $url, array $options = [], string $returnClass = null)
    {
        if (isset($options[RequestOptions::JSON]) && is_object($options[RequestOptions::JSON])) {
            $options[RequestOptions::BODY] = $this->serializer->serialize($options[RequestOptions::JSON], 'json');
        }
        if (isset($options[RequestOptions::QUERY]) && is_object($options[RequestOptions::QUERY])) {
            $options[RequestOptions::QUERY] = $this->serializer->normalize($options[RequestOptions::QUERY], 'json');
        }
        if (!isset($options[RequestOptions::HEADERS])) {
            $options[RequestOptions::HEADERS] = [];
        }
        $options[RequestOptions::HEADERS]['X-Api-Key'] = $this->apiKey;
        try {
            $response = $this->client->request($method, $url, $options);
        } catch (GuzzleException $e) {
            throw new RestException($e);
        }
        if (null === $returnClass) {
            return null;
        }

        return $this->serializer->deserialize(
            $response->getBody()->getContents(),
            $returnClass,
            'json'
        );
    }
}
