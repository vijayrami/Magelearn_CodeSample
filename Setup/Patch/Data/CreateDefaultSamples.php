<?php

namespace Magelearn\CodeSample\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CreateDefaultSamples implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    public function __construct(
       ModuleDataSetupInterface $moduleDataSetup

     ) {

        $this->moduleDataSetup = $moduleDataSetup;

    }
    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $setup = $this->moduleDataSetup;

        $data = [
                [
                    'product_ids' => '',
                    'additional_text' => 'Text 1'
                ],
                [
                    'product_ids' => '',
                    'additional_text' => 'Text 2'
                ],
                [
                    'product_ids' => '',
                    'additional_text' => 'Text 3'
                ],
                [
                    'product_ids' => '',
                    'additional_text' => 'Text 4'
                ],
                [
                    'product_ids' => '',
                    'additional_text' => 'Text 5'
                ]
            ];

         $this->moduleDataSetup->getConnection()->insertArray(
            $this->moduleDataSetup->getTable('magelearn_codesample'),
            ['product_ids', 'additional_text'],
            $data
        );     
        $this->moduleDataSetup->endSetup();
    }
    public function getAliases()
    {
        return [];
    }
    public static function getDependencies()
    {
        return [];
    }
}