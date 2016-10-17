<?php

namespace PhalconDemo\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use PhalconDemo\Forms\ProductTypesForm;
use PhalconDemo\Models\ProductTypes;

class ProductTypesController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Manage your products types');

        parent::initialize();
    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->set('conditions', null);
        $this->view->setVar('form', new ProductTypesForm);
    }

    /**
     * Search producttype based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'PhalconDemo\Models\ProductTypes', $this->request->getPost());
            $this->persistent->set('searchParams', $query->getParams());
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->get('searchParams', []);

        /** @var \Phalcon\Mvc\Model\Resultset\Simple $productTypes */
        $productTypes = ProductTypes::find($parameters);

        if (!$productTypes->count()) {
            $this->flash->notice("The search did not find any product types");
            return $this->forward("producttypes/index");
        }

        $paginator = new Paginator([
            'data'  => $productTypes,
            'limit' => 10,
            'page'  => $numberPage
        ]);

        $this->view->setVars([
            'page'         => $paginator->getPaginate(),
            'productTypes' => $productTypes
        ]);
    }

    /**
     * Shows the form to create a new producttype
     */
    public function newAction()
    {
        $this->view->setVar('form', new ProductTypesForm(null, ['edit' => false]));
    }

    /**
     * Edits a producttype based on its id
     * @param int $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $producttypes = ProductTypes::findFirstById($id);
            if (!$producttypes) {
                $this->flash->error("Product type to edit was not found");
                return $this->forward("producttypes/index");
            }

            $this->view->setVar('form', new ProductTypesForm($producttypes, ['edit' => true]));
        }
    }

    /**
     * Creates a new producttype
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("producttypes/index");
        }

        $form = new ProductTypesForm;
        $producttypes = new ProductTypes;

        $data = $this->request->getPost();
        if (!$form->isValid($data, $producttypes)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('producttypes/new');
        }

        if ($producttypes->save() == false) {
            foreach ($producttypes->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('producttypes/new');
        }

        $form->clear();

        $this->flash->success("Product type was created successfully");
        return $this->forward("producttypes/index");
    }

    /**
     * Saves current producttypes in screen
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("producttypes/index");
        }

        $id = $this->request->getPost("id", "int");
        $productTypes = ProductTypes::findFirstById($id);
        if (!$productTypes) {
            $this->flash->error("productTypes does not exist");
            return $this->forward("producttypes/index");
        }

        $form = new ProductTypesForm;

        $data = $this->request->getPost();
        if (!$form->isValid($data, $productTypes)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('producttypes/new');
        }

        if ($productTypes->save() == false) {
            foreach ($productTypes->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('producttypes/new');
        }

        $form->clear();

        $this->flash->success("Product Type was updated successfully");
        return $this->forward("producttypes/index");
    }

    /**
     * Deletes a producttypes
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $productTypes = ProductTypes::findFirstById($id);
        if (!$productTypes) {
            $this->flash->error("Product types was not found");
            return $this->forward("producttypes/index");
        }

        if (!$productTypes->delete()) {
            foreach ($productTypes->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward("producttypes/search");
        }

        $this->flash->success("product types was deleted");
        return $this->forward("producttypes/index");
    }
}
