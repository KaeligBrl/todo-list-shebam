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

/* front/home/index.html.twig */
class __TwigTemplate_c24c41cde905754568d3a22e40961604408dedddaad1c2d9f35debcdd346d3c2 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
            'title' => [$this, 'block_title'],
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/home/index.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/home/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "front/home/index.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 4
        echo "<!doctype html>
<html lang=\"fr\">
<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
    <meta name=\"description\" content=\"Le made in france 100% français\">
    <meta name=\"author\" content=\"Mark Otto, Jacob Thornton, and Bootstrap contributors\">
    <meta name=\"generator\" content=\"Jekyll v4.1.1\">
    <title>";
        // line 12
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    </style>
</head>
<body>
    <header>
\t\t<div class=\"container\">
\t\t    <h1 class=\"mb-4 d-flex justify-content-center color-white-shebam\"> Liste de nos tâches </h1>
\t\t\t<table class=\"table table-striped table-light table-hover\" data-toggle=\"table\" data-pagination=\"true\" data-search=\"true\">
\t\t\t\t  <thead>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th colspan=\"6\" class=\"bg-yellow-shebam color-white-shebam\">PRIORITÉ 1</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>
\t\t\t\t<thead class=\"thead-light\">
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th scope=\"col\">Client</th>
\t\t\t\t\t\t<th scope=\"col\">Sujet</th>
\t\t\t\t\t\t<th scope=\"col\">Personne(s) Désignée(s)</th>
\t\t\t\t\t\t<th scope=\"col\">Statut</th>
\t\t\t\t\t\t<th scope=\"col\">Remarque</th>
\t\t\t\t\t\t<th scope=\"col\">Action</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>
\t\t\t\t\t";
        // line 35
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($context["tache"]);
        foreach ($context['_seq'] as $context["_key"] => $context["tache"]) {
            // line 36
            echo "\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td>";
            // line 37
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tache"], "customer", [], "any", false, false, false, 37), "html", null, true);
            echo "</td> <br>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td>";
            // line 39
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tache"], "subject", [], "any", false, false, false, 39), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t";
            // line 41
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["tache"], "users", [], "any", false, false, false, 41));
            foreach ($context['_seq'] as $context["_key"] => $context["tache"]) {
                // line 42
                echo "\t\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tache"], "firstname", [], "any", false, false, false, 42), "html", null, true);
                echo " <br>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tache'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 44
            echo "\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td>";
            // line 45
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["tache"], "status", [], "any", false, false, false, 45), "name", [], "any", false, false, false, 45), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>";
            // line 46
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tache"], "comment", [], "any", false, false, false, 46), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<a href=\"";
            // line 48
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_list_modify_admin", ["id" => twig_get_attribute($this->env, $this->source, $context["tache"], "id", [], "any", false, false, false, 48)]), "html", null, true);
            echo "\"><i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tache'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 52
        echo "\t\t\t\t  <thead>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th colspan=\"6\" class=\"bg-pink-shebam color-white-shebam\">RENDEZ-VOUS</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>
\t\t\t\t<thead class=\"thead-light\">
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<th scope=\"col\">Entreprise</th>
\t\t\t\t\t\t\t<th scope=\"col\">Sujet</th>
\t\t\t\t\t\t\t<th>Personne(s) Désignée(s)</th>
\t\t\t\t\t\t\t<th scope=\"col\">Statut</th>
\t\t\t\t\t\t\t<th scope=\"col\">Date et heure</th>
\t\t\t\t\t\t\t<th scope=\"col\">Action</th>
\t\t\t\t\t\t</tr>
\t\t\t\t\t";
        // line 66
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($context["rendezvous"]);
        foreach ($context['_seq'] as $context["_key"] => $context["rendezvous"]) {
            // line 67
            echo "\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td>";
            // line 68
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "name", [], "any", false, false, false, 68), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>";
            // line 69
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "sujet", [], "any", false, false, false, 69), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t";
            // line 71
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["rendezvous"], "utilisateur", [], "any", false, false, false, 71));
            foreach ($context['_seq'] as $context["_key"] => $context["rendezvous"]) {
                // line 72
                echo "\t\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "firstname", [], "any", false, false, false, 72), "html", null, true);
                echo " <br>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rendezvous'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 74
            echo "\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td>";
            // line 75
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "statut", [], "any", false, false, false, 75), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>";
            // line 76
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "heuredurendezvous", [], "any", false, false, false, 76), "j F Y"), "html", null, true);
            echo " à ";
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "heuredurendezvous", [], "any", false, false, false, 76), "H:i"), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<a href=\"";
            // line 78
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_appointment_modify_admin", ["id" => twig_get_attribute($this->env, $this->source, $context["rendezvous"], "id", [], "any", false, false, false, 78)]), "html", null, true);
            echo "\"><i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rendezvous'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 82
        echo "\t\t\t\t</thead>
\t\t\t\t<thead>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th colspan=\"6\" class=\"bg-green-light-shebam color-white-shebam\">DEVIS</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>
\t\t\t\t<thead class=\"thead-light\">
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th scope=\"col\">Client</th>
\t\t\t\t\t\t<th scope=\"col\">Sujet</th>
\t\t\t\t\t\t<th>Personne(s) Désignée(s)</th>
\t\t\t\t\t\t<th scope=\"col\">Statut</th>
\t\t\t\t\t\t<th scope=\"col\">Remarque</th>
\t\t\t\t\t\t<th scope=\"col\">Action</th>
\t\t\t\t\t</tr>
\t\t\t\t\t";
        // line 97
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($context["quote"]);
        foreach ($context['_seq'] as $context["_key"] => $context["quote"]) {
            // line 98
            echo "\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td>";
            // line 99
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "enterprise", [], "any", false, false, false, 99), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>";
            // line 100
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "subject", [], "any", false, false, false, 100), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t";
            // line 102
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["quote"], "person", [], "any", false, false, false, 102));
            foreach ($context['_seq'] as $context["_key"] => $context["quote"]) {
                // line 103
                echo "\t\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "firstname", [], "any", false, false, false, 103), "html", null, true);
                echo " <br>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['quote'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 105
            echo "\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td>";
            // line 106
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "status", [], "any", false, false, false, 106), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>";
            // line 107
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "comment", [], "any", false, false, false, 107), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<a href=\"";
            // line 109
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_quote_modify_admin", ["id" => twig_get_attribute($this->env, $this->source, $context["quote"], "id", [], "any", false, false, false, 109)]), "html", null, true);
            echo "\"><i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['quote'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 113
        echo "\t\t\t\t</thead>

\t\t</div>
    </header>
</body>
</html>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 12
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        echo "To dos list";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "front/home/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  310 => 12,  294 => 113,  284 => 109,  279 => 107,  275 => 106,  272 => 105,  263 => 103,  259 => 102,  254 => 100,  250 => 99,  247 => 98,  243 => 97,  226 => 82,  216 => 78,  209 => 76,  205 => 75,  202 => 74,  193 => 72,  189 => 71,  184 => 69,  180 => 68,  177 => 67,  173 => 66,  157 => 52,  147 => 48,  142 => 46,  138 => 45,  135 => 44,  126 => 42,  122 => 41,  117 => 39,  112 => 37,  109 => 36,  105 => 35,  79 => 12,  69 => 4,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block content %}
<!doctype html>
<html lang=\"fr\">
<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
    <meta name=\"description\" content=\"Le made in france 100% français\">
    <meta name=\"author\" content=\"Mark Otto, Jacob Thornton, and Bootstrap contributors\">
    <meta name=\"generator\" content=\"Jekyll v4.1.1\">
    <title>{%  block title %}To dos list{% endblock %}</title>
    </style>
</head>
<body>
    <header>
\t\t<div class=\"container\">
\t\t    <h1 class=\"mb-4 d-flex justify-content-center color-white-shebam\"> Liste de nos tâches </h1>
\t\t\t<table class=\"table table-striped table-light table-hover\" data-toggle=\"table\" data-pagination=\"true\" data-search=\"true\">
\t\t\t\t  <thead>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th colspan=\"6\" class=\"bg-yellow-shebam color-white-shebam\">PRIORITÉ 1</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>
\t\t\t\t<thead class=\"thead-light\">
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th scope=\"col\">Client</th>
\t\t\t\t\t\t<th scope=\"col\">Sujet</th>
\t\t\t\t\t\t<th scope=\"col\">Personne(s) Désignée(s)</th>
\t\t\t\t\t\t<th scope=\"col\">Statut</th>
\t\t\t\t\t\t<th scope=\"col\">Remarque</th>
\t\t\t\t\t\t<th scope=\"col\">Action</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>
\t\t\t\t\t{% for tache in tache %}
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td>{{tache.customer}}</td> <br>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td>{{tache.subject}}</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t{% for tache in tache.users %}
\t\t\t\t\t\t\t\t{{ tache.firstname }} <br>
\t\t\t\t\t\t\t{% endfor %}
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td>{{tache.status.name}}</td>
\t\t\t\t\t\t\t<td>{{tache.comment}}</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<a href=\"{{ path('task_list_modify_admin', {\"id\": tache.id}) }}\"><i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t{% endfor %}
\t\t\t\t  <thead>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th colspan=\"6\" class=\"bg-pink-shebam color-white-shebam\">RENDEZ-VOUS</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>
\t\t\t\t<thead class=\"thead-light\">
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<th scope=\"col\">Entreprise</th>
\t\t\t\t\t\t\t<th scope=\"col\">Sujet</th>
\t\t\t\t\t\t\t<th>Personne(s) Désignée(s)</th>
\t\t\t\t\t\t\t<th scope=\"col\">Statut</th>
\t\t\t\t\t\t\t<th scope=\"col\">Date et heure</th>
\t\t\t\t\t\t\t<th scope=\"col\">Action</th>
\t\t\t\t\t\t</tr>
\t\t\t\t\t{% for rendezvous in rendezvous %}
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td>{{rendezvous.name}}</td>
\t\t\t\t\t\t\t<td>{{rendezvous.sujet}}</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t{% for rendezvous in rendezvous.utilisateur %}
\t\t\t\t\t\t\t\t{{ rendezvous.firstname }} <br>
\t\t\t\t\t\t\t{% endfor %}
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td>{{rendezvous.statut}}</td>
\t\t\t\t\t\t\t<td>{{ rendezvous.heuredurendezvous|date('j F Y')  }} à {{rendezvous.heuredurendezvous|date('H:i')}}</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<a href=\"{{ path('task_appointment_modify_admin', {\"id\": rendezvous.id}) }}\"><i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t{% endfor %}
\t\t\t\t</thead>
\t\t\t\t<thead>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th colspan=\"6\" class=\"bg-green-light-shebam color-white-shebam\">DEVIS</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>
\t\t\t\t<thead class=\"thead-light\">
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th scope=\"col\">Client</th>
\t\t\t\t\t\t<th scope=\"col\">Sujet</th>
\t\t\t\t\t\t<th>Personne(s) Désignée(s)</th>
\t\t\t\t\t\t<th scope=\"col\">Statut</th>
\t\t\t\t\t\t<th scope=\"col\">Remarque</th>
\t\t\t\t\t\t<th scope=\"col\">Action</th>
\t\t\t\t\t</tr>
\t\t\t\t\t{% for quote in quote %}
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td>{{ quote.enterprise }}</td>
\t\t\t\t\t\t\t<td>{{ quote.subject }}</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t{% for quote in quote.person %}
\t\t\t\t\t\t\t\t{{ quote.firstname }} <br>
\t\t\t\t\t\t\t{% endfor %}
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td>{{ quote.status }}</td>
\t\t\t\t\t\t\t<td>{{ quote.comment }}</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<a href=\"{{ path('task_quote_modify_admin', {\"id\": quote.id}) }}\"><i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t{% endfor %}
\t\t\t\t</thead>

\t\t</div>
    </header>
</body>
</html>
{%  endblock %}", "front/home/index.html.twig", "C:\\laragon\\www\\to-do-list-shebam\\templates\\front\\home\\index.html.twig");
    }
}
