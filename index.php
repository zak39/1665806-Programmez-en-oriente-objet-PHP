<?php

declare(strict_types=1);

namespace Domain\Mixins {
    // Ce trait fourni le nécessaire pour gérer du contenu
    trait ContentAware {
        protected string $content;

        public function getContent() {
            return $this->content;
        }

        public function setContent(string $content) {
            $this->content = $content;
        }
    }


    use Domain\User\User;

    // Ce trait fourni le nécessaire pour gérer un auteur
    trait UserAware {
        protected User $author;

        public function getAuthor() {
            return $this->author;
        }

        public function setAuthor(User $author) {
            $this->author = $author;
        }
    
    }
}

namespace Domain\User {
    class User {
        public function __construct(public string $name)
        {
        }
    }
}

namespace Domain\Forum {
    use Domain\Mixins;

    /**
     * A présent nous avons une classe Message utilisant ces 2 traits.
     * En créant plus tard une seconde classe Message mai appartenant
     * au domaine des notifications par exemple, celle ci pourra utiliser
     * également les traits :)
     */
    class Message {
        use Mixins\ContentAware, Mixins\UserAware;
    }
}


namespace Domain\Notification {
    use Domain\Mixins;

    class Message {
        use Mixins\ContentAware, Mixins\UserAware;
    }
}

namespace {
    use Domain\Forum\Message;
    use Domain\Notification\Message as MessageNotifiaction;
    use Domain\User\User;

    $user = new User('greg');
    $message = new Message;
    $message->setContent('Hello');
    $message->setAuthor($user);

    print(
        sprintf(
            '%s %s',
            $message->getContent(),
            $message->getAuthor()->name
        )
        . PHP_EOL
    );

    $notification = new MessageNotifiaction;
    $notification->setContent('Vous avez recu un message !');
    $notification->setAuthor($user);

    print(
        sprintf(
            '%s %s',
            $notification->getContent(),
            'de la part de ' . $notification->getAuthor()->name
        )
        . PHP_EOL
    );
}