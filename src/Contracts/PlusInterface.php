<?php

namespace rotoos\colorQrcode\Contracts;

interface PlusInterface
{
    /**
     * 创建一个张图实例
     * @param $imageString
     * @return mixed
     */
    public function create($imageString);

    /**
     * 构建图片
     * @return mixed
     */
    public function build();

    /**
     * 输出图片
     * @param $output
     * @return mixed
     */
    public function output($output);
}
