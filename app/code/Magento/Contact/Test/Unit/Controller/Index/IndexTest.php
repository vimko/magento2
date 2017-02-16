<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Contact\Test\Unit\Controller\Index;

class IndexTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Controller
     *
     * @var \Magento\Contact\Controller\Index\Index
     */
    private $controller;

    /**
     * Scope config mock
     * @var \Magento\Framework\App\Config\ScopeConfigInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $scopeConfig;

    /**
     * View mock
     * @var \Magento\Framework\App\ViewInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $view;

    /**
     * Url mock
     * @var \Magento\Framework\UrlInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $url;

    protected function setUp()
    {
        $this->scopeConfig = $this->getMockBuilder(
            \Magento\Framework\App\Config\ScopeConfigInterface::class
        )->setMethods(
            ['isSetFlag']
        )->getMockForAbstractClass();

        $context = $this->getMockBuilder(
            \Magento\Framework\App\Action\Context::class
        )->setMethods(
            ['getRequest', 'getResponse', 'getView', 'getUrl']
        )->disableOriginalConstructor(
        )->getMock();

        $this->url = $this->getMockBuilder(\Magento\Framework\UrlInterface::class)->getMockForAbstractClass();

        $context->expects($this->any())
            ->method('getUrl')
            ->will($this->returnValue($this->url));

        $context->expects($this->any())
            ->method('getRequest')
            ->will($this->returnValue(
                $this->getMockBuilder(\Magento\Framework\App\RequestInterface::class)->getMockForAbstractClass()
            ));

        $context->expects($this->any())
            ->method('getResponse')
            ->will($this->returnValue(
                $this->getMockBuilder(\Magento\Framework\App\ResponseInterface::class)->getMockForAbstractClass()
            ));

        $this->view = $this->getMockBuilder(
            \Magento\Framework\App\ViewInterface::class
        )->disableOriginalConstructor(
        )->getMock();

        $context->expects($this->once())
            ->method('getView')
            ->will($this->returnValue($this->view));

        $this->controller = new \Magento\Contact\Controller\Index\Index(
            $context,
            $this->scopeConfig
        );
    }

    public function testExecute()
    {
        $this->view->expects($this->once())
            ->method('loadLayout');

        $this->view->expects($this->once())
            ->method('renderLayout');

        $this->controller->execute();
    }
}
