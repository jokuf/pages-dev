<?php


namespace Jokuf\Site\Entity;


class PageContentCollection
{
    /**
     * @var PageContent[]
     */
    private $contents;

    public function __construct(PageContent  ... $contents)
    {
        foreach ($contents as $content) {
            $this->addContent($content);
        }
    }

    public function getBy(string $language): ?PageContent
    {
        foreach ($this->contents as $content) {
            if ($content->getLanguage() === strtolower($language)) {
                return $content;
            }
        }

        return null;
    }

    public function getAll() {
        return $this->contents;
    }

    public function addContent(PageContent $content)
    {
        if (isset($this->contents[$content->getLanguage()])) {
            throw new \DomainException('Duplicated language['.$content->getLanguage().']');
        }

        $this->contents[$content->getLanguage()] = $content;
    }

    public function remove(PageContent $content) {
        if (array_key_exists($content->getLanguage(), $this->contents)) {
            unset($this->contents[$content->getLanguage()]);

            return true;
        }

        return false;
    }
}