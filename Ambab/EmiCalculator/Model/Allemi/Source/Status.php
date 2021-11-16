<?php

namespace Ambab\EmiCalculator\Model\Allemi\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    protected $allemi;

    public function __construct(\Ambab\EmiCalculator\Model\Allemi $allemi)
    {
        $this->allemi = $allemi;
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

    public function getBankCodeArray()
    {
        $availableOptions = $this->allemi->getCollection();
        // $data = $this->allemi->getCollection();
        // exit;
        // $options = [];
        // foreach ($availableOptions as $value) {
        //     echo $value;
        // }
        print_r($availableOptions);
        exit;
        // return $options;

    }
}
?>
