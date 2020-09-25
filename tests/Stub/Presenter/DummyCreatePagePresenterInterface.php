<?php


namespace Jokuf\Site\Tests\Stub\Presenter;


use Jokuf\Site\Service\Boundary\CreatePagePresenterInterface;
use Jokuf\Site\Service\Model\CreatePageRequestDto;
use Jokuf\Site\Service\Model\ConcretePageResponseDto;

class DummyCreatePagePresenterInterface implements CreatePagePresenterInterface
{
    /** @var ConcretePageResponseDto */
    public $value;

    public function present(ConcretePageResponseDto $response): void
    {
        $this->value = $response;
    }
}