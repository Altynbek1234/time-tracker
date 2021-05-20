<?php


namespace Times\Controllers;

/**
 * Display the privacy page.
 * Vokuro\Controllers\PrivacyController
 * @package Vokuro\Controllers
 */
class PrivacyController extends ControllerBase
{
    /**
     * Default action. Set the public layout (layouts/public.phtml)
     */
    public function indexAction()
    {
        $this->view->setTemplateBefore('public');
    }
}
