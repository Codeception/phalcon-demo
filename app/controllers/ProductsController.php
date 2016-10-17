<?php

namespace PhalconDemo\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use PhalconDemo\Forms\ProductsForm;
use PhalconDemo\Models\Products;

/**
 * ProductsController
 *
 * Manage CRUD operations for products
 */
class ProductsController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Manage your products');

        parent::initialize();
    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->set('conditions', null);
        $this->view->setVar('form', new ProductsForm);
    }

    /**
     * Search products based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'PhalconDemo\Models\Products', $this->request->getPost());
            $this->persistent->set('searchParams', $query->getParams());
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->get('searchParams', []);

        /** @var \Phalcon\Mvc\Model\Resultset\Simple $products */
        $products = Products::find($parameters);

        if (!$products->count()) {
            $this->flash->notice("The search did not find any products");
            return $this->forward("products/index");
        }

        $paginator = new Paginator([
            'data'  => $products,
            'limit' => 10,
            'page'  => $numberPage
        ]);

        $this->view->setVar('page', $paginator->getPaginate());
    }

    /**
     * Shows the form to create a new product
     */
    public function newAction()
    {
        $this->view->setVar('form', new ProductsForm(null, ['edit' => false]));
    }

    /**
     * Edits a product based on its id
     * @param int $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $product = Products::findFirstById($id);
            if (!$product) {
                $this->flash->error('Product was not found');
                return $this->forward("products/index");
            }

            $this->view->setVar('form', new ProductsForm($product, ['edit' => true]));
        }
    }

    /**
     * Creates a new product
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("products/index");
        }

        $form = new ProductsForm;
        $product = new Products;

        $data = $this->request->getPost();
        if (!$form->isValid($data, $product)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('products/new');
        }

        if ($product->save() == false) {
            foreach ($product->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('products/new');
        }

        $form->clear();

        $this->flash->success("Product was created successfully");
        return $this->forward("products/index");
    }

    /**
     * Saves current product in screen
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("products/index");
        }

        $id = $this->request->getPost("id", "int");

        $product = Products::findFirstById($id);
        if (!$product) {
            $this->flash->error("Product does not exist");
            return $this->forward("products/index");
        }

        $form = new ProductsForm;
        $this->view->setVar('form', $form);

        $data = $this->request->getPost();

        if (!$form->isValid($data, $product)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('products/edit/' . $id);
        }

        if ($product->save() == false) {
            foreach ($product->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('products/edit/' . $id);
        }

        $form->clear();

        $this->flash->success('Product was updated successfully');
        return $this->forward("products/index");
    }

    /**
     * Deletes a product
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $products = Products::findFirstById($id);
        if (!$products) {
            $this->flash->error("Product was not found");
            return $this->forward("products/index");
        }

        if (!$products->delete()) {
            foreach ($products->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward("products/search");
        }

        $this->flash->success("Product was deleted");
        return $this->forward("products/index");
    }
}
