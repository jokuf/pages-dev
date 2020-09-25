<?php


namespace Jokuf\Site\Tests\Stub\Presenter;


use Jokuf\Site\Service\Model\ConcretePageResponseDto;

class UpdatePagePresenter implements \Jokuf\Site\Service\Boundary\UpdatePagePresenterInterface
{
    /** @var ConcretePageResponseDto */
    public $value;

    public function present(ConcretePageResponseDto $response): void
    {
        $this->value = $response;
    }
}