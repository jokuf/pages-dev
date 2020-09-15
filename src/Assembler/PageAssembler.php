<?php


namespace Jokuf\Site\Assembler;


use Jokuf\Site\Entity\Page;
use Jokuf\Site\DTO\PageDTO;

class PageAssembler
{
    /**
     * @var PageContentAssembler
     */
    private $pageContentAssembly;

    /**
     * PageAssembler constructor.
     */
    public function __construct() {
        $this->pageContentAssembly = new PageContentAssembler();
    }

    public function assembleEntity(PageDTO $dto): Page
    {
        return new Page(
            $dto->getParent(),
            $dto->getName(),
            $dto->getTitle(),
            $dto->getContent(),
            $dto->getTags(),
            $dto->getLevel(),
            $dto->isLocked(),
            $dto->getTemplate(),
            $dto->getImages()
        );
    }

    public function assembleDTO(Page $page): PageDTO
    {

    }
}