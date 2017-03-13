<?php

namespace aptghetto\Controller;

use aptghetto\SimpleTemplateEngine;

class LoginController 
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
  
  public function showLogin() {
  	echo $this->template->render("login.html.php");
  }
}
