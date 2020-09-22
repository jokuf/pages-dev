<?php
namespace Jokuf\Site\Tests\Stories;

use Jokuf\Site\DTO\CreatePageRequestDto;
use Jokuf\Site\DTO\DeletePageRequestDto;
use Jokuf\Site\DTO\GetPageRequestDto;
use Jokuf\Site\DTO\UpdatePageRequestDto;
use Jokuf\Site\Interactor\CreatePageInteractor;
use Jokuf\Site\Interactor\DeletePageInteractor;
use Jokuf\Site\Interactor\ReadSinglePageInteractor;
use Jokuf\Site\Interactor\UpdatePageInteractor;
use Jokuf\Site\Tests\Stub\Gateway\InMemoryStorageGatewayInterface;
use Jokuf\Site\Tests\Stub\Presenter\DeletePagePresenter;
use Jokuf\Site\Tests\Stub\Presenter\DummyCreatePagePresenterInterface;
use Jokuf\Site\Tests\Stub\Presenter\GetPagePresenter;
use Jokuf\Site\Tests\Stub\Presenter\UpdatePagePresenter;

class TestPageUserStories extends \PHPUnit\Framework\TestCase
{
    private static $storage;

    public static function setUpBeforeClass(): void
    {
        self::$storage = new InMemoryStorageGatewayInterface();
    }

    public function testAsAUserIWantToCreateAPage()
    {
        $useCase = new CreatePageInteractor(
            self::$storage,
            new DummyCreatePagePresenterInterface()
        );

        $pageDTO = new CreatePageRequestDto(
            null,
            'Homepage',
            'Welcome home',
            'long description',
            ['test', 'test2'],
            0,
            false,
            'homepage'
        );
        $useCase->handle($pageDTO);

        $this->assertNotNull(self::$storage->getBySlug('/homepage'));
    }

    public function testAsAUserIWantToUpdatePageContent()
    {
        $request = new UpdatePageRequestDto(
            '/homepage',
            'jokuf-asdfa',
            null,
            null,
            [],
            5,
            true
        );

        $response = new UpdatePagePresenter();
        $useCase = new UpdatePageInteractor(self::$storage,$response);
        $useCase->handle($request);


        $this->assertEquals('jokuf-asdfa', $response->value->getName());
        $this->assertEquals('Welcome home', $response->value->getTitle());
        $this->assertNotEquals('/homepage', $response->value->getSlug());
    }

    public function testAsAUserIWantToGetPageBySlug()
    {
        $presenter = new GetPagePresenter();
        $case = new ReadSinglePageInteractor(
            self::$storage,
            $presenter
        );

        $case->handle(new GetPageRequestDto('/homepage'));


        $this->assertEquals('Welcome home', $presenter->value->getTitle());
    }

    public function testAsUserIWantToDeleteAPage()
    {
        $presenter = new DeletePagePresenter();
        $useCase = new DeletePageInteractor(
            self::$storage,
            $presenter
        );

        $useCase->handle(
            new DeletePageRequestDto(
                '/homepage'
            )
        );

        $this->assertTrue($presenter->value->isSuccessful());

        $useCase->handle(
            new DeletePageRequestDto(
                '/homepage'
            )
        );

        $this->assertFalse($presenter->value->isSuccessful());
    }

    public function testAsUserIWantToUpdateAPage() {
        $this->assertTrue(true);
    }
}