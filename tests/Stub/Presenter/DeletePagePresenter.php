<?php


namespace Jokuf\Site\Tests\Stub\Presenter;


use Jokuf\Site\Service\Boundary\DeletePagePresenterInterface;
use Jokuf\Site\Service\Model\DeletePageResponseDto;

class DeletePagePresenter implements DeletePagePresenterInterface
{
    /** @var DeletePageResponseDto */
    public $value;

    public function present(DeletePageResponseDto $response): void
    {
        $this->value = $response;
    }
}