<?php

namespace Ambab\EmiCalculator\Block\Adminhtml\EmiGrid\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;

/**
 * Bank form block
 */
class Main extends Generic implements TabInterface
{
    protected $_status;
    protected $_coreRegistry = null;
    protected $date;
    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected $_adminSession;


    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry             $registry
     * @param \Magento\Framework\Data\FormFactory     $formFactory
     * @param \Magento\Backend\Model\Auth\Session     $adminSession
     * @param \Rh\Bank\Model\Status                   $status
     * @param array                                   $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Ambab\EmiCalculator\Model\Allemi\Source\Status $source,
        \Magento\Backend\Model\Auth\Session $adminSession,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        array $data = []
    ) {
        $this->_adminSession = $adminSession;
        $this->_status = $source;
        $this->date = $date;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare the form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('ambab_emicalculator_emis_form_data');

        $isElementDisabled = false;

        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('EMI Options')]);

        if ($model->getId()) {
            $fieldset->addField('emi_id', 'hidden', ['name' => 'emi_id']);
        }

        $fieldset->addField(
            'bank_code',
            'select',
            [
                'label' => __('Bank Code'),
                'title' => __('Bank Code'),
                'name' => 'bank_code',
                'required' => true,
                'options' => $this->_status->getOnlyBankCode(),
                'disabled' => $isElementDisabled,
            ]
        );

        $fieldset->addField(
            'month',
            'text',
            [
                'id' => 'month',
                'name' => 'month',
                'label' => __('Months'),
                'title' => __('Months'),
                'required' => true,
                'disabled' => $isElementDisabled,
            ]
        );

        $fieldset->addField(
            'interest',
            'text',
            [
                'name' => 'interest',
                'label' => __('Interest Rate'),
                'title' => __('Interest Rate'),
                'required' => true,
                'disabled' => $isElementDisabled,
            ]
        );

        $fieldset->addField(
            'status',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'status',
                'required' => true,
                'options' => ['1' => __('Active'), '0' => __('Inactive')],
                'disabled' => $isElementDisabled,
            ]
        );

        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);

        $form->addValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * Return Tab label
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('EMI Options');
    }

    /**
     * Return Tab title
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('EMI Options');
    }

    /**
     * Can show tab in tabs
     *
     * @return boolean
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Tab is hidden
     *
     * @return boolean
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}