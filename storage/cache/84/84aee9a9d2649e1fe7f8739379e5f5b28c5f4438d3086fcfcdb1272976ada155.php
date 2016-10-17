<?php

/* hello.twig */
class __TwigTemplate_ed3fe0a045df122c96d2239e302ade08f16cb470fa339d21702bd424de5cae13 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->loadTemplate("header.twig", "hello.twig", 1)->display($context);
        // line 2
        echo "

";
        // line 4
        $this->loadTemplate("footer.twig", "hello.twig", 4)->display($context);
    }

    public function getTemplateName()
    {
        return "hello.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  25 => 4,  21 => 2,  19 => 1,);
    }
}
/* {% include "header.twig" %}*/
/* */
/* */
/* {% include"footer.twig" %}*/
/* */
