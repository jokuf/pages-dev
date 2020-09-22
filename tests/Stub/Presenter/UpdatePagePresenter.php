<?php


namespace Jokuf\Site\Tests\Stub\Presenter;


use Jokuf\Site\DTO\ConcretePageResponseDto;

class UpdatePagePresenter implements \Jokuf\Site\Boundary\UpdatePageResponseInterface
{
    /** @var ConcretePageResponseDto */
    public $value;

    public function present(ConcretePageResponseDto $response): void
    {
        $this->value = $response;
    }
}