<?php

namespace aptghetto\Controller;

use aptghetto\SimpleTemplateEngine;

class IndexController 
{
  /**
   * @var aptghetto\SimpleTemplateEngine Template engines to render output
   */
  private $template;
  
  /**
   * @param aptghetto\SimpleTemplateEngine
   */
  public function __construct(SimpleTemplateEngine $template)
  {
     $this->template = $template;
  }

  public function homepage() {
  	echo $this->template->render("index.html.php");
  }

  public function greet($name) {
  	echo $this->template->render("hello.html.php", ["name" => $name]);
  }
}
