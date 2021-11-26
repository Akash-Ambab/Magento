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
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_registry = $registry;
        $this->_Product = $product;
        $this->session = $session;
        $this->stockRegistry = $stockRegistry;
    }

    /**
     * @return string
     */
    public function getRemainingQty($productId) {
        $stock = $this->stockRegistry->getStockItem($productId);
        return $stock->getQty();
    }

    /**
     * @return Magento\Catalog\Model\Product
     */
    protected function getCurrentProduct() {
        return $this->_registry->registry('current_product')->getId();
    }


}