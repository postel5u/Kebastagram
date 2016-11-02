<?php

/* signup.twig */
class __TwigTemplate_fd4f6757fd548ac52859874afa931b6f16c99748b38e9751554323ce7c83b498 extends Twig_Template
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
        $this->loadTemplate("header.twig", "signup.twig", 1)->display($context);
        // line 2
        echo "


    <div class=\"container\">
        <form method=\"post\" name=\"signup\" class=\"col s12\">

            <div class=\"row\">
                <div class=\"input-field col s6\">
                    <input name=\"firstname\" type=\"text\" placeholder=\"First Name\">
                </div>
                <div class=\"input-field col s6\">
                    <input name=\"name\" type=\"text\" placeholder=\"Name\">
                </div>


            </div>
            <div class=\"row\">
                <div class=\"input-field col s12\">
                    <input name=\"username\" type=\"text\" placeholder=\"username\">
                </div>
            </div>
            <div class=\"row\">
                <div class=\"input-field col s12\">
                    <input name=\"password\" type=\"password\" placeholder=\"password\">
                </div>
            </div>
            <div class=\"row\">
                <div class=\"input-field col s12\">
                    <input name=\"email\" type=\"email\" placeholder=\"email@email.com\">
                </div>
            </div>
            <div class=\"row\">
                <div class=\"input-field col s12\">
                    <input name=\"birthday\" type=\"date\" placeholder=\"MM/DD/YYYY\">
                </div>
            </div>
            <div class=\"row\">
                <div class=\"input-field col s12\">
                    <input name=\"address\" type=\"text\" placeholder=\"18 rue fromage\">
                </div>
            </div>
            <div class=\"row\">
                <div class=\"input-field col s12\">
                    <input name=\"city\" type=\"text\" placeholder=\"Paris\">
                </div>
            </div>
            <div class=\"row\">
                <div class=\"input-field col s12\">
                    <input name=\"codepostal\" type=\"text\" placeholder=\"75000\">
                </div>
            </div>

            <div class=\"row\">

                    <button class=\"btn waves-effect waves-light\" type=\"submit\" name=\"action\"  value=\"subInscription\">Sign up !
                        <i class=\"material-icons right\">send</i>
                    </button>
            </div>

        </form>

    </div>




";
        // line 68
        $this->loadTemplate("footer.twig", "signup.twig", 68)->display($context);
    }

    public function getTemplateName()
    {
        return "signup.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 68,  21 => 2,  19 => 1,);
    }
}
/* {%  include 'header.twig' %}*/
/* */
/* */
/* */
/*     <div class="container">*/
/*         <form method="post" name="signup" class="col s12">*/
/* */
/*             <div class="row">*/
/*                 <div class="input-field col s6">*/
/*                     <input name="firstname" type="text" placeholder="First Name">*/
/*                 </div>*/
/*                 <div class="input-field col s6">*/
/*                     <input name="name" type="text" placeholder="Name">*/
/*                 </div>*/
/* */
/* */
/*             </div>*/
/*             <div class="row">*/
/*                 <div class="input-field col s12">*/
/*                     <input name="username" type="text" placeholder="username">*/
/*                 </div>*/
/*             </div>*/
/*             <div class="row">*/
/*                 <div class="input-field col s12">*/
/*                     <input name="password" type="password" placeholder="password">*/
/*                 </div>*/
/*             </div>*/
/*             <div class="row">*/
/*                 <div class="input-field col s12">*/
/*                     <input name="email" type="email" placeholder="email@email.com">*/
/*                 </div>*/
/*             </div>*/
/*             <div class="row">*/
/*                 <div class="input-field col s12">*/
/*                     <input name="birthday" type="date" placeholder="MM/DD/YYYY">*/
/*                 </div>*/
/*             </div>*/
/*             <div class="row">*/
/*                 <div class="input-field col s12">*/
/*                     <input name="address" type="text" placeholder="18 rue fromage">*/
/*                 </div>*/
/*             </div>*/
/*             <div class="row">*/
/*                 <div class="input-field col s12">*/
/*                     <input name="city" type="text" placeholder="Paris">*/
/*                 </div>*/
/*             </div>*/
/*             <div class="row">*/
/*                 <div class="input-field col s12">*/
/*                     <input name="codepostal" type="text" placeholder="75000">*/
/*                 </div>*/
/*             </div>*/
/* */
/*             <div class="row">*/
/* */
/*                     <button class="btn waves-effect waves-light" type="submit" name="action"  value="subInscription">Sign up !*/
/*                         <i class="material-icons right">send</i>*/
/*                     </button>*/
/*             </div>*/
/* */
/*         </form>*/
/* */
/*     </div>*/
/* */
/* */
/* */
/* */
/* {%  include 'footer.twig' %}*/
