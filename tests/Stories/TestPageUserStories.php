<?php
namespace Jokuf\Site\Tests\Stories;

use Jokuf\Site\Service\Model\CreatePageRequestDto;
use Jokuf\Site\Service\Model\DeletePageRequestDto;
use Jokuf\Site\Service\Model\GetPageRequestDto;
use Jokuf\Site\Service\Model\UpdatePageRequestDto;
use Jokuf\Site\Core\Interactor\CreatePageInteractor;
use Jokuf\Site\Core\Interactor\DeletePageInteractor;
use Jokuf\Site\Core\Interactor\ReadSinglePageInteractor;
use Jokuf\Site\Core\Interactor\UpdatePageInteractor;
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

        self::assertNotNull(self::$storage->getBySlug('/homepage'));
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


        self::assertEquals('jokuf-asdfa', $response->value->getName());
        self::assertEquals('Welcome home', $response->value->getTitle());
        self::assertNotEquals('/homepage', $response->value->getSlug());
    }

    public function testAsAUserIWantToGetPageBySlug()
    {
        $presenter = new GetPagePresenter();
        $case = new ReadSinglePageInteractor(
            self::$storage,
            $presenter
        );

        $case->handle(new GetPageRequestDto('/homepage'));


        self::assertEquals('Welcome home', $presenter->value->getTitle());
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

        self::assertTrue($presenter->value->isSuccessful());

        $useCase->handle(
            new DeletePageRequestDto(
                '/homepage'
            )
        );

        self::assertFalse($presenter->value->isSuccessful());
    }

    public function testAsUserIWantToUpdateAPage() {
        self::assertTrue(true);
    }
}