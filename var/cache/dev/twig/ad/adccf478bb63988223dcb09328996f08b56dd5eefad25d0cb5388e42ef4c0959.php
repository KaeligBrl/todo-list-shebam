<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* front/account/index.html.twig */
class __TwigTemplate_73d64ab9c19a0283414e52d2137ec79f12b2ab36f238baeaf4fa560dbd6f26cb extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/account/index.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/account/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "front/account/index.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        echo "Mon compte - To Do List Shebam
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 6
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 7
        echo "
\t<div class=\"container\">
\t\t<h1 class=\"text-center color-white-shebam\">Mon Compte</h1><br>
\t\t<div class=\"row text-center color-white-shebam\">

\t\t\t<!-- Colonne de gauche -->
\t\t\t<div class=\"col text-left\">
\t\t\t\t<h3 class=\"text-center\"> Mes coordonnées</h3>
\t\t\t\t<hr>
\t\t\t\t<p>Adresse mail: <span class=\"color-yellow-shebam\">";
        // line 16
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 16, $this->source); })()), "user", [], "any", false, false, false, 16), "email", [], "any", false, false, false, 16), "html", null, true);
        echo "</span></p>
\t\t\t\t<p>Role:      <span class=\"color-yellow-shebam\">";
        // line 17
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 17, $this->source); })()), "user", [], "any", false, false, false, 17), "roles", [], "any", false, false, false, 17));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            // line 18
            echo "\t\t\t\t\t\t\t\t";
            if ((0 === twig_compare($context["role"], "ROLE_USER"))) {
                // line 19
                echo "\t\t\t\t\t\t\t\t\tUtilisateur
\t\t\t\t\t\t\t\t";
            } elseif ((0 === twig_compare(            // line 20
$context["role"], "ROLE_PRO"))) {
                // line 21
                echo "\t\t\t\t\t\t\t\t\tEntreprise
\t\t\t\t\t\t\t\t";
            } elseif ((0 === twig_compare(            // line 22
$context["role"], "ROLE_ADMIN"))) {
                // line 23
                echo "\t\t\t\t\t\t\t\t\tAdministrateur
\t\t\t\t\t\t\t\t";
            }
            // line 25
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo "</span></p>
\t\t\t\t<p>Nombre de tâche attribuée(s): </p>
\t\t\t\t<p>Nouvelle(s) tâche(s): </p>
\t\t\t\t<p>Statut en cours: </p>
\t\t\t\t<p>Tâche(s) terminée(s): </p>
\t\t\t</div>

\t\t\t<!-- Colonne de droite -->
\t\t\t<div class=\"col text-left\">
\t\t\t\t<h3 class=\"text-center\"> Modification des coordonnées</h3>
\t\t\t<hr>
\t\t\t<div class=\"was-validated form-front background-login is-valid\">
\t\t\t\t";
        // line 37
        if ((isset($context["notification"]) || array_key_exists("notification", $context) ? $context["notification"] : (function () { throw new RuntimeError('Variable "notification" does not exist.', 37, $this->source); })())) {
            // line 38
            echo "\t\t\t\t\t<hr>
\t\t\t\t\t\t<div class=\"alert alert-info\">";
            // line 39
            echo twig_escape_filter($this->env, (isset($context["notification"]) || array_key_exists("notification", $context) ? $context["notification"] : (function () { throw new RuntimeError('Variable "notification" does not exist.', 39, $this->source); })()), "html", null, true);
            echo "</div>
\t\t\t\t\t<hr>
\t\t\t\t";
        }
        // line 42
        echo "\t\t\t\t\t";
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 42, $this->source); })()), 'form_start');
        echo "
\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t";
        // line 44
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 44, $this->source); })()), 'widget');
        echo "
\t\t\t\t</div>
\t\t\t\t\t";
        // line 46
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 46, $this->source); })()), 'form_end');
        echo "
\t\t\t</div>
\t\t\t<hr>

\t\t\t<span> Aie c'est quoi déjà? - </span><a href=\"";
        // line 50
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_forgot_password_request");
        echo "\" class=\"text-info\"> Mot de passe oublié</a>
\t\t\t</div>
\t\t</div>
\t</div>

";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "front/account/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  173 => 50,  166 => 46,  161 => 44,  155 => 42,  149 => 39,  146 => 38,  144 => 37,  125 => 25,  121 => 23,  119 => 22,  116 => 21,  114 => 20,  111 => 19,  108 => 18,  104 => 17,  100 => 16,  89 => 7,  79 => 6,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Mon compte - To Do List Shebam
{% endblock %}

{% block content %}

\t<div class=\"container\">
\t\t<h1 class=\"text-center color-white-shebam\">Mon Compte</h1><br>
\t\t<div class=\"row text-center color-white-shebam\">

\t\t\t<!-- Colonne de gauche -->
\t\t\t<div class=\"col text-left\">
\t\t\t\t<h3 class=\"text-center\"> Mes coordonnées</h3>
\t\t\t\t<hr>
\t\t\t\t<p>Adresse mail: <span class=\"color-yellow-shebam\">{{ app.user.email }}</span></p>
\t\t\t\t<p>Role:      <span class=\"color-yellow-shebam\">{% for role in app.user.roles %}
\t\t\t\t\t\t\t\t{% if role == \"ROLE_USER\" %}
\t\t\t\t\t\t\t\t\tUtilisateur
\t\t\t\t\t\t\t\t{% elseif role == \"ROLE_PRO\" %}
\t\t\t\t\t\t\t\t\tEntreprise
\t\t\t\t\t\t\t\t{% elseif role == \"ROLE_ADMIN\" %}
\t\t\t\t\t\t\t\t\tAdministrateur
\t\t\t\t\t\t\t\t{% endif %}
                        {% endfor %}</span></p>
\t\t\t\t<p>Nombre de tâche attribuée(s): </p>
\t\t\t\t<p>Nouvelle(s) tâche(s): </p>
\t\t\t\t<p>Statut en cours: </p>
\t\t\t\t<p>Tâche(s) terminée(s): </p>
\t\t\t</div>

\t\t\t<!-- Colonne de droite -->
\t\t\t<div class=\"col text-left\">
\t\t\t\t<h3 class=\"text-center\"> Modification des coordonnées</h3>
\t\t\t<hr>
\t\t\t<div class=\"was-validated form-front background-login is-valid\">
\t\t\t\t{% if notification %}
\t\t\t\t\t<hr>
\t\t\t\t\t\t<div class=\"alert alert-info\">{{ notification }}</div>
\t\t\t\t\t<hr>
\t\t\t\t{% endif %}
\t\t\t\t\t{{ form_start(form) }}
\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t{{ form_widget(form) }}
\t\t\t\t</div>
\t\t\t\t\t{{ form_end(form) }}
\t\t\t</div>
\t\t\t<hr>

\t\t\t<span> Aie c'est quoi déjà? - </span><a href=\"{{path('app_forgot_password_request')}}\" class=\"text-info\"> Mot de passe oublié</a>
\t\t\t</div>
\t\t</div>
\t</div>

{% endblock %}
", "front/account/index.html.twig", "C:\\laragon\\www\\to-do-list-shebam\\templates\\front\\account\\index.html.twig");
    }
}
