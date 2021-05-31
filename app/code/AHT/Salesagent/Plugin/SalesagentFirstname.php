<?php
namespace AHT\Salesagent\Plugin;

class SalesagentFirstname
{
    public function afterGetFirstname(\Magento\Customer\Model\Data\Customer $subject, $result) 
    {
        if ($subject->getCustomAttribute('is_sales_agent') && $subject->getCustomAttribute('is_sales_agent')->getValue() == 1) {
            $result = "Sales Agent: " . $result;
        }

        return $result;
    }
}
