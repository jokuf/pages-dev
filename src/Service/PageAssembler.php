<?php


namespace Jokuf\Site\Service;


use Jokuf\Site\Service\Data\PageData;
use Jokuf\Site\Service\Model\ConcretePageResponseDto;
use Jokuf\Site\Core\Entity\Page;
use Jokuf\Site\Service\Model\CreatePageRequestDto;
use Jokuf\Site\Service\Gateway\PageGatewayInterface;

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
        $parentPageData = null;
        if ($parentPageSlug = $request->getParentPageSlug()) {
            $parentPageData = $this->pageGateway->getBySlug($parentPageSlug);
        }

        $data = new PageData(
            null,
            $parentPageData,
            null,
            $request->getName(),
            $request->getTitle(),
            $request->getContent(),
            $request->getTags(),
            $request->getLevel(),
            $request->isLocked(),
            $request->getTemplate()
        );

        return new Page($data);
    }

    public function assembleResponseDto(Page $page): ConcretePageResponseDto
    {
        $exportedData = Page::export($page);
        return new ConcretePageResponseDto(
            $exportedData->getSlug(),
            $exportedData->getName(),
            $exportedData->getTitle(),
            $exportedData->getContent(),
            $exportedData->getTags(),
            $exportedData->getLevel(),
            $exportedData->isLocked(),
            $exportedData->getTemplate()
        );
    }

}