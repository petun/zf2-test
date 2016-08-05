<?php

namespace Admin\Controller;

use Admin\Form\ProductForm;
use Admin\Model\Product;
use Admin\Model\ProductTable;
use Admin\Service\AdminService;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class IndexController
 *
 * @author Petr Marochkin <petun911@gmail.com>
 */
class IndexController extends AbstractActionController
{

    private $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function indexAction()
    {
        /** @var ProductTable $table */
        return [
            'products' => $this->getProductTable()->getProducts()
        ];
    }

    public function createAction()
    {
        $form = new ProductForm('product', []);
        /** @var Request $request */
        $request = $this->getRequest();

        if ($request->isPost()) {
            $product = new Product();
            $form->setInputFilter($product->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $product->exchangeArray($form->getData());
                $this->getProductTable()->save($product);

                $this->redirect()->toRoute('admin');
            }
        }

        return [
            'form' => $form
        ];
    }

    public function editAction()
    {
        $form = new ProductForm('product', []);
        $id = $this->params()->fromRoute('id', 0);

        /** @var Product $model */
        $model = $this->getProductTable()->getProduct($id);

        $form->bind($model);

        /** @var Request $request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter( $model->getInputFilter() );
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getProductTable()->save($model);
                $this->redirect()->toRoute('admin');
            }
        }

        return [
            'model' => $model,
            'form' => $form
        ];
    }

    /**
     * @return ProductTable
     */
    private function getProductTable()
    {
        $table = $this->getServiceLocator()->get('Admin\Model\ProductTable');
        return $table;
    }


}