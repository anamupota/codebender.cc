<?php

namespace Ace\ProjectBundle\Tests\Controller;

class MongoFilesControllerUnitTest extends \PHPUnit_Framework_TestCase
{
    protected $pf;
	public function testCreateAction()
    {
        $controller = $this->setUpController($dm,NULL);
        $dm->expects($this->once())->method("persist");
        $dm->expects($this->once())->method('flush');

        $response = $controller->createAction();
        $this->assertEquals($response, '{"success":true,"id":null}');

    }

    public function testDeleteAction()
    {
        $controller = $this->setUpController($dm,array('getProjectById'));
        $controller->expects($this->once())->method('getProjectById')->with($this->equalTo(1234))->will($this->returnValue($this->pf));
        $dm->expects($this->once())->method("remove")->with($this->equalTo($this->pf));
        $dm->expects($this->once())->method('flush');

        $response = $controller->deleteAction(1234);
        $this->assertEquals($response, '{"success":true}');

    }


    protected function setUp()
    {
        $this->pf = $this->getMockBuilder('Ace\ProjectBundle\Document\ProjectFiles')
            ->disableOriginalConstructor()
            ->getMock();
    }

    private function setUpController(&$dm, $m)
    {
        $dm = $this->getMockBuilder('Doctrine\ODM\MongoDB\DocumentManager')
            ->disableOriginalConstructor()
            ->getMock();

        $controller = $this->getMock('Ace\ProjectBundle\Controller\MongoFilesController', $methods = $m, $arguments = array($dm));
        return $controller;
    }
}
