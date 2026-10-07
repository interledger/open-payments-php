<?php

declare(strict_types=1);

namespace OpenPayments\Models;

class Grant
{
    public readonly ?AccessToken $access_token;

    public readonly GrantContinue $continue;

    public readonly ?Subject $subject;

    public function __construct(?AccessToken $access_token, GrantContinue $continue, ?Subject $subject = null)
    {
        $this->access_token = $access_token;
        $this->continue = $continue;
        $this->subject = $subject;
    }
}
