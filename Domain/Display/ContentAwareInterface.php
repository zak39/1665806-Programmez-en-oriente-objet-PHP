<?php

namespace Domain\Display;

interface ContentAwareInterface
{
    public function getContent(): string;
}
