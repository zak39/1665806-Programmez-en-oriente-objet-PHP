<?php

declare(strict_types=1);

namespace Domain\Display;

class MessagePrinter
{
    public function printMessage(MessageInterface $message) {
        echo(sprintf(
            '%s %s',
            $message->getContent(),
            $message->getAuthor()->name
        ) . PHP_EOL);
    }
}
