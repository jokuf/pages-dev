<?php


namespace Jokuf\Site\Api;


use Jokuf\Site\Core\Interactor\CreatePageInteractor;
use Jokuf\Site\Core\Interactor\DeletePageInteractor;
use Jokuf\Site\Core\Interactor\GetSinglePageInteractor;
use Jokuf\Site\Core\Interactor\UpdatePageInteractor;
use Jokuf\Site\Service\Boundary\CreatePagePresenterInterface;
use Jokuf\Site\Service\Boundary\DeletePagePresenterInterface;
use Jokuf\Site\Service\Boundary\GetPagePresenterInterface;
use Jokuf\Site\Service\Boundary\UpdatePagePresenterInterface;
use Jokuf\Site\Service\Gateway\PageGatewayInterface;
use Jokuf\Site\Service\Model\CreatePageRequestDto;
use Jokuf\Site\Service\Model\DeletePageRequestDto;
use Jokuf\Site\Service\Model\GetSinglePageBySlugDto;
use Jokuf\Site\Service\Model\UpdatePageRequestDto;

class PageService
{
    /**
     * @var PageGatewayInterface
     */
    protected $gateway;
    /**
     * @var CreatePagePresenterInterface
     */
    protected $createPagePresenter;
    /**
     * @var UpdatePagePresenterInterface
     */
    protected $updatePagePresenter;
    /**
     * @var DeletePagePresenterInterface
     */
    protected $deletePagePresenter;
    /**
     * @var GetPagePresenterInterface
     */
    protected $getPagePresenter;

    public function __construct(
        PageGatewayInterface $gateway,
        CreatePagePresenterInterface $createPagePresenter,
        UpdatePagePresenterInterface $updatePagePresenter,
        DeletePagePresenterInterface $deletePagePresenter,
        GetPagePresenterInterface $getPagePresenter
    )
    {

        $this->gateway = $gateway;
        $this->createPagePresenter = $createPagePresenter;
        $this->updatePagePresenter = $updatePagePresenter;
        $this->deletePagePresenter = $deletePagePresenter;
        $this->getPagePresenter = $getPagePresenter;
    }

    public function create(?string $parentPageSlug, string $name, string $title, string $content, array $tags, int $level, bool $locked, string $template): void
    {
        $interactor = new CreatePageInteractor($this->gateway, $this->createPagePresenter);
        $interactor->handle(
            new CreatePageRequestDto(
                $parentPageSlug,
                $name,
                $title,
                $content,
                $tags,
                $level,
                $locked,
                $template
            )
        );
    }

    public function update(string $slug, string $name, string $title, string $content, array $tags, int $level, bool $locked, string $template):void
    {
        $interactor = new UpdatePageInteractor($this->gateway, $this->updatePagePresenter);
        $interactor->handle(
            new UpdatePageRequestDto(
                $slug,
                $name,
                $title,
                $content,
                $tags,
                $level,
                $locked,
                $template
            )
        );
    }

    public function delete(string $slug):void
    {
        $interactor = new DeletePageInteractor($this->gateway, $this->deletePagePresenter);
        $interactor->handle(
            new DeletePageRequestDto($slug)
        );
    }

    public function getPageBySlug(string $slug):void
    {
        $interactor = new GetSinglePageInteractor($this->gateway, $this->getPagePresenter);
        $interactor->handle(
            new GetSinglePageBySlugDto($slug)
        );
    }
}