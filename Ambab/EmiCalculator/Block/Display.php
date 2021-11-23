<?php
namespace Ambab\EmiCalculator\Block;
class Display extends \Magento\Framework\View\Element\Template
{
	protected $helper;
	protected $_registry;
	protected $Allemi;
	protected $bank;
	protected $cart;

	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Ambab\EmiCalculator\Helper\Data $helperData,
		\Magento\Framework\Registry $registry,
		\Ambab\EmiCalculator\Model\AllemiFactory $Allemi,
		\Ambab\EmiCalculator\Model\BankFactory $bank,
		\Magento\Checkout\Model\Cart $cart,
        array $data = []
		)
	{
		$this->helper = $helperData;
		$this->_registry = $registry;
		$this->Allemi = $Allemi;
		$this->bank = $bank;
		$this->cart = $cart;
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
				->addFieldToFilter('status', array('eq' => '1'))
				->load();

		$collection = $collection->getData();
		
		return $collection;
	}

	public function getEmiPlans($bankcode)
	{
		$emiData = $this->Allemi->create();
		$collection = $emiData->getCollection()
				->addFieldToFilter('bank_code', array('like' => $bankcode))
				->addFieldToFilter('status', array('eq' => '1'))
				->setOrder(
					'month',
					'asc'
				)
				->load();
		
		$collection = $collection->getData();

		// echo "<pre>";
		// print_r(json_encode($collection, JSON_PRETTY_PRINT));
		// exit;

		return $collection;
	}

	public function getBankName($bankcode) 
	{
		$bankname = $this->bank->create();
		$collection = $bankname->getCollection()
				->addFieldToFilter('bank_code', ['like' => $bankcode])
				->distinct(true)
				->load();
		
		return $collection;
	}

	public function calculateEmi($price, $roi, $duration)
	{
		$roi = $roi / (12 * 100);
		
		$emi = ($price * $roi * pow(1 + $roi, $duration)) / (pow(1 + $roi, $duration) - 1);
		
		return $emi;
	}

	public function getGrandTotal()
    {
        $totals = $this->cart->getQuote()->getTotals();

        $grand_total = $totals['grand_total']['value'] - $this->cart->getShippingAmount();
        return $grand_total;
    }

	public function getJsonData()
	{
		$jsonData = [];

		foreach($this->getOnlyBankCode() as $BankCode) {
			$jsonData['getOnlyBankCode'][] = $BankCode['bank_code'];
			$abc = $this->getBankName($BankCode);
			foreach ($abc as $a) {
				$jsonData['BankNameTest'][$a['bank_code']] = $a['bank_name'];
			}

			$emi = $this->getEmiPlans($BankCode);

			foreach($emi as $b) {
				$jsonData['EMI_Plan'][$b['bank_code']][] = $b;
			}
		}

		return $jsonData;

	}
}