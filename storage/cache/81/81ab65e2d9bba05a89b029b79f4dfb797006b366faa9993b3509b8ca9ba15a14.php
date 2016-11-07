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
        <form method=\"post\" id='signup'    name=\"signup\" class=\"col s12\">

            <div class=\"row\">
                <div class=\"input-field col s6\">
                    <input id=\"firstname\" name=\"firstname\" aria-required=\"true\" type=\"text\" placeholder=\"First Name\" required class=\"validate\">
                    <label for=\"firstname\" data-error=\"Champ obligatoir\"></label>
                </div>
                <div class=\"input-field col s6\">
                    <input id=\"name\" name=\"name\" type=\"text\" placeholder=\"Name\" required=\"\" class=\"validate\">
                    <label for=\"name\" data-error=\"Champ obligatoir\"></label>
                </div>


            </div>
            <div class=\"row\">
                <div class=\"input-field col s12\">
                    <input id=\"username\" name=\"username\" type=\"text\" placeholder=\"username\" required class=\"validate\">
                    <label for=\"username\" data-error=\"Champ obligatoir\"></label>
                </div>
            </div>
            <div class=\"row\">
                <div class=\"input-field col s12\">
                    <input id=\"password\" name=\"password\" type=\"password\" placeholder=\"password\" required class=\"validate\">
                    <label for=\"password\" data-error=\"Champ obligatoir\"></label>
                </div>
            </div>
            <div class=\"row\">
                <div class=\"input-field col s12\">
                    <input id=\"passwordValidate\" name=\"passwordValidate\" type=\"password\" placeholder=\"password validate\"  required class=\"validate\">
                    <label for=\"passwordValidate\" data-error=\"Champ obligatoir\"></label>
                </div>
            </div>
            <div class=\"row\">
                <div class=\"input-field col s12\">
                    <input id=\"email\" name=\"email\" type=\"email\" placeholder=\"email@email.com\" required class=\"validate\">
                    <label for=\"email\" data-error=\"Champ obligatoir\"></label>
                </div>
            </div>
            <div class=\"row\">
                <div class=\"input-field col s12\">
                    <input id=\"birthday\" name=\"birthday\" type=\"date\" placeholder=\"MM/DD/YYYY\" required class=\"validate datepicker\">
                    <label for=\"birthday\" data-error=\"Champ obligatoir\"></label>
                </div>
            </div>
            <div class=\"row\">
                <div class=\"input-field col s12\">
                    <input id=\"address\" name=\"address\" type=\"text\" placeholder=\"18 rue fromage\" required class=\"validate\">
                    <label for=\"address\" data-error=\"Champ obligatoir\"></label>
                </div>
            </div>
            <div class=\"row\">
                <div class=\"input-field col s12\">
                    <input id=\"city\" name=\"city\" type=\"text\" placeholder=\"Paris\" required class=\"validate\">
                    <label for=\"city\" data-error=\"Champ obligatoir\"></label>
                </div>
            </div>
            <div class=\"row\">
                <div class=\"input-field col s12\">
                    <input id=\"codepostal\" name=\"codepostal\" type=\"text\" placeholder=\"75000\" required class=\"validate\">
                    <label for=\"codepostal\" data-error=\"Champ obligatoir\"></label>
                </div>
            </div>

            <div class=\"row\">

                    <button class=\"btn waves-effect waves-light\" type=\"submit\" name=\"action\"  value=\"subInscription\">Sign up !
                        <i class=\"material-icons right\">send</i>
                    </button>
            </div>

        </form>

    </div>
<script>
    \$('#signup').validate() ;
</script>




";
        // line 86
        $this->loadTemplate("footer.twig", "signup.twig", 86)->display($context);
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
        return array (  107 => 86,  21 => 2,  19 => 1,);
    }
}
/* {%  include 'header.twig' %}*/
/* */
/* */
/* */
/*     <div class="container">*/
/*         <form method="post" id='signup'    name="signup" class="col s12">*/
/* */
/*             <div class="row">*/
/*                 <div class="input-field col s6">*/
/*                     <input id="firstname" name="firstname" aria-required="true" type="text" placeholder="First Name" required class="validate">*/
/*                     <label for="firstname" data-error="Champ obligatoir"></label>*/
/*                 </div>*/
/*                 <div class="input-field col s6">*/
/*                     <input id="name" name="name" type="text" placeholder="Name" required="" class="validate">*/
/*                     <label for="name" data-error="Champ obligatoir"></label>*/
/*                 </div>*/
/* */
/* */
/*             </div>*/
/*             <div class="row">*/
/*                 <div class="input-field col s12">*/
/*                     <input id="username" name="username" type="text" placeholder="username" required class="validate">*/
/*                     <label for="username" data-error="Champ obligatoir"></label>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="row">*/
/*                 <div class="input-field col s12">*/
/*                     <input id="password" name="password" type="password" placeholder="password" required class="validate">*/
/*                     <label for="password" data-error="Champ obligatoir"></label>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="row">*/
/*                 <div class="input-field col s12">*/
/*                     <input id="passwordValidate" name="passwordValidate" type="password" placeholder="password validate"  required class="validate">*/
/*                     <label for="passwordValidate" data-error="Champ obligatoir"></label>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="row">*/
/*                 <div class="input-field col s12">*/
/*                     <input id="email" name="email" type="email" placeholder="email@email.com" required class="validate">*/
/*                     <label for="email" data-error="Champ obligatoir"></label>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="row">*/
/*                 <div class="input-field col s12">*/
/*                     <input id="birthday" name="birthday" type="date" placeholder="MM/DD/YYYY" required class="validate datepicker">*/
/*                     <label for="birthday" data-error="Champ obligatoir"></label>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="row">*/
/*                 <div class="input-field col s12">*/
/*                     <input id="address" name="address" type="text" placeholder="18 rue fromage" required class="validate">*/
/*                     <label for="address" data-error="Champ obligatoir"></label>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="row">*/
/*                 <div class="input-field col s12">*/
/*                     <input id="city" name="city" type="text" placeholder="Paris" required class="validate">*/
/*                     <label for="city" data-error="Champ obligatoir"></label>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="row">*/
/*                 <div class="input-field col s12">*/
/*                     <input id="codepostal" name="codepostal" type="text" placeholder="75000" required class="validate">*/
/*                     <label for="codepostal" data-error="Champ obligatoir"></label>*/
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
/* <script>*/
/*     $('#signup').validate() ;*/
/* </script>*/
/* */
/* */
/* */
/* */
/* {%  include 'footer.twig' %}*/
