<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/3/14
 * Time: 下午3:23
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace Welcome\Events;

use FastD\Framework\Events\RestEvent;
use FastD\Http\JsonResponse;
use FastD\Http\Request;
use Helpers\Demo\Test;

/**
 * Class Index
 *
 * @package Welcome\Events
 */
class Index extends RestEvent
{
    public function __initialize()
    {

    }

    public function welcomeAction(Test $test)
    {
        return $this->responseJson(['a' => $test]);
    }

    public function viewAction()
    {
        return 'demo';
    }

    public function diAction(Request $request)
    {
        return new JsonResponse($request->query->all());
    }

    public function dbAction()
    {
        $read = $this->getConnection('read');

        return $read->getConnectionInfo();
    }

    public function oneAction(Request $request)
    {
        return new JsonResponse($request->header->all());
    }

    public function twoAction(Request $request)
    {
        return $request->createRequest($this->generateUrl('/one'))->delete();
    }

    public function uploadAction(Request $request)
    {
        $files = $request
            ->getUploader([
                'save.path' => $this->get('kernel')->getRootPath().'/storage/cache',
                'max.size' => '10M',
            ])
            ->uploading()
            ->getUploadFiles();

        return new JsonResponse($files);
    }
}