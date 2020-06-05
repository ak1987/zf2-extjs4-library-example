<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Admin\Form\AuthorAddForm;
use Application\Entity\Author;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\ORM\Query;
use Zend\Hydrator\Reflection as ReflectionHydrator;
use Zend\Json\Json;


class AuthorsRestController extends AbstractApiController
{
    public function indexAction()
    {
        parent::indexAction();
        return $this->response;
    }

    protected function create()
    {
        $em = $this->getEntityManager();
        $form = new AuthorAddForm($em);

        $data = $this->getRequest()->getPost();

        $author = new Author();
        $form->setHydrator(new DoctrineHydrator($em, '\Author'));
        $form->bind($author);
        $form->setData($data);

        if ($form->isValid()) {
            // successful validation
            $em->persist($author);
            $em->flush();

            // object to array conversion
            $hydrator = new ReflectionHydrator();
            $response = $hydrator->extract($author);

            $this->response->setStatusCode(201);
        } else {
            // validation failed
            $errors = array();
            foreach ($form->getInputFilter()->getInvalidInput() as $key => $invalidInput) {
                foreach ($invalidInput->getMessages() as $key2 => $error) {
                    $errors[$key] = ' ' . $error;
                }
            }
            $response = $errors;
            $this->response->setStatusCode(400);
        }
        // setting content to send response
        $this->response->setContent(Json::encode($response));
    }

    protected function read($entityId)
    {
        // getting offset
        $limit = 20; // default records per page
        $offset = (int)$this->request->getQuery('offset');

        // doctrine enitity manager
        $em = $this->getEntityManager();

        // fetch single record by id
        if ($entityId) {
            $dql = "SELECT a.id, a.name FROM Application\Entity\Author a WHERE a.id = $entityId";
            $query = $em->createQuery($dql);
            $author = $query->getResult(Query::HYDRATE_ARRAY);
            if ($author) {
                $response = $author;
            } else {
                // return 404 if not found
                return $this->send404();
            }
        } else {
            // fetch results
            $dql = "SELECT a.id, a.name FROM Application\Entity\Author a";
            $query = $em->createQuery($dql)
                ->setMaxResults($limit)
                ->setFirstResult($offset);
            $author = $query->getResult(Query::HYDRATE_ARRAY);
            if ($author) {
                $response = $author;
            } else {
                // return 404 if not found
                return $this->send404();
            }
        }
        // setting content to send response
        $this->response->setContent(Json::encode($response));
    }

    protected function update($entityId)
    {
        $em = $this->getEntityManager();
        $author = $em->find('Application\Entity\Author', $entityId);
        if($author) {
            $form = new AuthorAddForm($em);
            // getting request body
            $data = $this->getRequest()->getContent();
            $form->setHydrator(new DoctrineHydrator($em, '\Author'));
            $form->bind($author);
            $form->setData($data);
            if($form->isValid()) {
                $em->persist($author);
                $em->flush();
                $this->response->setStatusCode(204);
            } else {
                // validation failed
                $errors = array();
                foreach ($form->getInputFilter()->getInvalidInput() as $key => $invalidInput) {
                    foreach ($invalidInput->getMessages() as $key2 => $error) {
                        $errors[$key] = ' ' . $error;
                    }
                }
                $response = $errors;
                $this->response->setStatusCode(400);
            }
        } else {
            $this->send404();
        }
        // setting content to send response
        $this->response->setContent(Json::encode($response));
    }

    protected function delete($entityId)
    {
        $em = $this->getEntityManager();
        // looking for record
        try {
            $repository = $em->getRepository('Application\Entity\Author');
            $author = $repository->find($entityId);
            if ($author) {
                $em->remove($author);
                $em->flush();
                $this->response->setStatusCode(204);
            } else {
                $this->send404();

            }
        } catch (\Exception $exception) {
            $this->response->setStatusCode(500);
            $this->response->setContent(Json::encode(array('Server Error')));
        }
    }
}
