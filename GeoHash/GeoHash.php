<?php

/**
 * GeoHash 算法类
 *
 * @author zhangzhengkun
 */
class GeoHash
{
    /**
     * 用于 GeoHash 算法进行 base32 编码的字符库
     * 0-9、b-z（去掉a, i, l, o）这32个字母
     *
     * @var array
     */
    private $coding = [
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',

        'b', 'c', 'd', 'e', 'f', 'g', 'h', 'j', 'k', 'm', 'n', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
    ];

    /**
     * 字符库对应的编码映射
     *
     * @var array
     */
    private $codingMap = [];

    /**
     * 各个方向的奇偶位对应的邻接数组
     *
     * @var array
     */
    private $neighbors = [];

    /**
     * 各个方向的奇偶位对应的边界数组
     *
     * @var array
     */
    private $borders = [];

    /**
     * 初始化：使用打表方式计算邻接八个区域的hash
     *
     * 通过奇数位字符的编码是按照“经 纬 经 纬 经”的顺序，偶数位字符的编码是按照“纬 经 纬 经 纬”的顺序
     *
     * 方向指示定义：上（纬度+1，经度不变）/ 下（纬度-1，经度不变）/ 左（经度-1，纬度不变）/ 右（经度+1，纬度不变）/
     *             左上（纬度+1，经度-1）/ 左下（纬度-1，经度-1）/ 右上（纬度+1，经度+1）/ 右下（纬度-1，经度+1）
     *
     * 通过以上知识，可以得到：
     * 奇数位字符（如hash值wx4g里面的w、4）查表
     *  b  c  f  g  u  v  y  z
    8  9  d  e  s  t  w  x
    2  3  6  7  k  m  q  r
    0  1  4  5  h  j  n  p
     *
     * 偶数位字符（如hash值wx4g里面的x、g）查表
     *  p  r  x  z
    n  q  w  y
    j  m  t  v
    h  k  s  u
    5  7  e  g
    4  6  d  f
    1  3  9  c
    0  2  8  b
     *
     * 所以，要求GeoHash周围的8个hash值，就相当于求出最后一个字符周围的8个字符。
     * 如果最后一个字符处于边界，还要求倒数第二个字符周围同方向的相邻字符，如果倒数第二个字符也处于边界就要求倒数第三个，以此类推
     *
     * @see https://blog.csdn.net/u014520745/article/details/52619796
     *
     */
    public function __construct()
    {
        // b(c)作为最后一位偶数时，右边的是0(1)，以此类推
        $this->neighbors['right']['even'] = 'bc01fg45238967deuvhjyznpkmstqrwx';
        $this->neighbors['left']['even'] = '238967debc01fg45kmstqrwxuvhjyznp';
        $this->neighbors['top']['even'] = 'p0r21436x8zb9dcf5h7kjnmqesgutwvy';
        $this->neighbors['bottom']['even'] = '14365h7k9dcfesgujnmqp0r2twvyx8zb';

        $this->borders['right']['even'] = 'bcfguvyz';
        $this->borders['left']['even'] = '0145hjnp';
        $this->borders['top']['even'] = 'prxz';
        $this->borders['bottom']['even'] = '028b';

        $this->neighbors['bottom']['odd'] = $this->neighbors['left']['even'];
        $this->neighbors['top']['odd'] = $this->neighbors['right']['even'];
        $this->neighbors['left']['odd'] = $this->neighbors['bottom']['even'];
        $this->neighbors['right']['odd'] = $this->neighbors['top']['even'];

        $this->borders['bottom']['odd'] = $this->borders['left']['even'];
        $this->borders['top']['odd'] = $this->borders['right']['even'];
        $this->borders['left']['odd'] = $this->borders['bottom']['even'];
        $this->borders['right']['odd'] = $this->borders['top']['even'];

        /**
         * 字符库 -> 编码映射
         * 0     -> 00000 (0)
         * 1     -> 00001 (1)
         * 2     -> 00010 (2)
         * ......
         * z     -> 11111 (31)
         */
        for ($i = 0; $i < 32; $i++) {
            $this->codingMap[$this->coding[$i]] = str_pad(decbin($i), 5, "0", STR_PAD_LEFT);
        }
    }

    /**
     * 解码（从 geo hash 值解码出坐标经纬度）
     *
     * @param string $hash
     *
     * @return array
     *
     */
    public function decode($hash)
    {
        // 根据hash，析出二进制编码
        $binary = "";
        $hashLength = strlen($hash);
        for ($i = 0; $i < $hashLength; $i++) {
            $binary .= $this->codingMap[substr($hash, $i, 1)];
        }

        // 根据二进制编码，分别析出经度和纬度的二进制编码
        $binaryLength = strlen($binary);
        $latitudeBinary = "";
        $longitudeBinary = "";
        for ($i = 0; $i < $binaryLength; $i++) {
            if ($i % 2) {
                $latitudeBinary = $latitudeBinary . substr($binary, $i, 1);
            } else {
                $longitudeBinary = $longitudeBinary . substr($binary, $i, 1);
            }
        }

        // 分别解码获取经度和纬度坐标
        $latitude = $this->binDecode($latitudeBinary, -90, 90);
        $longitude = $this->binDecode($longitudeBinary, -180, 180);

        // 计算需要的精确到的精度（误差）
        $latErr = $this->calcError(strlen($latitudeBinary), -90, 90);
        $longErr = $this->calcError(strlen($longitudeBinary), -180, 180);

        $latPlaces = max(1, -round(log10($latErr))) - 1;
        $longPlaces = max(1, -round(log10($longErr))) - 1;

        // 按照计算出来的精度舍入得到需要的经纬坐标
        $latitude = round($latitude, $latPlaces);
        $longitude = round($longitude, $longPlaces);

        return [
            'latitude' => $latitude,
            'longitude' => $longitude
        ];
    }

    /**
     * 编码（计算指定坐标的 geo hash 值）
     *
     * @param float $latitude
     * @param float $longitude
     *
     * @return string
     *
     */
    public function encode($latitude, $longitude)
    {
        // 获取纬度需要计算的精度
        $latitudePrecision = $this->precision($latitude);
        $latitudeBits = 1;
        $err = 45;
        while ($err > $latitudePrecision) {
            $latitudeBits++;
            $err /= 2;
        }

        // 获取经度需要计算的精度
        $longitudePrecision = $this->precision($longitude);
        $longitudeBits = 1;
        $err = 90;
        while ($err > $longitudePrecision) {
            $longitudeBits++;
            $err /= 2;
        }

        // 精度统一调整
        $bits = max($latitudeBits, $longitudeBits);
        $longitudeBits = $bits;
        $latitudeBits  = $bits;

        // 补齐位数为5的倍数（base32编码共32个字符，32 = 2 ^ 5，编码的时候需要5个一组进行截取）
        $additionBits = 1;
        while (($longitudeBits + $latitudeBits) % 5 != 0) {
            $longitudeBits += $additionBits;
            $latitudeBits += !$additionBits;
            $additionBits = !$additionBits;
        }

        // 分别获取经纬坐标的二进制编码（分别指定长度）
        // 补充：地理经度坐标的范围：-180 ~ 180；地理纬度坐标的范围：-90 ~ 90
        $latitudeBinary  = $this->binEncode($latitude, -90, 90, $latitudeBits);
        $longitudeBinary = $this->binEncode($longitude, -180, 180, $longitudeBits);

        // 初始化二进制编码
        $binary = "";

        // 使用经度进行编码或者纬度进行编码的flag
        $useLongitudeFlag = 1;

        // 经纬交替进行二进制编码
        while (strlen($latitudeBinary) + strlen($longitudeBinary)) {

            if ($useLongitudeFlag) {
                $binary = $binary . substr($longitudeBinary, 0, 1);
                $longitudeBinary = substr($longitudeBinary, 1);
            } else {
                $binary = $binary . substr($latitudeBinary, 0, 1);
                $latitudeBinary = substr($latitudeBinary, 1);
            }

            $useLongitudeFlag = !$useLongitudeFlag;
        }

        // 根据二进制编码计算 hash 编码
        $hash = "";
        for ($i = 0; $i < strlen($binary); $i += 5) {
            $n = bindec(substr($binary, $i, 5));
            $hash = $hash . $this->coding[$n];
        }

        return $hash;
    }

    /**
     * 获取指定范围（min - max）区间之内进行指定次数的划分之后的误差
     *
     * @param int $bits
     * @param double $min
     * @param double $max
     *
     * @return float|int
     *
     */
    private function calcError($bits, $min, $max)
    {
        $err = ($max - $min) / 2;

        while ($bits--) {
            $err /= 2;
        }

        return $err;
    }

    /**
     * 获取指定数字的精度
     *
     * @param double $number
     *
     * @return float|int
     *
     */
    private function precision($number)
    {
        $precision = 0;

        $pt = strpos($number, '.');

        if ($pt !== false) {
            $precision = -(strlen($number) - $pt - 1);
        }

        return pow(10, $precision) / 2;
    }

    /**
     * 获取指定经纬度的二进制编码
     *
     * @param double $number
     * @param double $min
     * @param double $max
     * @param int $bitLength
     *
     * @return string
     *
     */
    private function binEncode($number, $min, $max, $bitLength)
    {
        if ($bitLength == 0) {
            return "";
        }

        $mid = ($min + $max) / 2;

        if ($number > $mid) {
            return "1" . $this->binEncode($number, $mid, $max, $bitLength - 1);
        } else {
            return "0" . $this->binEncode($number, $min, $mid, $bitLength - 1);
        }
    }

    /**
     * 根据二进制进行解码
     *
     * @param int $binary
     * @param double $min
     * @param double $max
     *
     * @return float|int
     *
     */
    private function binDecode($binary, $min, $max)
    {
        $mid = ($min + $max) / 2;

        if (strlen($binary) == 0) {
            return $mid;
        }

        $bit = substr($binary, 0, 1);
        $binary = substr($binary, 1);

        if ($bit == 1) {
            return $this->binDecode($binary, $mid, $max);
        } else {
            return $this->binDecode($binary, $min, $mid);
        }
    }

    /**
     * 获取某个区域的八个邻居区域
     *
     * @param string $hash
     *
     * @return array
     *
     */
    public function getNeighbors($hash)
    {
        $neighbors['top']          = $this->calcAdjacency($hash, 'top');
        $neighbors['bottom']       = $this->calcAdjacency($hash, 'bottom');
        $neighbors['left']         = $this->calcAdjacency($hash, 'left');
        $neighbors['right']        = $this->calcAdjacency($hash, 'right');

        $neighbors['top_left']     = $this->calcAdjacency($neighbors['left'], 'top');
        $neighbors['top_right']    = $this->calcAdjacency($neighbors['right'], 'top');
        $neighbors['bottom_left']  = $this->calcAdjacency($neighbors['left'], 'bottom');
        $neighbors['bottom_right'] = $this->calcAdjacency($neighbors['right'], 'bottom');

        return $neighbors;
    }

    /**
     * 计算某个区域指定方向的邻接区域
     *
     * @param string $hash 某个区域的hash值
     * @param string $direction 邻接方向
     *
     * @return string
     *
     */
    private function calcAdjacency($hash, $direction)
    {
        $hash = strtolower($hash);
        $lastChar = $hash[strlen($hash) - 1];
        $type = (strlen($hash) % 2) ? 'odd' : 'even';

        // 截取掉最后一位
        $base = substr($hash, 0, strlen($hash) - 1);

        if (strpos($this->borders[$direction][$type], $lastChar) !== false) {

            // 最后一位字符处于边界，则递归求解倒数第二位，以此类推
            $base = $this->calcAdjacency($base, $direction);
        }

        return $base . $this->coding[strpos($this->neighbors[$direction][$type], $lastChar)];
    }
}