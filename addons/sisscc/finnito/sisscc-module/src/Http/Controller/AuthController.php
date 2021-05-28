<?php namespace Finnito\SissccModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;

class AuthController extends PublicController
{
    public function login()
    {
        $this->template->set("meta_title", "Login");
        return view("finnito.module.sisscc::login", []);
    }

    public function forgot()
    {
        $this->template->set("meta_title", "Forgot Password");
        return view("finnito.module.sisscc::forgot_password", []);
    }
}
