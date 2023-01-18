# ColorQrcode

#### 介绍
彩色二维码

#### 软件架构
软件架构说明


#### 安装教程

composer require rotoos/color-qrcode

#### 使用说明
(```)
<?php

require 'vendor/autoload.php';

use Rotoos\Qrcode\Factory;
use Rotoos\Qrcode\QrCodePlus;

/****************************************
 * 通过工厂方法，获取到你想创建二维码的样式
 * 现在仅有：color, image
 ****************************************/
$color = Factory::color(['#087', '#431', '#a2d', '#a2d',]);
// $image = Factory::image(imagecreatefrompng('Rotoos.png'));


/****************************************
 * 实例化对象，并在 output 方法传入
 * $color 或者 $image
 ****************************************/
(new QrCodePlus)
    ->setText('DavidNineRoc')
    ->setMargin(50)
    ->setOutput(function($handle){
        header('Content-Type: image/jpeg');
        imagejpeg($handle);
    })
    ->output($color);
(```)
#### 其他
MultipleColor Factory::color($hexColor = [], $alpha = 1)
创建一个颜色实例
参数一为十六进制颜色数组，颜色数量可为四，六，九
参数二为透明度
ImageStyle Factory::($sourceImage = '', $alpha = 1)
创建一个图片实例
参数一为图片源，可为图片字符串和资源句柄
参数二为透明度
QrCodePlus QrcodePlus::setText($text)
设置二维码的文字
setMargin(), setSize()方法都是基于基类QrCode
更多方法：https://github.com/endroid/qr-code
Qrcodeplus QrcodePlus::setOutput(Closure $closure)
设置响应头输出，默认输出image/png
可自行在中运行输出
闭包只有一个参数那就是图片句柄，用于输出
void QrcodePlus::output(PlusInterface $qrcode)
输出彩色二维码
参数必须为 PlusInterface 实例
也就是通过Factory::color()或者Factory::image()返回的实例
string QrcodePlus::getOutput(PlusInterface $qrcode)
获取彩色二维码的输出，不直接显示