<?php
/**
 * @copyright Devidas
 *
 * @see PROJECT_LICENSE.txt
 */
namespace Ambab\EmiCalculator\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\Product;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\InventorySalesAdminUi\Model\GetSalableQuantityDataBySku;
/**
 * Class StockLeft
 */
class StockLeft extends Template
{
    /** @var Registry  */
    private $_registry;

    /** @var Product  */
    private $_Product;

    /** @var session  */
    private $session;

    /** @var session  */
    private $stockRegistry;

    private $getSalableQuantityDataBySku;

    /**
     * StockLeft constructor.
     * @param Context $context
     * @param Registry $registry
     * @param Product $product
     * @param SessionManagerInterface $session
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        Product $product,
        SessionManagerInterface $session,
        StockRegistryInterface $stockRegistry,
        GetSalableQuantityDataBySku $getSalableQuantityDataBySku,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_registry = $registry;
        $this->_Product = $product;
        $this->session = $session;
        $this->stockRegistry = $stockRegistry;
        $this->getSalableQuantityDataBySku = $getSalableQuantityDataBySku;
    }

    /**
     * @return string
     */
    public function getRemainingQty($productId) {
        $stock = $this->stockRegistry->getStockItem($productId);
        return $stock->getQty();
    }

    public function getProductSalableQty($sku) {
        $salable = $this->getSalableQuantityDataBySku->execute($sku);
        return $salable[0]['qty'];
    }

    /**
     * @return Magento\Catalog\Model\Product
     */
    protected function getCurrentProduct() {
        return $this->_registry->registry('current_product')->getId();
    }


}