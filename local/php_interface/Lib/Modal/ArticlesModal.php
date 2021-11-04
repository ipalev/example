<?php

namespace Its\Lib\Modal;

use Bitrix\Main\Application;

class ArticlesModal extends BaseModal
{
  /** @var string */
  protected $content;
  
  public function getModalId(): string
  {
    return 'modalArticles';
  }

  public function renderModal(): void
  {
    if ($this->content!=""){
      echo $this->content;
    }
  }
  
  public function setContent($content){
    $this->content = $content;
  }
}
