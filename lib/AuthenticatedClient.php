<?php

declare(strict_types=1);

namespace OpenPayments;

require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\RequestInterface;

use Nyholm\Psr7\Factory\Psr17Factory;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use OpenPayments\Contracts\AuthenticatedClientInterface;
use OpenPayments\Config\Config;
use OpenPayments\Contracts\WalletAddressRoutes;
use OpenPayments\Http\ApiRequest;
use OpenPayments\DTO\CreateUnauthenticatedClientArgs;
use OpenPayments\Models\Grant;
use OpenPayments\Services\WalletAddressService;
use OpenPayments\Services\IncomingPaymentService;
use OpenPayments\OpenApi\Generated\WalletAddressServer\Client as OpenApiWalletAddressServerClient;
use OpenPayments\OpenApi\Generated\ResourceServer\Client as OpenApiResourceServerClient;
use OpenPayments\OpenApi\Generated\AuthServer\Client as OpenApiAuthServerClient;
use OpenPayments\Services\GrantService;

/**
 * Client
 */
class AuthenticatedClient implements AuthenticatedClientInterface
{
    protected GuzzleClient $httpClient;
    protected OpenApiWalletAddressServerClient $openApiClient;
    private WalletAddressService $walletAddressService;
    private IncomingPaymentService $incomingPaymentService;
    protected ApiRequest $apiRequest;
    protected Config $config;

    /**
     * __construct
     *
     * @param OpenPayments\Config\Config $config
     * return void
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
        $baseUrl = $config->getWalletAddressUrl();
        $walletBasePath = parse_url($baseUrl, PHP_URL_PATH) ?: '';

        // $prependPathMiddleware = Middleware::mapRequest(
        //     function (RequestInterface $request) use ($walletBasePath) {
        //         $uri = $request->getUri();
        //         if ($walletBasePath
        //             && strpos($uri->getPath(), $walletBasePath) !== 0
        //         ) {
        //             $newUri = $uri->withPath($walletBasePath . $uri->getPath());
        //             return $request->withUri($newUri);
        //         }
        //         return $request;
        //     }
        // );

        // $decodedPrivateKey = base64_decode($this->config->getPrivateKey());

        // $keyId = $this->config->getKeyId();
        // Create a handler stack
        // $stack = HandlerStack::create();
        // // Add middleware for signing requests
        // $stack->push(Middleware::mapRequest(function (RequestInterface $request) use ($keyId, $decodedPrivateKey) {
        //     // Generate the GNAP Authorization header
        //     $signature = self::generateSignature($request, $decodedPrivateKey);
        //     return $request->withHeader('Authorization', "GNAP $signature")
        //                    ->withHeader('Key-Id', $keyId);
        // }));
        // // Create a HandlerStack and push the middleware
        // //$stack = HandlerStack::create();
        // $stack->push($prependPathMiddleware);


        // Create a logger instance
        $logger = new Logger('custom_logger');
        $logger->pushHandler(new StreamHandler('php://stdout'));
        
        
        $this->httpClient = new GuzzleClient(
            [
            'base_uri' => $config->getWalletAddressUrl(),
            //'handler' => $stack,
            'headers' => [
            ],
            'debug' => true
            ]
        );


        $requestFactory = new Psr17Factory();
        $serializer = new Serializer(
            [new ObjectNormalizer(), new ArrayDenormalizer()], [new JsonEncoder()]
        );
        $streamFactory = new Psr17Factory();

        $this->openApiClient = new OpenApiWalletAddressServerClient(
            $this->httpClient,
            $requestFactory,
            $serializer,
            $streamFactory
        );
    }
    
    /**
     * walletService
     *
     * @return WalletAddressService
     */
    public function walletAddress(): WalletAddressRoutes
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

    public function incomingPayment(): IncomingPaymentService
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
        return new IncomingPaymentService($openApiClient);
    }

    public function addAuthorization(string $accessToken): void
    {
        // Access the existing handler stack
        $handlerStack = $this->httpClient->getConfig('handler');

        // Add a new middleware to the stack
        $newMiddleware = Middleware::mapRequest(function ($request) use ($accessToken) {
            // Modify the request (e.g., add a header)
            return $request->withHeader('Authorization', "GNAP $accessToken");
        });

        // Push the new middleware to the start of the stack 
        //(executed first so it's used by the signature middleware)
        $handlerStack->unshift($newMiddleware, 'authorization');

    }
    public function grant(string $authServer): GrantService
    {
        $decodedPrivateKey = base64_decode($this->config->getPrivateKey());
        

        $keyId = $this->config->getKeyId();
        // Create a handler stack
        $stack = HandlerStack::create();
        // Add middleware for signing requests
        //$decodedPrivateKey = self::convertPemToSodiumKey($decodedPrivateKey);
        $sig = Middleware::mapRequest(function (RequestInterface $request) use ($keyId, $decodedPrivateKey) {
            // Generate the GNAP Authorization header
            // $signature = self::generateSignature($request, $decodedPrivateKey);
            // $request = $request->withHeader('Authorization', "GNAP $signature")
            // ->withHeader('Key-Id', $keyId);
            
            //$request =$request->withBody(Utils::streamFor(json_encode((string) $request->getBody())));
            $requestArr  = [
                'method' => $request->getMethod(),
                'url' => (string) $request->getUri(),
                'headers' => $request->getHeaders(),
                'body' => (string) $request->getBody(),
            ];
            print_r($requestArr);
            // Call the function
            $result = \OpenPayments\Utils\createHeaders([
                'request' => $requestArr,
                'privateKey' => $decodedPrivateKey,
                'keyId' => $keyId
            ]);
            foreach($result as $key => $value){
                $request = $request->withHeader($key, $value);
            }

            //validateSignatureHeaders
            //\OpenPayments\Utils\validateSignature( $decodedPrivateKey, ['headers' =>$request->getHeaders()]);


            return $request;
            
        });
        $stack->push($sig, 'signature');
        // Create a HandlerStack and push the middleware
        

        $httpClient = new GuzzleClient(
            [
            'base_uri' => $authServer,
            'handler' => $stack,
            'headers' => [],
            'debug' => true
            ]
        );

        $requestFactory = new Psr17Factory();
        $serializer = new Serializer(
            [new ObjectNormalizer(), new ArrayDenormalizer()], [new JsonEncoder()]
        );
        $streamFactory = new Psr17Factory();


        $openApiClient = new OpenApiAuthServerClient(
            $httpClient,
            $requestFactory,
            $serializer,
            $streamFactory
        );
        return new GrantService($openApiClient);


    }
}
