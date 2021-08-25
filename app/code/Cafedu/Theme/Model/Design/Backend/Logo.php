<?php
namespace Cafedu\Theme\Model\Design\Backend;

class Logo extends \Magento\Theme\Model\Design\Backend\Logo
{
  public function getAllowedExtensions()
  {
    return ['jpg', 'jpeg', 'gif', 'png', 'svg'];
  }
}
