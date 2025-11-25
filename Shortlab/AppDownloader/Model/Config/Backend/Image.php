<?php
declare(strict_types=1);
namespace Shortlab\AppDownloader\Model\Config\Backend;

use Magento\Config\Model\Config\Backend\File;

class Image extends File
{
    /**
     * @return string[]
     */
    public function getAllowedExtensions()
    {
        return ['jpg', 'jpeg', 'gif', 'png', 'svg'];
    }
}