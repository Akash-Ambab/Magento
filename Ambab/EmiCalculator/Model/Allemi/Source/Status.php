<?php

namespace Ambab\EmiCalculator\Model\Allemi\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    protected $allemi;
    protected $bank;

    public function __construct(
        \Ambab\EmiCalculator\Model\AllemiFactory $allemi,
        \Ambab\EmiCalculator\Model\BankFactory $bank
    )
    {
        $this->allemi = $allemi;
        $this->bank = $bank;
    }

    public function toOptionArray()
    {
        $availableOptions = $this->allemi->getAvailableStatuses();
        
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }

    public function getOnlyBankCode()
	{
		$emiData = $this->bank->create();
		$collection = $emiData->getCollection()
				->distinct(true)
				->addFieldToSelect('bank_code')
				->load();
        $collection = $collection->getData();
        $options = [];
        foreach ($collection as $code) {
            $options[$code['bank_code']] = $code['bank_code'];
        }

		return $options;
	}
}
?>
