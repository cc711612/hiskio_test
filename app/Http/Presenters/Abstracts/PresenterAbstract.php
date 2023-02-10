<?php
namespace App\Http\Presenters\Abstracts;

/**
 * Class PresenterAbstract
 *
 * @package App\Http\Presenters\Abstracts
 * @Author: Roy
 * @DateTime: 2023/2/10 下午 04:47
 */
class PresenterAbstract
{
    /**
     * @var
     * @Author  : daniel
     * @DateTime: 2020-05-08 17:41
     */
    private $_data;
    /**
     * @var
     * @Author  : daniel
     * @DateTime: 2020-05-08 17:41
     */
    private $_resource;
    /**
     * @param $name
     * @param $resource
     *
     * @return $this
     * @Author  : daniel
     * @DateTime: 2020-05-08 17:41
     */
    public function setResource($name, $resource)
    {
        $this->_resource[$name] = $resource;
        return $this;
    }
    /**
     * @param string $name
     *
     * @return  |null
     * @Author  : daniel
     * @DateTime: 2020-05-08 17:41
     */
    protected function getResource(string $name)
    {
        if (isset($this->_resource[$name])) {
            return $this->_resource[$name];
        } else {
            return null;
        }
    }
    /**
     * @param string $name
     * @param        $value
     *
     * @return $this
     * @Author  : daniel
     * @DateTime: 2020-05-08 17:41
     */
    public function put(string $name, $value)
    {
        data_set($this->_data, $name, $value);
        return $this;
    }
    /**
     * @param string $name
     *
     * @return mixed
     * @Author  : daniel
     * @DateTime: 2020-05-08 17:41
     */
    public function get(string $name)
    {
        return data_get($this->_data, $name);
    }
    /**
     * @return mixed
     * @Author  : daniel
     * @DateTime: 2020-05-08 17:41
     */
    public function all()
    {
        return json_decode(json_encode($this->_data));
    }
    /**
     * @return mixed
     * @Author  : daniel
     * @DateTime: 2020-05-08 17:41
     */
    public function toArray()
    {
        return $this->_data;
    }
}
