<?php


namespace Jokuf\Site\Core\Interactor;


use Jokuf\Site\Service\PageAssembler;
use Jokuf\Site\Service\Boundary\UpdatePageRequestInterface;
use Jokuf\Site\Service\Boundary\UpdatePagePresenterInterface;
use Jokuf\Site\Service\Model\ConcretePageResponseDto;
use Jokuf\Site\Service\Model\UpdatePageRequestDto;
use Jokuf\Site\Core\Entity\Page;
use Jokuf\Site\Service\Gateway\PageGatewayInterface;

class UpdatePageInteractor implements UpdatePageRequestInterface
{
    /**
     * @var PageGatewayInterface
     */
    private $gateway;
    /**
     * @var UpdatePagePresenterInterface
     */
    private $response;

    public function __construct(PageGatewayInterface $gateway, UpdatePagePresenterInterface $response)
    {
        $this->gateway = $gateway;
        $this->response = $response;
    }

    public function handle(UpdatePageRequestDto $request): void
    {
        $data = null;
        if (null === $request->getSlug()) throw new \InvalidArgumentException();


        if (false !== ($parsedUrl = parse_url($request->getSlug()))) {
            $data = $this->gateway->getBySlug($parsedUrl['path']);
        }

        if (null === $data) throw new \DomainException('Page not found.');

        $page = new Page($data);

        if ($name = $request->getName()) {
            $page->updateName($name);
        }

        if ($title = $request->getTitle()) {
            $page->updateTitle($title);
        }

        if ($name = $request->getName()) {
            $page->updateName($name);
        }

        $page->save($this->gateway);

        $data = Page::export($page);

        $this->response->present(
            new ConcretePageResponseDto(
                $data->getSlug(),
                $data->getName(),
                $data->getTitle(),
                $data->getContent(),
                $data->getTags(),
                $data->getLevel(),
                $data->isLocked(),
                $data->getTemplate()
            )
        );
    }
}