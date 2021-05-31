<?php
namespace AHT\Salesagent\Model\Source;

class CommissionTypeSelect extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    public function getAllOptions() {
        if ($this->_options === null) {
            $this->_options = [
                ['label' => __('Please select'), 'value' => ''],
                ['label' => __('Fixed'), 'value' => 1],
                ['label' => __('Percent'), 'value' => 2]
            ];
        }
        return $this->_options;
    }
}
