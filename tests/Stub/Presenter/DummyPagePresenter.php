<?php


namespace Jokuf\Site\Tests\Stub\Presenter;


use Jokuf\Site\Service\Boundary\PagePresenterInterface;
use Jokuf\Site\Service\Model\ConcretePageResponseDto;
use Jokuf\Site\Service\Model\DeletePageResponseDto;
use Jokuf\Site\Service\Model\PageCollectionResponseDto;

class DummyPagePresenter implements PagePresenterInterface
{
    /** @var ConcretePageResponseDto */
    public $value;

    public function present(ConcretePageResponseDto $response): void
    {
        $this->value = $response;
    }

    public function presentSinglePage(ConcretePageResponseDto $response): void
    {
        $this->value = $response;

    }

    public function presentCollection(PageCollectionResponseDto $response): void
    {
        $this->value = $response;
    }

    public function presentDeletedPage(DeletePageResponseDto $response): void
    {
        $this->value = $response;
    }
}