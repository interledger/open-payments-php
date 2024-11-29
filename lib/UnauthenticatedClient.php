<?php

declare(strict_types=1);

namespace OpenPayments;

require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Nyholm\Psr7\Factory\Psr17Factory;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use OpenPayments\Config\Config;
use OpenPayments\Contracts\UnauthenticatedClientInterface;
use OpenPayments\Http\ApiRequest;
use OpenPayments\Services\WalletAddressService;
use OpenPayments\Services\PublicIncomingPaymentService;
use OpenPayments\OpenApi\Generated\WalletAddressServer\Client as OpenApiWalletAddressServerClient;
use OpenPayments\OpenApi\Generated\ResourceServer\Client as OpenApiResourceServerClient;
/**
 * Client
 */
class UnauthenticatedClient implements UnauthenticatedClientInterface
{
    protected GuzzleClient $httpClient;
    //protected OpenApiClient $openApiClient;
    protected ApiRequest $apiRequest;
    private WalletAddressService $walletAddressService;

    /**
     * __construct
     *
     * @param OpenPayments\Config\Config $config
     * return void
     */
    public function __construct(Config $config)
    {
        $baseUrl = $config->getWalletAddressUrl();
        $walletBasePath = parse_url($baseUrl, PHP_URL_PATH) ?: '';

        $prependPathMiddleware = Middleware::mapRequest(
            function (RequestInterface $request) use ($walletBasePath) {
                $uri = $request->getUri();
                if ($walletBasePath
                    && strpos($uri->getPath(), $walletBasePath) !== 0
                ) {
                    $newUri = $uri->withPath($walletBasePath . $uri->getPath());
                    return $request->withUri($newUri);
                }
                return $request;
            }
        );

        // Create a HandlerStack and push the middleware
        $stack = HandlerStack::create();
        $stack->push($prependPathMiddleware);

        $this->httpClient = new GuzzleClient(
            [
            'base_uri' => $config->getWalletAddressUrl(),
            'handler' => $stack,
            'headers' => [
            ],
            //'debug' => true
            ]
        );


        
    }

    /**
     * walletService
     *
     * @return WalletAddressService
     */
    public function walletAddress(): WalletAddressService
    {
        $requestFactory = new Psr17Factory();
        $serializer = new Serializer(
            [new ObjectNormalizer(), new ArrayDenormalizer()], [new JsonEncoder()]
        );
        $streamFactory = new Psr17Factory();

        $openApiClient = new OpenApiWalletAddressServerClient(
            $this->httpClient,
            $requestFactory,
            $serializer,
            $streamFactory
        );
        $this->walletAddressService =  new WalletAddressService($openApiClient);
        return $this->walletAddressService;
    }

    /**
     * walletService
     *
     * @return PublicIncomingPaymentService
     */
    public function incomingPayment(): PublicIncomingPaymentService
    {
        $requestFactory = new Psr17Factory();
        $serializer = new Serializer(
            [new ObjectNormalizer(), new ArrayDenormalizer()], [new JsonEncoder()]
        );
        $streamFactory = new Psr17Factory();

        $openApiClient = new OpenApiResourceServerClient(
            $this->httpClient,
            $requestFactory,
            $serializer,
            $streamFactory
        );
        return new PublicIncomingPaymentService($openApiClient);
    }
}
