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
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use OpenPayments\Contracts\AuthenticatedClientInterface;
use OpenPayments\Config\Config;
use OpenPayments\Contracts\WalletAddressRoutes;
use OpenPayments\Http\ApiRequest;
use OpenPayments\Services\WalletAddressService;
use OpenPayments\Services\IncomingPaymentService;
use OpenPayments\Services\OutgoingPaymentService;
use OpenPayments\Services\QuoteService;
use OpenPayments\OpenApi\Generated\WalletAddressServer\Client as OpenApiWalletAddressServerClient;
use OpenPayments\OpenApi\Generated\ResourceServer\Client as OpenApiResourceServerClient;
use OpenPayments\OpenApi\Generated\AuthServer\Client as OpenApiAuthServerClient;
use OpenPayments\Services\GrantService;
use OpenPayments\Validators\GrantValidator;
use OpenPayments\Validators\IncomingPaymentValidator;
use OpenPayments\Validators\OutgoingPaymentValidator;
use OpenPayments\Validators\QuoteValidator;

/**
 * Client
 */
class AuthenticatedClient implements AuthenticatedClientInterface
{
    protected GuzzleClient $httpClient;
    protected OpenApiWalletAddressServerClient $openApiClient;
    private WalletAddressService $walletAddressService;
    private IncomingPaymentService $incomingPaymentService;
    private QuoteService $quoteService;
    private OutgoingPaymentService $outgoingPaymentService;
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

        // Create a logger instance
        $logger = new Logger('custom_logger');
        $logger->pushHandler(new StreamHandler('php://stdout'));
        
    }
    
    /**
     * walletService
     *
     * @return WalletAddressService
     */
    public function walletAddress(): WalletAddressRoutes
    {
        $this->httpClient = new GuzzleClient(
            [
            'base_uri' => $this->config->getWalletAddressUrl(),
            'handler' => $this->prependWalletAddressPathMiddlewareStack(),
            'headers' => [],
            'debug' => false
            ]
        );
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

    public function outgoingPayment(string $resourceServer, $accessToken): OutgoingPaymentService
    {

        $this->httpClient = new GuzzleClient(
            [
            'base_uri' => $resourceServer,
            'handler' => $this->generateHttpSignatureStack($accessToken),
            'headers' => [],
            'debug' => false
            ]
        );

        $requestFactory = new Psr17Factory();
        //JSON_UNESCAPED_SLASHES
        $jsonEncode = new JsonEncode([
            'json_encode_options' => JSON_UNESCAPED_SLASHES,
        ]);
        $serializer = new Serializer(
            [new ObjectNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder($jsonEncode)]
        );
        $streamFactory = new Psr17Factory();

        $openApiClient = new OpenApiResourceServerClient(
            $this->httpClient,
            $requestFactory,
            $serializer,
            $streamFactory
        );
        $this->outgoingPaymentService =  new OutgoingPaymentService($openApiClient, new OutgoingPaymentValidator());
        return $this->outgoingPaymentService;

    }

    public function incomingPayment(string $resourceServer, $accessToken): IncomingPaymentService
    {

        $this->httpClient = new GuzzleClient(
            [
            'base_uri' => $resourceServer,
            'handler' => $this->generateHttpSignatureStack($accessToken),
            'headers' => [],
            'debug' => false
            ]
        );

        $requestFactory = new Psr17Factory();
        //JSON_UNESCAPED_SLASHES
        $jsonEncode = new JsonEncode([
            'json_encode_options' => JSON_UNESCAPED_SLASHES,
        ]);
        $serializer = new Serializer(
            [new ObjectNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder($jsonEncode)]
        );
        $streamFactory = new Psr17Factory();

        $openApiClient = new OpenApiResourceServerClient(
            $this->httpClient,
            $requestFactory,
            $serializer,
            $streamFactory
        );
        $this->incomingPaymentService =  new IncomingPaymentService($openApiClient, new IncomingPaymentValidator());
        return $this->incomingPaymentService;
    }

    public function quote(string $resourceServer, $accessToken): QuoteService
    {

        $this->httpClient = new GuzzleClient(
            [
            'base_uri' => $resourceServer,
            'handler' => $this->generateHttpSignatureStack($accessToken),
            'headers' => [],
            'debug' => false
            ]
        );

        $requestFactory = new Psr17Factory();
        //JSON_UNESCAPED_SLASHES
        $jsonEncode = new JsonEncode([
            'json_encode_options' => JSON_UNESCAPED_SLASHES,
        ]);
        $serializer = new Serializer(
            [new ObjectNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder($jsonEncode)]
        );
        $streamFactory = new Psr17Factory();

        $openApiClient = new OpenApiResourceServerClient(
            $this->httpClient,
            $requestFactory,
            $serializer,
            $streamFactory
        );
        $this->quoteService =  new QuoteService($openApiClient, new QuoteValidator());
        return $this->quoteService;
    }

    private function generateHttpSignatureStack(string $accessToken = ''): HandlerStack
    {
        $decodedPrivateKey = base64_decode($this->config->getPrivateKey());
        
        $keyId = $this->config->getKeyId();
        // Create a handler stack
        $stack = HandlerStack::create();
        // Add middleware for signing requests
        $sig = Middleware::mapRequest(function (RequestInterface $request) use ($keyId, $decodedPrivateKey, $accessToken) {
            if($accessToken !== ''){
                $request = $request->withHeader('Authorization', "GNAP $accessToken");
            }
            
            $requestArr  = [
                'method' => $request->getMethod(),
                'url' => (string) $request->getUri(),
                'headers' => $request->getHeaders(),
                'body' => (string) $request->getBody(),
            ];
            // Call the function
            $result = \OpenPayments\Utils\createHeaders([
                'request' => $requestArr,
                'privateKey' => $decodedPrivateKey,
                'keyId' => $keyId
            ]);
            foreach($result as $key => $value){
                $request = $request->withHeader($key, $value);
            }
            // TO DO validateSignatureHeaders
            //\OpenPayments\Utils\validateSignature( $decodedPrivateKey, ['headers' =>$request->getHeaders()]);

            return $request;
            
        });
        $stack->push($sig, 'signature');

        return $stack;
    }

    // public function addAuthorization(string $accessToken): void
    // {
    //     // Access the existing handler stack
    //     $handlerStack = $this->httpClient->getConfig('handler');

    //     // Add a new middleware to the stack
    //     $newMiddleware = Middleware::mapRequest(function ($request) use ($accessToken) {
    //         // Modify the request (e.g., add a header)
    //         return $request->withHeader('Authorization', "GNAP $accessToken");
    //     });

    //     // Push the new middleware to the start of the stack 
    //     //(executed first so it's used by the signature middleware)
    //     $handlerStack->unshift($newMiddleware, 'authorization');
    // }
    public function grant(string $authServer, string $accessToken = ''): GrantService
    {

        $this->httpClient = new GuzzleClient(
            [
            'base_uri' => $authServer,
            'handler' => $this->generateHttpSignatureStack($accessToken),
            'headers' => [],
            'debug' => false
            ]
        );

        $requestFactory = new Psr17Factory();
        $serializer = new Serializer(
            [new ObjectNormalizer(), new ArrayDenormalizer()], [new JsonEncoder()]
        );
        $streamFactory = new Psr17Factory();

        $openApiClient = new OpenApiAuthServerClient(
            $this->httpClient,
            $requestFactory,
            $serializer,
            $streamFactory
        );
        return new GrantService($openApiClient, new GrantValidator());

    }
    private function prependWalletAddressPathMiddlewareStack()
    {
        $baseUrl = $this->config->getWalletAddressUrl();
        $walletBasePath = parse_url($baseUrl, PHP_URL_PATH) ?: '';
        
        //Create a handler stack
        $stack = HandlerStack::create();
        // Add middleware for signing requests
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
        $stack->push($prependPathMiddleware);

        return $stack;
    }
}
