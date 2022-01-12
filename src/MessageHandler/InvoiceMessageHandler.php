<?php

namespace App\MessageHandler;

use App\Message\InvoiceMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class InvoiceMessageHandler implements MessageHandlerInterface
{
    public function __invoke(InvoiceMessage $message)
    {
        // do something with your message
        print_r($message);
    }
}
