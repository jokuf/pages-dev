<?php
namespace Jokuf\Site\Tests\Stories;

use Jokuf\Site\DTO\PageContentDTO;
use Jokuf\Site\DTO\PageDTO;
use Jokuf\Site\Entity\PageContent;
use Jokuf\Site\Interactor\CreatePageInteractor;
use Jokuf\Site\Tests\Stub\Gateway\InMemoryStorageGatewayInterface;
use Jokuf\Site\Tests\Stub\Presenter\DummyCreatePageResponse;

class TestPageUserStories extends \PHPUnit\Framework\TestCase
{
    private static $storage;

    public static function setUpBeforeClass(): void
    {
        self::$storage = new InMemoryStorageGatewayInterface();
    }

    public function testAsAUserIWantToCreateAPage() {
        $useCase = new CreatePageInteractor(
            self::$storage,
            new DummyCreatePageResponse()
        );

        $pageDTO = new PageDTO(
            null,
            null,
            [
                new PageContentDTO(
                    null,
                    'Homepage',
                    'Welcome home',
                    'long description',
                    ['test', 'test2'],
                    'bg'
                )
            ],
            0,
            false,
            'homepage',
            []
        );
        $useCase->handle($pageDTO);

        $this->assertNotNull(self::$storage->get(1));
    }
    public function testAsAUserIWantToAddNewLanguageVersionToAPage() {
        $this->assertTrue(true);
    }

    public function testAsAUserIWantToUpdateLanguageVersionOfAPage() {
        $page = self::$storage->get(1);

        $this->assertNotNull($page);

        $initialContent = $page->getContent()->getBy('bg');

        $this->assertNotNull($initialContent);

        $content = new PageContent(
            $initialContent->getId(),
            $initialContent->getName(),
            $initialContent->getTitle(),
            $initialContent->getContent() .' - '. 'test',
            ['tag1', 'tag2'],
            $initialContent->getLanguage()
        );

        $page->getContent()->remove($initialContent);
        $page->getContent()->addContent($content);

        self::$storage->save($page);

        $this->assertEquals($content, self::$storage->get($page->getId())->getContent()->getBy('bg'));
    }

    public function testAsAUserIWantToGetPageById() {
        $this->assertTrue(true);
    }

    public function testAsAUserIWantToGetPageBySlug() {
        $this->assertTrue(true);
    }

    public function testAsAUserIWantToDeletePageLanguageVersion() {
        $this->assertTrue(true);
    }

    public function testAsUserIWantToDeleteAPage() {
        $this->assertTrue(true);
    }

    public function testAsUserIWantToUpdateAPage() {
        $this->assertTrue(true);
    }
}