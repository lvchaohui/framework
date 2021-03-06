<?php
/**
 * 微服务
 * @author wsfuyibing <websearch@163.com>
 * @date 2017-11-03
 */
namespace Pails\Controllers;

use Phalcon\Mvc\Controller;
use UniondrugServiceServer\Server;

/**
 * 微服务服务端基类控制器
 * @property \Phalcon\Logger\Adapter\File $logger
 * @package Pails
 */
abstract class ServiceServerController extends Controller
{
    /**
     * @var Server
     */
    public $serviceServer;
    private $serviceJsonRawBody;

    /**
     * 构造
     * 1. 微服务的服务端对象
     */
    public function onConstruct()
    {
        $this->serviceServer = new Server();
    }

    /**
     * @return \stdClass
     * @throws \Exception
     */
    public function getJsonRawBody()
    {
        if ($this->serviceJsonRawBody === null) {
            try {
                $this->serviceJsonRawBody = $this->request->getJsonRawBody();
                if ($this->serviceJsonRawBody === null) {
                    throw new \Exception("无法解析JSON格式的RawBody参数");
                }
            } catch(\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
        return $this->serviceJsonRawBody;
    }
}