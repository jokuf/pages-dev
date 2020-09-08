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

    public function assembleEntity(PageDTO $dto): Page {
        $contents = [];
        foreach ($dto->getContents() as $content) {
            $contents[] = $this->pageContentAssembly->assembleEntity($content);
        }

        return new Page(
            $dto->getId(),
            $dto->getParentPage(),
            $contents,
            $dto->getLevel(),
            $dto->isLocked(),
            $dto->getTemplate()
        );
    }

    public function assembleDTO(Page $page): PageDTO {
        $contents = [];
        foreach ($page->getContent()->getAll() as $content) {
            $contents[] = $this->pageContentAssembly->assembleDTO($content);
        }

        return new PageDTO(
            $page->getId(),
            $page->getParent(),
            $contents,
            $page->getLevel(),
            $page->isLocked(),
            $page->getTemplate(),
            $page->getImages()
        );
    }
}