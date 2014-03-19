<?php

namespace PlaygroundPush\Controller\Admin;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use PlaygroundPush\Entity\Push;
use DateTime;


class PushController extends AbstractActionController
{
    protected $pushService;

    public function listAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
             $data = array_merge(
                    $request->getPost()->toArray(),
                    $request->getFiles()->toArray()
            );

            if (!empty($data['push']) && !empty($data['push']['message']) && !empty($data['push']['date'])) {
                $state = 0;
                if(!empty($data['push']['state'])) {
                    $state = 1;
                }

                $date = DateTime::createFromFormat('d/m/Y H:i:s', $data['push']['date']);
                $push = new Push();
                $push->setMessage($data['push']['message']);
                $push->setState($state);
                $push->setDate($date);
                $push = $this->getPushService()->getPushMapper()->insert($push);
                $this->redirect()->toUrl('/admin/push');
            }
        }

        $pushs = $this->getPushService()->getPushMapper()->findAll();

        return new ViewModel(array("pushs" => $pushs));
    }

    public function removeAction()
    {
        $pushId = $this->getEvent()->getRouteMatch()->getParam('pushId');
        $push = $this->getPushService()->getPushMapper()->findById($pushId);
        $this->getPushService()->getPushMapper()->remove($push);
        $this->redirect()->toUrl('/admin/push');
    }


    public function editAction()
    {
        $pushId = $this->getEvent()->getRouteMatch()->getParam('pushId');
        $push = $this->getPushService()->getPushMapper()->findById($pushId);

        $request = $this->getRequest();
        if ($request->isPost()) {
             $data = array_merge(
                    $request->getPost()->toArray(),
                    $request->getFiles()->toArray()
            );

            if (!empty($data['push']) && !empty($data['push']['message']) && !empty($data['push']['date'])) {
                $state = 0;
                if(!empty($data['push']['state'])) {
                    $state = 1;
                }

                $date = DateTime::createFromFormat('d/m/Y H:i:s', $data['push']['date']);
                $push->setMessage($data['push']['message']);
                $push->setState($state);
                $push->setDate($date);
                $push = $this->getPushService()->getPushMapper()->update($push);
                $this->redirect()->toUrl('/admin/push');
            }
        }
        return new ViewModel(array("push" => $push));
    }

    public function getPushService()
    {
        if (null === $this->pushService) {
            $this->pushService = $this->getServiceLocator()->get('playgroundpush_push_service');
        }

        return $this->pushService;
    }
}