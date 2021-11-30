<?php
namespace Ambab\EmiCalculator\Block;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Checkout\Model\Cart;

class MinimumCheckout extends AbstractProduct
{
    protected $registry;
    protected $grandTotal;
    protected $scopeConfigInterface;

    public function __construct(Context $context, array $data = [],
    // ManagerInterface $messageManager,
    \Magento\Framework\Registry $registry, 
    \Magento\Checkout\Model\Cart $grandTotal,
    \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfigInterface
    )
    {
        $this->registry = $registry;
        $this->grandTotal = $grandTotal;
        $this->scopeConfigInterface = $scopeConfigInterface;
        parent::__construct($context, $data);
    }

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

  
    public function getGrandTotal(){
        // return $this->grandTotal->getQuote()->getBaseSubtotal();
        return $this->grandTotal->getQuote()->getGrandTotal();
    }

    public function getSubTotal(){
        return $this->grandTotal->getQuote()->getBaseSubtotal();
    }

    public function getMinimumValue(){
        return $this->scopeConfigInterface->getValue('sales/minimum_order/amount');
    }
}