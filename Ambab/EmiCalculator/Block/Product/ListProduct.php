<?php

namespace Ambab\EmiCalculator\Block\Product;
class ListProduct extends \Magento\Catalog\Block\Product\ListProduct
{
    public function getProductDetailsHtml(\Magento\Catalog\Model\Product $product)
    {
        $html = $this->getLayout()->createBlock('Magento\Framework\View\Element\Template')
                ->setProduct($product)->setTemplate('Ambab_EmiCalculator::hot_product.phtml')->toHtml();
        $renderer = $this->getDetailsRenderer($product->getTypeId());
        
        
        if ($renderer) {
            $renderer->setProduct($product);
            return $html.$renderer->toHtml();
        }


        return $html;
    }
}