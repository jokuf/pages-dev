<?php


namespace Jokuf\Site\Tests\Stub\Presenter;


use Jokuf\Site\Service\Boundary\GetPagePresenterInterface;
use Jokuf\Site\Service\Model\ConcretePageResponseDto;

class GetPagePresenter implements GetPagePresenterInterface
{
    /** @var ConcretePageResponseDto */
    public $value;

    public function present(ConcretePageResponseDto $response)
    {
        $this->value = $response;
    }
}