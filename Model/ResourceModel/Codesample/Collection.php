<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magelearn\CodeSample\Model\ResourceModel\Codesample;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';
	protected $_previewFlag;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Magelearn\CodeSample\Model\Codesample::class,
            \Magelearn\CodeSample\Model\ResourceModel\Codesample::class
        );
		$this->_map['fields']['entity_id'] = 'main_table.entity_id';
    }
}

