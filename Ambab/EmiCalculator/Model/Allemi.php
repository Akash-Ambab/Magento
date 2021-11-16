<?php
namespace Ambab\EmiCalculator\Model;

use Magento\Framework\Model\AbstractModel;

class Allemi extends AbstractModel
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

	const CACHE_TAG = 'ambab_emicalculator_emi';
	
	//Unique identifier for use within caching
	protected $_cacheTag = self::CACHE_TAG;
	
	protected function _construct()
    {
        $this->_init('Ambab\EmiCalculator\Model\ResourceModel\Allemi');
    }
	
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];
        return $values;
    }

    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

    public function getEmiId() 
    {
        return parent::getData(self::EMI_ID);
    }

    public function getBankCode() 
    {
        return $this->getData(self::BANK_CODE);
    }

    public function getMonth() 
    {
        return $this->getData(self::MONTH);
    }

    public function getInterest() 
    {
        return $this->getData(self::INTEREST);
    }

    public function getStatus() 
    {
        return $this->getData(self::STATUS);
    }

    public function getCreatedAt() 
    {
        return $this->getData(self::CREATED_AT);
    }

    public function getUpdatedAt() 
    {
        return $this->getData(self::UPDATED_AT);
    }


    public function setEmiId($id) 
    {
        return parent::setData(self::EMI_ID, $id);
    }

    public function setBankCode($bankCode) 
    {
        return $this->setData(self::BANK_CODE, $bankCode);
    }

    public function setMonth($month) 
    {
        return $this->setData(self::MONTH, $bankCode);
    }

    public function setInterest($interest) 
    {
        return $this->setData(self::INTEREST, $bankCode);
    }

    public function setStatus($status) 
    {
        return $this->setData(self::STATUS, $bankCode);
    }

    public function setCreatedAt($createdAt) 
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    public function setUpdatedAt($updatedAt) 
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
?>
