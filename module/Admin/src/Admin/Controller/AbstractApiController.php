<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\Json\Json;

abstract class AbstractApiController extends BaseController
{
    protected $request, $response, $entityId;

    public function indexAction() {
        $this->request = $this->getRequest();
        $this->response = $this->getResponse();
        $this->entityId = (int) $this->params()->fromRoute('id', 0);

        $method = $this->request->getMethod();
        switch ($method) {
            case 'GET':
                $this->read($this->entityId);
                break;

            case 'POST':
                $this->create();
                break;

            case 'PATCH':
            case 'PUT':
                $this->update($this->entityId);
                break;

            case 'DELETE':
                $this->delete($this->entityId);
                break;

            default:
                $this->send405();
                break;
        }

        // return JSON response
        return $this->response;
    }

    protected function read() {
        $this->send405();
    }

    protected function create() {
        $this->send405();
    }

    protected function update() {
        $this->send405();
    }

    protected function delete() {
        $this->send405();
    }

    private function send405() {
        $this->response->setStatusCode(405);
        $this->response->setContent(Json::encode(array('message' => 'Method is not allowed')));
    }
}
