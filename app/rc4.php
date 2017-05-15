<?php
/**
03
 * Class RC4
04
 *
05
 * @category Crypt
06
 * @author   Rafael M. Salvioni
07
 */
/**
10
 * Class RC4
11
 *
12
 * Implements the encrypt algorithm RC4.
13
 *
14
 * @category Crypt
15
 * @author   Rafael M. Salvioni
16
 * @see      http://pt.wikipedia.org/wiki/RC4
17
 */
class RC4
{
    /**
21
     * Store the permutation vectors
22
     *
23
     * @var array
24
     */
    private static $S = array();
    /**
28
     * Swaps values on the permutation vector.
29
     *
30
     * @param int $v1 Value 1
31
     * @param int $v2 Value 2
32
     */
    private static function swap(&$v1, &$v2)
    {
        $v1 = $v1 ^ $v2;
        $v2 = $v1 ^ $v2;
        $v1 = $v1 ^ $v2;
    }
    /**
41
     * Make, store and returns the permutation vector about the key.
42
     *
43
     * @param string $key Key
44
     * @return array
45
     */
    private static function KSA($key)
    {
        $idx = crc32($key);
        if (!isset(self::$S[$idx])) {
            $S   = range(0, 255);
            $j   = 0;
            $n   = strlen($key);
            for ($i = 0; $i < 255; $i++) {
                $char  = ord($key{$i % $n});
                $j     = ($j + $S[$i] + $char) % 256;
                self::swap($S[$i], $S[$j]);
            }
            self::$S[$idx] = $S;
        }
        return self::$S[$idx];
    }
    /**
64
     * Encrypt the data.
65
     *
66
     * @param string $key Key
67
     * @param string $data Data string
68
     * @return string
69
     */
    public static function encrypt($key, $data)
    {
        $S    = self::KSA($key);
        $n    = strlen($data);
        $i    = $j = 0;
        $data = str_split($data, 1);
        for ($m = 0; $m < $n; $m++) {
            $i        = ($i + 1) % 256;
            $j        = ($j + $S[$i]) % 256;
            self::swap($S[$i], $S[$j]);
            $char     = ord($data{$m});
            $char     = $S[($S[$i] + $S[$j]) % 256] ^ $char;
            $data[$m] = chr($char);
        }
        $data = implode('', $data);
        return $data;
    }
    /**
89
     * Decrypts the data.
90
     *
91
     * @param string $key Key
92
     * @param string $data Encripted data
93
     * @return string
94
     */
    public static function decrypt($key, $data)
    {
        return self::encrypt($key, $data);
    }
}
?>


