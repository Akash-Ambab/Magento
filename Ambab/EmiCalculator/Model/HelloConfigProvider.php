<?php

namespace Ambab\EmiCalculator\Model;

use Magento\Checkout\Model\ConfigProviderInterface;

class HelloConfigProvider implements ConfigProviderInterface
{

    public function __construct( \Ambab\EmiCalculator\Helper\Data $helperData)
	{
		$this->helper = $helperData;
	}

	public function isEnabled()
	{
		return $this->helper->getModuleConfig();
	}

    public function getConfig()
    {
        $config = [];
        $config['is_Enabled'] = isEnabled();
        return $config;
    }
}