<?php
/**
 * Mavenbird Technologies Private Limited
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://mavenbird.com/Mavenbird-Module-License.txt
 *
 * =================================================================
 *
 * @category   Mavenbird
 * @package    Mavenbird DisableCompare 
 * @author     Mavenbird Team
 * @copyright  Copyright (c) 2018-2024 Mavenbird Technologies Private Limited ( http://mavenbird.com )
 * @license    http://mavenbird.com/Mavenbird-Module-License.txt
 */ 
namespace Mavenbird\DisableCompare\Observer;

use Mavenbird\DisableCompare\Helper\Data as ModuleHelper;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class LayoutLoadBefore implements ObserverInterface
{
    /**
     * @var ModuleHelper
     */
    private $moduleHelper;

    public function __construct(ModuleHelper $moduleHelper)
    {
        $this->moduleHelper = $moduleHelper;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $disableCompare = $this->moduleHelper->isEnabled();
        if ($disableCompare) {
            $layout = $observer->getData('layout');
            $layout->getUpdate()->addHandle('remove_compare_products');
        }
    }
}
