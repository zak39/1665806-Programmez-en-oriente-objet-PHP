<?php

namespace Domain\Display;

use Domain\User\User;

interface AuthorAwareInterface
{
    public function getAuthor(): User;
}