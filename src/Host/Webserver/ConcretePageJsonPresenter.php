<?php


namespace Jokuf\Site\Host\Webserver;


use Jokuf\Site\Service\Boundary\CreatePagePresenterInterface;
use Jokuf\Site\Service\Boundary\GetPagePresenterInterface;
use Jokuf\Site\Service\Boundary\UpdatePagePresenterInterface;
use Jokuf\Site\Service\Model\ConcretePageResponseDto;

class ConcretePageJsonPresenter implements CreatePagePresenterInterface, UpdatePagePresenterInterface, GetPagePresenterInterface
{
    public function present(ConcretePageResponseDto $response): void
    {
        fwrite(STDOUT, json_encode([
            'name'    => $response->getName(),
            'title'   => $response->getTitle(),
            'content' => $response->getContent(),
            'slug'    => $response->getSlug(),
            'tags'    => $response->getTags(),
            'level'   => $response->getLevel(),
            'locked'  => $response->isLocked()
        ], JSON_PRETTY_PRINT));
    }
}