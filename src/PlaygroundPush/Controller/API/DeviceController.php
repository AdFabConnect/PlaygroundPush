<?php

namespace PlaygroundPush\Controller\Api;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Http\Response;
use PlaygroundPush\Entity\Device;

class DeviceController extends AbstractActionController
{
    /**
    * @var ServiceLocator $serviceLocator
    */
    protected $serviceLocator;

    public function addAction()
    {
        $data = $this->getRequest()->getPost('data');
        $data = json_decode($data, true);

        if(empty($data)) {
            $return = array('status' => 1, 'message' => 'data is mandatory');

            return $this->sendResponse($return);
        }

        if (empty($data['token']) || empty($data['platform']) || empty($data['uuid'])) {
             $return = array('status' => 2, 'message' => 'token, platform, uuid is mandatory');

            return $this->sendResponse($return);
        }

        $action = "insert";
        $existDevice = $this->getServiceLocator()->get('playgroundpush_device_service')->getDeviceMapper()->findOneBy(array('token' => $data['token']));
        
        if (!empty($existDevice)) {
            $device = $existDevice;
            $action = "update";
        } else {
            $device = new Device();
        }

        $device->setToken($data['token']);
        $device->setPlatform($data['platform']);
        $device->setUUID($data['uuid']);

        $device->setName(!empty($data['name'])?$data['name']:'');
        $device->setModel(!empty($data['model'])?$data['model']:'');
        $device->setVersion(!empty($data['version'])?$data['version']:'');
        $device->setAppVersion(!empty($data['appVersion'])?$data['appVersion']:'');
            
        $device = $this->getServiceLocator()->get('playgroundpush_device_service')->getDeviceMapper()->$action($device);

        $return = array('status' => 0, 'message' => '');

        return $this->sendResponse($return);
    }

    public function sendResponse($return)
    {
         $response = $this->getResponse();
         $response->setStatusCode(200);
 
         $response->getHeaders()->addHeaderLine('Access-Control-Allow-Origin', '*');
         $response->setContent(json_encode($return));
 
         return $response;
    }


}