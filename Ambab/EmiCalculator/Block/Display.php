<?php
namespace Ambab\EmiCalculator\Block;
class Display extends \Magento\Framework\View\Element\Template
{
	protected $helper;
	protected $_registry;
	protected $Allemi;
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Ambab\EmiCalculator\Helper\Data $helperData,
		\Magento\Framework\Registry $registry,
		\Ambab\EmiCalculator\Model\AllemiFactory $Allemi,
        array $data = []
		)
	{
		$this->helper = $helperData;
		$this->_registry = $registry;
		$this->Allemi = $Allemi;
		parent::__construct($context, $data);
	}

	public function isEnabled()
	{
		return $this->helper->getModuleConfig();
	}

	public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

	public function getCurrentProduct()
    {        
        return $this->_registry->registry('current_product');
    }

	public function getModelData()
	{
		$emiData = $this->Allemi->create();
		return $emiData->getCollection();
	}

	public function getOnlyBankCode()
	{
		$emiData = $this->Allemi->create();
		$collection = $emiData->getCollection()
				->distinct(true)
				->addFieldToSelect('bank_code')
				->load();
		
		return $collection;
	}

	public function getEmiPlans($bankcode)
	{
		$emiData = $this->Allemi->create();
		$collection = $emiData->getCollection()
				->addFieldToFilter('bank_code', array('like' => $bankcode))
				->load();
		
		return $collection;
	}
}