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
    public function indexAction() {
        if($this->checkMethod('GET')) {
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
    public function createAction() {

    }

    // update
    public function updateAction() {

    }

    // delete
    public function deleteAction() {

    }
}
