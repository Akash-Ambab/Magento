<?php

namespace Ambab\EmiCalculator\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Ambab\EmiCalculator\Block\Display;

class JsonData extends Action
{

    private $resultJsonFactory;
    protected $blockData;

    public function __construct(
        JsonFactory $resultJsonFactory, 
        Context $context,
        Display $blockData
    )
    {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->blockData = $blockData;
    }

    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();
        $jsonData = $this->blockData->getJsonData();
        return $resultJson->setData($jsonData);
    }
}