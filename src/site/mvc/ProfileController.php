<?php

namespace site\mvc;


use site\classes\API;
use site\JPHP;

class ProfileController extends AbstractController
{

    /**
     * @return string
     */
    public function render(): string
    {
        if (!$this->_REQ->cookie("token")["value"])
        {
            $this->redirect("/hub/login");
            return null;
        }

        $hubApi = new API($this->_REQ->cookie("token")["value"]);

        $id = substr($this->_REQ->path(), 13);

        if ($id == "me")
            return JPHP::getTemplateEngine()->render("pages/hub/profile", [
                "profile" => $hubApi->userInfo(),
            ]);

        $account = $hubApi->accountGet($id);

        if (!isset($account))
        {
            $this->redirect("/errors/404");
            return;
        }

        return JPHP::getTemplateEngine()->render("pages/hub/profile", [
            "profile" => $account,
        ]);
    }

    public function getPath(): string
    {
        return "/hub/profile/";
    }

    public function getTitle(): string
    {
        return "DevelHub Profile";
    }
}