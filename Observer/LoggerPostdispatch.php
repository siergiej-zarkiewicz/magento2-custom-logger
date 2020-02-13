<?php

/**
 * Zarkiewicz\CustomLogger
 *
 * @package Zarkiewicz\CustomLogger\Observer
 * @author Siergiej Zarkiewicz <siergiej.zarkiewicz@gmail.com>
 * @copyright Siergiej Zarkiewicz <siergiej.zarkiewicz@gmail.com>
 * @license Open Software License (OSL 3.0)
 */

declare(strict_types = 1);

namespace Zarkiewicz\CustomLogger\Observer;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

/**
 * Class LoggerPostdispatch
 *
 * @package Zarkiewicz\CustomLogger\Observer
 */
class LoggerPostdispatch implements ObserverInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * LoggerPostdispatch constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        /** @var RequestInterface $request */
        $request = $observer->getEvent()->getRequest();

        $actionName = $request->getActionName();
        $moduleName = $request->getModuleName();
        $params = $request->getParams();

        $this->logger->debug(
            'Postdispatch action',
            [
                'action_name' => $actionName,
                'module_name' => $moduleName,
                'params' => $params,
            ]
        );
    }
}
