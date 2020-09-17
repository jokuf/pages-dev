<?php


namespace Jokuf\Site\Tests\Stub\Presenter;


use Jokuf\Site\Boundary\CreatePagePresenterInterface;
use Jokuf\Site\DTO\CreatePageRequestDto;
use Jokuf\Site\DTO\CreatePageResponseDto;

class DummyCreatePagePresenterInterface implements CreatePagePresenterInterface
{

    public function present(CreatePageResponseDto $response): void
    {
        // TODO: Implement present() method.
    }
}