<?php


namespace Jokuf\Site\Tests\Stub\Presenter;


use Jokuf\Site\Boundary\CreatePagePresenterInterface;
use Jokuf\Site\DTO\CreatePageRequestDto;
use Jokuf\Site\DTO\ConcretePageResponseDto;

class DummyCreatePagePresenterInterface implements CreatePagePresenterInterface
{

    public function present(ConcretePageResponseDto $response): void
    {
        // TODO: Implement present() method.
    }
}