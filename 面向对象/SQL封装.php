<?php

class MySQLDB {
    private $host;
    private $user;
    private $pwd;
    private $dbname;
    private $port;
    private $charset;
    private $link;
    private static $instance;

    private function __construct($param) {
        $this->initParam($param);
        $this->initConnect();
    }

    private function __clone() {
        // TODO: Implement __clone() method.
    }

    public static function getInstance($param = array()) {
        if (!self::$instance instanceof self)
            self::$instance = new self($param);
        return self::$instance;
    }

    // 初始化参数
    private function initParam($param) {
        $this->host = $param['host'] ?? 'localhost';
        $this->user = $param['user'] ?? '';
        $this->pwd = $param['pwd'] ?? '';
        $this->dbname = $param['dbname'] ?? '';
        $this->port = $param['port'] ?? '3306';
        $this->charset = $param['charset'] ?? 'utf8';
    }

    // 连接数据库
    private function initConnect() {
        $this->link = @mysqli_connect($this->host, $this->user, $this->pwd, $this->dbname);
        if (mysqli_connect_error()) {
            echo '数据库连接失败!<br>';
            echo '错误信息: ' . mysqli_connect_error(), '<br>';
            echo '错误码: ' . mysqli_connect_errno(), '<br>';
            exit;
        }
        mysqli_set_charset($this->link, $this->charset);
    }

    // 执行数据库的增、删、改、查
    private function execute($sql) {
        if (!$result = mysqli_query($this->link, $sql)) {
            echo 'SQL语句执行失败！<br>';
            echo '错误信息: ' . mysqli_error($this->link), '<br>';
            echo '错误码：' . mysqli_errno($this->link), '<br>';
            echo '错误的SQL语句：' . $sql, '<br>';
            exit;
        }
        return $result;
    }

    /**
     * 执行增、删、改
     * @param $sql
     * @return bool|mysqli_result
     */
    public function exec($sql) {
        $key = substr($sql, 0, 6);
        if (in_array($key, array('insert', 'update', 'delete')))
            return $this->execute($sql);
        else {
            echo '非法访问';
            exit;
        }
    }

    // 获取自动增长的id
    public function getLastInsertId() {
        return mysqli_insert_id($this->link);
    }

    // 执行查询语句
    public function query($sql) {
        if (substr($sql, 0, 6) == 'select' || substr($sql, 0, 6) == 'show' || substr($sql, 0, 6) == 'desc') {
            return $this->execute($sql);
        } else {
            echo '非法访问';
            exit;
        }
    }

    /**
     * 执行查询语句，返回二维数组
     * @param $sql
     * @param string $type assoc|num|both
     * @return array|null
     */
    public function fetchAll($sql, $type = 'assoc') {
        $result = $this->query($sql);
        $type = $this->getType($type);
        return mysqli_fetch_all($result, $type);
    }

    // 匹配一维数组
    public function fetchRow($sql, $type = 'assoc') {
        $list = $this->fetchAll($sql, $type);
        if (!empty($list))
            return $list[0];
        return array();
    }

    // 匹配一行一列
    public function fetchColumn($sql) {
        $list = $this->fetchAll($sql, 'num');
        if (!empty($list))
            return $list[0];
        return null;
    }

    // 获取匹配类型
    private function getType($type) {
        switch ($type) {
            case 'num':
                return MYSQLI_NUM;
            case 'both':
                return MYSQLI_BOTH;
            default:
                return MYSQLI_ASSOC;
        }
    }
}

// 配置参数
$param = array(
    'user' => 'root',
    'pwd' => '123456',
    'dbname' => 'php_wish'
);

// 获取单例
$db = MySQLDB::getInstance($param);

// 插入成功
//if ($db->exec("insert into news values (null, '测试')"))
//    echo 'id是：' . $db->getLastInsertId();

// 查询
$link = $db->fetchAll("select * from news");
echo '<pre>';
var_dump($link);
