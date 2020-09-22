<?php


namespace Jokuf\Site\Tests\Stub\Presenter;


use Jokuf\Site\Boundary\DeletePagePresenterInterface;
use Jokuf\Site\DTO\DeletePageResponseDto;

class DeletePagePresenter implements DeletePagePresenterInterface
{
    /** @var DeletePageResponseDto */
    public $value;

    public function present(DeletePageResponseDto $response): void
    {
        $this->value = $response;
    }
}