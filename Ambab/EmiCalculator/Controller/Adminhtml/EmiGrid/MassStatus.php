<?php
namespace Ambab\EmiCalculator\Controller\Adminhtml\EmiGrid;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Ambab\EmiCalculator\Model\ResourceModel\Allemi\CollectionFactory;

/**
 * Mass status update controller
 */
class MassStatus extends \Magento\Backend\App\Action
{

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param Context           $context
     * @param Filter            $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * Update product(s) status action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {

        $ids = $this->getRequest()->getPost('id');
        $status = $this->getRequest()->getPost('status');
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('emi_id', ['in' => $ids]);
        $updateStatus = 0;

        try {
            foreach ($collection as $item) {
                $item->setStatus($status)->save();
                $updateStatus++;
            }
        } catch (Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while updating the product(s) status.'));
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been updated.', $updateStatus));
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}