<?php

namespace Ambab\EmiCalculator\Controller\Adminhtml\Grid;

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
    protected $bankFactory;

    /**
     * @param Context                    $context
     * @param \Ambab\EmiCalculator\Model\BankFactory $blogFactory
     */
    public function __construct(
        Context $context,
        \Ambab\EmiCalculator\Model\BankFactory $bankFactory
    ) {
        parent::__construct($context);
        $this->bankFactory = $bankFactory;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ambab_EmiCalculator::bank_delete');
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('bank_id');

        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->bankFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('The bank has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/index', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('We can\'t find a post to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}