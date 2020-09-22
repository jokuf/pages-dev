<?php


namespace Jokuf\Site\Tests\Stub\Presenter;


use Jokuf\Site\Boundary\GetPagePresenterInterface;
use Jokuf\Site\DTO\ConcretePageResponseDto;

class GetPagePresenter implements GetPagePresenterInterface
{
    /** @var ConcretePageResponseDto */
    public $value;
    public function present(ConcretePageResponseDto $response)
    {
        $this->value = $response;
    }
}