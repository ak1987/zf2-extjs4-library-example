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


class ApiAuthorsController extends ApiAbstractController
{
// read
    public function indexAction()
    {
        if ($this->checkMethod('GET')) {
            // getting offset
            $start = (int)$this->request->getQuery('start');
            $limit = (int)$this->request->getQuery('limit');

            // doctrine enitity manager
            $em = $this->getEntityManager();

            // fetch single record by id
            if ($this->entityId) {
                $dql = "SELECT a.id, a.name FROM Application\Entity\Author a WHERE a.id = {$this->entityId}";
                $query = $em->createQuery($dql);
                $author = $query->getResult(Query::HYDRATE_ARRAY);
                if ($author) {
                    $response = $author;
                } else {
                    // return 404 if not found
                    return $this->set404();
                }
            } else {
                // fetch results
                $dql = "SELECT a.id, a.name FROM Application\Entity\Author a";
                $query = $em->createQuery($dql)
                    ->setMaxResults($limit)
                    ->setFirstResult($start);
                $authors = $query->getResult(Query::HYDRATE_ARRAY);
                // total authors
                $dql = "SELECT COUNT(a.id) FROM Application\Entity\Author a";
                $query = $em->createQuery($dql);
                $total = $query->getSingleScalarResult();
                if ($authors) {
                    $response = array(
                        'authors' => $authors,
                        'total' => $total
                    );
                } else {
                    // return 404 if not found
                    return $this->set404();
                }
            }
            // setting content to send response
            $this->response->setContent(Json::encode($response));
        }
        return $this->response;
    }

    // create
    public function createAction()
    {
        if ($this->checkMethod('POST')) {
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
                $success = true;
            } else {
                // validation failed
                $errors = array();
                foreach ($form->getInputFilter()->getInvalidInput() as $key => $invalidInput) {
                    foreach ($invalidInput->getMessages() as $key2 => $error) {
                        $errors[] = array(
                            'field' => $key,
                            'text' => $error
                        );
                    }
                }
                $success = false;
                $message = $errors;
            }
            // setting content to send response
            $this->response->setContent(Json::encode(array(
                'success' => $success,
                'message' => $message
            )));
        }
        return $this->response;
    }

    // update
    public function updateAction()
    {
        $em = $this->getEntityManager();
        $author = $em->find('Application\Entity\Author', $this->entityId);
        if($author) {
            $form = new AuthorAddForm($em);
            // getting request body
            $data = $this->getRequest()->getPost();
            $form->setHydrator(new DoctrineHydrator($em, '\Author'));
            $form->bind($author);
            $form->setData($data);
            if($form->isValid()) {
                $em->persist($author);
                $em->flush();
                $success = true;
            } else {
                // validation failed
                $errors = array();
                foreach ($form->getInputFilter()->getInvalidInput() as $key => $invalidInput) {
                    foreach ($invalidInput->getMessages() as $key2 => $error) {
                        $errors[] = array(
                            'field' => $key,
                            'text' => $error
                        );
                    }
                }
                $message = $errors;
                $success = false;
            }
            // setting content to send response
            $this->response->setContent(Json::encode(array(
                'success' => $success,
                'message' => $message
            )));
        } else {
            $this->set404();
        }
        return $this->response;
    }

    // delete
    public function deleteAction()
    {
        if ($this->checkMethod('POST')) {
            if ($this->entityId) {
                $em = $this->getEntityManager();
                // looking for record
                try {
                    $repository = $em->getRepository('Application\Entity\Author');
                    $author = $repository->find($this->entityId);
                    if ($author) {
                        $em->remove($author);
                        $em->flush();
                        $success = true;
                        $message = '';
                    } else {
                        $this->set404();
                    }
                } catch (\Exception $exception) {
                    $success = false;
                    $this->response->setStatusCode(500);
                    $message = 'Server Error';
                }

            } else {
                // TODO : 400 handler
                $success = false;
                $message = 'Bad Request';
            }
            // setting content to send response
            $this->response->setContent(Json::encode(array(
                'success' => $success,
                'message' => $message
            )));
        }
        return $this->response;
    }
}
