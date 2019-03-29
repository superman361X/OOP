<?php

namespace Models\Lock;


class FileLock
{
    //文件锁存放路径
    private $path = '';
    //文件句柄
    private $fp = '';
    //锁文件
    private $lockFile = '';

    /**
     * 构造函数
     * @param string $path 锁的存放目录
     * @param string $name 锁 KEY
     */
    public function __construct($name, $path = '')
    {
        if (empty($path)) {
            $this->path = dirname(__FILE__) . '/';
        } else {
            $this->path = $path;
        }

        $this->lockFile = $this->path . md5($name) . '.lock';
    }

    /**
     * 加锁
     */
    public function lock()
    {
        $this->fp = fopen($this->lockFile, 'a+');
        if ($this->fp === false) {
            return false;
        }
        //LOCK_EX 获取独占锁
        //LOCK_NB 无法建立锁定时，不阻塞
        return flock($this->fp, LOCK_EX | LOCK_NB);
    }

    /**
     * 解锁
     */
    public function unlock()
    {
        if ($this->fp !== false) {
            @flock($this->fp, LOCK_UN);
            clearstatcache();
        }
        @fclose($this->fp);
        @unlink($this->lockFile);
    }
}