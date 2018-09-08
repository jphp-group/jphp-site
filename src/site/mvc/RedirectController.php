<?php

namespace site\mvc;

use php\http\HttpRedirectHandler;

class RedirectController extends AbstractController
{
    /**
     * @var string
     */
    private $old;

    /**
     * @var string
     */
    private $new;

    /**
     * RedirectController constructor.
     * @param string $oldPath
     * @param string $newPath
     */
    public function __construct(string $oldPath, string $newPath)
    {
        $this->old = $oldPath;
        $this->new = $newPath;
    }

    /**
     * @return bool
     */
    public function useLayout(): bool
    {
        return false;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        (new HttpRedirectHandler($this->new))->__invoke($this->_REQ, $this->_RES);

        return null;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->old;
    }
}