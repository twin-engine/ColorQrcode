<?php

namespace rotoos\colorQrcode;

use Closure;
use Endroid\QrCode\QrCode;
use rotoos\colorQrcode\Contracts\PlusInterface;

class QrCodePlus
{
    protected $qrcode;

    protected $output;

    public function __construct($text = '')
    {
        $this->qrcode = new QrCode($text);
    }

    /**
     * 不直接输出图片，截取输出返回
     * @param PlusInterface $qrcode
     * @return false|string
     */
    public function getOutput(PlusInterface $qrcode)
    {
        ob_start();

        $this->output($qrcode);

        return ob_get_clean();
    }

    /**
     * 设置输出类型，实际
     * Rotoos\Qrcode\Foundation\Plus 中调用
     * @param Closure $closure
     * @return $this
     */
    public function setOutput(Closure $closure)
    {
        $this->output = $closure;

        return $this;
    }

    /**
     * 直接输出二维码
     * @param PlusInterface $qrcode
     * @return void
     */
    public function output(PlusInterface $qrcode)
    {
        $imageString = $this->qrcode->writeString();

        $qrcode->create($imageString)
            ->build()
            ->output($this->output);
    }

    /**
     * 当调用不存在的方法时，去调用
     * \Endroid\QrCode\\Qrcode 的方法
     * @param $method
     * @param $parameters
     * @return $this
     */
    public function __call($method, $parameters)
    {
        $this->qrcode->$method(...$parameters);

        return $this;
    }
}
