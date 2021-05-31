<?php
namespace AHT\AttributeCustomer\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    /**
     * @param \Magento\Eav\Model\Config
     */
    private $eavConfig;

    /**
     * @param \Magento\Customer\Model\ResourceModel\Attribute
     */
    private $attributeResource;

    public function __construct(
        EavSetupFactory $eavSetupFactory,
        \Magento\Eav\Model\Config $eavConfig,
        \Magento\Customer\Model\ResourceModel\Attribute $attributeResource)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->attributeResource = $attributeResource;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
    
        $attributes = [
            'organization_name' => [
                'type'         => 'text',
                'label'        => 'Organization name',
                'input'        => 'text',
                'position'     => 999,
                'visible'      => true,
                'required'     => false,
                'system'       => 0
            ],
            'contact_phone_number' => [
                'type'         => 'text',
                'label'        => 'Contact phone number',
                'input'        => 'text',
                'position'     => 1000,
                'visible'      => true,
                'required'     => true,
                'system'       => 0
            ],
            'company_type' => [
                'type'         => 'int',
                'label'        => 'Company type',
                'input'        => 'select',
                'source'       => 'AHT\AttributeCustomer\Model\Source\CompanyTypeSelect',
                'position'     => 1001,
                'visible'      => true,
                'required'     => true,
                'system'       => 0
            ]
        ];

        foreach ($attributes as $key => $value) {
            $eavSetup->removeAttribute(\Magento\Customer\Model\Customer::ENTITY, $key);
            $eavSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, $key, $value);
            $customerAttr = $this->eavConfig->getAttribute(\Magento\Customer\Model\Customer::ENTITY, $key);
            $customerAttr->setData(
                'used_in_forms',
                ['adminhtml_customer', 'checkout_register', 'customer_account_create', 'customer_account_edit', 'adminhtml_checkout']
            );
            $this->attributeResource->save($customerAttr);
        }

        $setup->endSetup();
    }
}