<?php

class ProcessPipes
{
    /**
     * @var array
     */
    public $pipes;

    /**
     * Proses için yazma ve okuma tanımlayıcılarını döndürecektir
     *
     * @return array
     */
    public function getDescriptors(): array
    {
        return array(
            0 => array('pipe', 'r'),
            1 => array('pipe', 'w'),
            2 => array('pipe', 'w')
        );
    }

    /**
     * Pipelar kapatılacaktır
     */
    public function close(): void
    {
        foreach ($this->pipes as $pipe) {
            fclose($pipe);
        }
        $this->pipes = [];
    }
}

?>