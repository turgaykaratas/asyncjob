<?php

require_once 'class_loader.php';

class AsyncJob
{
    /**
     * @var resource
     */
    protected $process;

    /**
     * @var string
     */
    protected $commandLine;

    /**
     * @var ProcessPipes
     */
    protected $processPipes;

    /**
     * @var array
     */
    protected $processInformation;

    /**
     * AsyncJob constructor.
     * @param AbstructJob $job
     */
    public function __construct(AbstructJob $job)
    {
        $encodeJob = base64_encode(\serialize($job));

        $this->commandLine = 'php .\process.php ' . $encodeJob;

        $this->processPipes = new ProcessPipes();

        $this->openProcess();
    }

    /**
     * Process'i başlatacaktır
     */
    protected function openProcess(): void
    {
        $this->process = proc_open($this->commandLine, $this->processPipes->getDescriptors(), $this->processPipes->pipes);
    }

    /**
     * Process'in çıktısı alınacaktır
     *
     * @return Result
     */
    public function getResult() : Result
    {
        $this->wait();

        $encodeResult = stream_get_contents($this->processPipes->pipes[1]);

        $result = unserialize(base64_decode($encodeResult));

        $this->stopProcess();

        return $result;
    }

    /**
     *  Process işini bitirene kadar bekleyecektir
     *
     * @return $this
     */
    protected function wait(): self
    {
        while ($this->isProcessRunning()) {

            usleep(1000);
        }
        return $this;
    }

    /**
     * Process'in çalışmasını kontrol edilecektir
     *
     * @return bool
     */
    protected function isProcessRunning(): bool
    {
        $this->checkProcessStatus();

        return $this->processInformation['running'];
    }

    /**
     * Process'in durumu ile ilgili bilgileri alacaktır
     */
    protected function checkProcessStatus(): void
    {
        $this->processInformation = proc_get_status($this->process);
    }

    /**
     * Process'i kapatacaktır
     */
    protected function closeProcess(): void
    {
        if (\is_resource($this->process)) {
            proc_close($this->process);
        }
    }

    /**
     * İşlemi sonlandıracaktır
     */
    protected function stopProcess()
    {
        $this->processPipes->close();

        $this->closeProcess();
    }
}

?>