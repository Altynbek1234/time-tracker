<?php



namespace Times\Controllers;

/**
 * Display the terms and conditions page.
 * Vokuro\Controllers\TermsController
 * @package Vokuro\Controllers
 */
class TermsController extends ControllerBase
{
    /**
     * Default action. Set the public layout (layouts/public.phtml)
     */
    public function indexAction()
    {
        $this->view->setTemplateBefore('public');
    }
}
