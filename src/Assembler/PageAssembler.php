<?php


namespace Jokuf\Site\Assembler;


use Jokuf\Site\Data\PageData;
use Jokuf\Site\DTO\ConcretePageResponseDto;
use Jokuf\Site\Entity\Page;
use Jokuf\Site\DTO\CreatePageRequestDto;
use Jokuf\Site\Gateway\PageGatewayInterface;

class PageAssembler
{
    /**
     * @var PageGatewayInterface
     */
    private $pageGateway;

    /**
     * PageAssembler constructor.
     * @param PageGatewayInterface $pageGateway
     */
    public function __construct(PageGatewayInterface $pageGateway) {
        $this->pageGateway = $pageGateway;
    }

    public function assembleEntity(CreatePageRequestDto $request): Page
    {
        $parentPage = null;
        if ($parentPageSlug = $request->getParentPageSlug()) {
            $data = $this->pageGateway->getBySlug($parentPageSlug);
            $parentPage = new Page(
                $data->getSlug(),
                null,
                $data->getName(),
                $data->getTitle(),
                $data->getContent(),
                $data->getTags(),
                $data->getLevel(),
                $data->isLocked(),
                $data->getTemplate()
            );
        }

        return new Page(
            null,
            $parentPage,
            $request->getName(),
            $request->getTitle(),
            $request->getContent(),
            $request->getTags(),
            $request->getLevel(),
            $request->isLocked(),
            $request->getTemplate()
        );
    }

    public function assembleResponseDto(Page $page): ConcretePageResponseDto
    {
        return new ConcretePageResponseDto(
            $page->getSlug(),
            $page->getName(),
            $page->getTitle(),
            $page->getContent(),
            $page->getTags(),
            $page->getLevel(),
            $page->isLocked(),
            $page->getTemplate()
        );
    }
}