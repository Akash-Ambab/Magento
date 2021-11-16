<?php
namespace Ambab\EmiCalculator\Controller\Adminhtml\EmiGrid;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Main page controller
 */
class Index extends Action
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context     $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {

        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Ambab_EmiCalculator::all_emis');
        $resultPage->addBreadcrumb(__('Manage EMI Options'), __('Manage EMI Options'));
        $resultPage->getConfig()->getTitle()->prepend(__('EMI Options'));
        return $resultPage;
    }
}