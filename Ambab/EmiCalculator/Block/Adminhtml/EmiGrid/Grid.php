<?php

namespace Ambab\EmiCalculator\Block\Adminhtml\EmiGrid;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    protected $_status;

    protected $_emiFactory;

    protected $moduleManager;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Ambab\EmiCalculator\Model\AllemiFactory $emiFactory,
        \Ambab\EmiCalculator\Model\Allemi\Source\Status $source,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_emiFactory = $emiFactory;
        $this->_status = $source;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('gridGrid');
        $this->setDefaultSort('emi_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $this->setVarNameFilter('grid_record');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_emiFactory->create()->getCollection();
        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }

    /**
     * @return $this
     */
    protected function _prepareColumns()
    {

        $this->addColumn(
            'emi_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'emi_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );

        $this->addColumn(
            'bank_code',
            [
                'header' => __('Bank Code'),
                'index' => 'bank_code',
            ]
        );

        $this->addColumn(
            'month',
            [
                'header' => __('Months'),
                'type' => 'number',
                'index' => 'month',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );

        $this->addColumn(
            'interest',
            [
                'header' => __('Interest'),
                'type' => 'number',
                'index' => 'interest',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );

        $this->addColumn(
            'status',
            [
                'header' => __('Status'),
                'index' => 'status',
                'type' => 'options',
                'options' => ['1' => __('Active'), '0' => __('Inactive')],
            ]
        );

        $this->addColumn(
            'edit',
            [
                'header' => __('Edit'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'url' => [
                            'base' => 'banks/*/edit',
                        ],
                        'field' => 'emi_id',
                    ],
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action',
            ]
        );

        $this->addColumn(
            'delete',
            [
                'header' => __('Delete'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Delete'),
                        'url' => [
                            'base' => 'banks/*/delete',
                        ],
                        'field' => 'emi_id',
                    ],
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action',
            ]
        );

        $block = $this->getLayout()->getBlock('grid.bottom.links');

        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('emi_id');
        $this->getMassactionBlock()->setFormFieldName('emi_id');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('banks/*/massDelete'),
                'confirm' => __('Are you sure?'),
            ]
        );

        return $this;
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('banks/*/grid', ['_current' => true]);
    }

    /**
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('banks/*/edit', ['emi_id' => $row->getId()]);
    }
}