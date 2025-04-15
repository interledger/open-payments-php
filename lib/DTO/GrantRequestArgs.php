<?php

namespace OpenPayments\DTO;

class GrantOrTokenRequestArgs extends UnauthenticatedResourceRequestArgs
{
    public string $accessToken;

    public function __construct(string $url, string $accessToken)
    {
        parent::__construct($url);
        $this->accessToken = $accessToken;
    }
}

// {
//   access: components["schemas"]["access"];
// };

// export type GrantRequest = {
//   access_token: {
//   access: components["schemas"]["access"];
// };
//   client: ASOperations['post-request']['requestBody']['content']['application/json']['client'];
//   interact?: ASOperations['post-request']['requestBody']['content']['application/json']['interact'];
// };
