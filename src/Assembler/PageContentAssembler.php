<?php


namespace Jokuf\Site\Assembler;


use Jokuf\Site\Entity\PageContent;
use Jokuf\Site\DTO\PageContentDTO;

class PageContentAssembler
{
    public function assembleEntity(PageContentDTO $dto): PageContent
    {
        return new PageContent(
            $dto->getId(),
            $dto->getName(),
            $dto->getTitle(),
            $dto->getContent(),
            $dto->getTags(),
            $dto->getLanguage()
        );
    }

    public function assembleDTO(PageContent $entity): PageContentDTO
    {
        return new PageContentDTO(
            $entity->getId(),
            $entity->getName(),
            $entity->getTitle(),
            $entity->getContent(),
            $entity->getTags(),
            $entity->getLanguage()
        );
    }
}