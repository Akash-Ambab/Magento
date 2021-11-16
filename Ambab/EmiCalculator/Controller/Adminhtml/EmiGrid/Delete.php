<?php

namespace Ambab\EmiCalculator\Controller\Adminhtml\EmiGrid;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

/**
 * Delete Controller
 */
class Delete extends \Magento\Backend\App\Action
{

    /**
     * @var \Ambab\EmiCalculator\Model\BankFactory
     */
    protected $emiFactory;

    /**
     * @param Context                    $context
     * @param \Ambab\EmiCalculator\Model\BankFactory $blogFactory
     */
    public function __construct(
        Context $context,
        \Ambab\EmiCalculator\Model\AllemiFactory $emiFactory
    ) {
        parent::__construct($context);
        $this->emiFactory = $emiFactory;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return true;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('emi_id');

        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->emiFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('The emi plan has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/index', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('We can\'t find a plan to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}