<?php
/**
 * Cross - a micro PHP 5 framework
 *
 * @link        http://www.crossphp.com
 * @license     MIT License
 */
namespace Cross\Core;

/**
 * @Auth: cmz <393418737@qq.com>
 * Class CrossArray
 * @package Cross\Core
 */
class CrossArray
{
    /**
     * @var array 数据
     */
    protected $data;

    /**
     * @var self
     */
    protected static $instance;

    /**
     * CrossArray
     *
     * @param array $data
     */
    private function __construct(array &$data)
    {
        $this->data = &$data;
    }

    /**
     * @param array $data
     * @param string $cache_key
     * @return CrossArray
     */
    static function init(array &$data, $cache_key = null)
    {
        if (null === $cache_key) {
            $cache_key = md5(json_encode($data));
        }

        if (!isset(self::$instance[$cache_key])) {
            self::$instance[$cache_key] = new self($data);
        }

        return self::$instance[$cache_key];
    }

    /**
     * 获取配置参数
     *
     * @param string $config
     * @param string|array $name
     * @return bool|string|array
     */
    function get($config, $name = '')
    {
        if (isset($this->data[$config])) {
            if ($name) {
                if (is_array($name)) {
                    $result = array();
                    foreach ($name as $n) {
                        if (isset($this->data[$config][$n])) {
                            $result[$n] = $this->data[$config][$n];
                        }
                    }
                    return $result;
                } elseif (isset($this->data[$config][$name])) {
                    return $this->data[$config][$name];
                }

                return false;
            }

            return $this->data[$config];
        }
        return false;
    }

    /**
     * 更新成员或赋值
     *
     * @param string $index
     * @param string|array $values
     * @return bool
     */
    function set($index, $values = '')
    {
        if (is_array($values)) {
            if (isset($this->data[$index])) {
                $this->data[$index] = array_merge($this->data[$index], $values);
            } else {
                $this->data[$index] = $values;
            }
        } else {
            $this->data[$index] = $values;
        }

        return true;
    }

    /**
     * 返回全部数据
     *
     * @param bool $obj 是否返回对象
     * @return array|object
     */
    function getAll($obj = false)
    {
        if ($obj) {
            return self::arrayToObject($this->data);
        }

        return $this->data;
    }

    /**
     * 数组转对象
     *
     * @param $data
     * @return object|string
     */
    static function arrayToObject($data)
    {
        if (is_array($data)) {
            return (object)array_map('self::arrayToObject', $data);
        } else {
            return $data;
        }
    }
}
