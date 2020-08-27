<?php

class Result
{
    const OK = 'ok';
    const ERR = 'error';

    /**
     * @var string
     */
    private $status;
    /**
     * @var mixed
     */
    private $result;

    /**
     * Result constructor.
     * @param string $status
     * @param $result
     */
    public function __construct(string $status, $result)
    {
        $this->status = $status;
        $this->result = $result;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }
}

?>