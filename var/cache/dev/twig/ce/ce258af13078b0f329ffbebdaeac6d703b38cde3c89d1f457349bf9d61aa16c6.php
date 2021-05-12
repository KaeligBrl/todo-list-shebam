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
\t\t\t\t<div class=\"container\">
\t\t\t<div class=\"d-flex flex-row-reverse\">
\t\t\t\t<a href=\"";
        // line 19
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_quote_add_admin");
        echo "\" type=\"button\" class=\"btn btn-outline-light mb-3\"><i class=\"fas fa-cart-plus\"></i></a>
\t\t\t\t|\t
\t\t\t\t<a href=\"";
        // line 21
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_appointment_add_admin");
        echo "\" type=\"button\" class=\"btn btn-outline-light mb-3\"><i class=\"fas fa-calendar-plus\"></i></a>
\t\t\t\t|
\t\t\t\t<a href=\"";
        // line 23
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_list_add_admin");
        echo "\" type=\"button\" class=\"btn btn-outline-light mb-3\">
\t\t\t\t\t<i class=\"fas fa-plus-circle\"></i>
\t\t\t\t</a>
\t\t\t</div>
\t\t\t<div class=\"mb-2\"></div>
\t\t\t<div class=\"text-center bg-yellow-shebam color-white-shebam p-3\">Priorité 1</div>
\t\t\t<table class=\"table table-striped table-light\" data-toggle=\"table\">
\t\t\t\t<thead class=\"bg-yellow-dark color-white-shebam\">
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th scope=\"col\">Client</th>
\t\t\t\t\t\t<th scope=\"col\">Sujet</th>
\t\t\t\t\t\t<th scope=\"col\">Personne(s) Désignée(s)</th>
\t\t\t\t\t\t<th scope=\"col\">Statut</th>
\t\t\t\t\t\t<th scope=\"col\">Remarque</th>
\t\t\t\t\t\t<th scope=\"col\">Action</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>
\t\t\t\t<tbody>
\t\t\t\t\t\t";
        // line 41
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($context["tache"]);
        foreach ($context['_seq'] as $context["_key"] => $context["tache"]) {
            // line 42
            echo "\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
            // line 43
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tache"], "customer", [], "any", false, false, false, 43), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 44
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tache"], "subject", [], "any", false, false, false, 44), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 45
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["tache"], "users", [], "any", false, false, false, 45));
            foreach ($context['_seq'] as $context["_key"] => $context["tache"]) {
                // line 46
                echo "\t\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tache"], "firstname", [], "any", false, false, false, 46), "html", null, true);
                echo " <br>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tache'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 48
            echo "\t\t\t\t\t\t</td>
\t\t\t\t\t\t<td>";
            // line 49
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["tache"], "status", [], "any", false, false, false, 49), "name", [], "any", false, false, false, 49), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 50
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tache"], "comment", [], "any", false, false, false, 50), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t<a href=\"";
            // line 52
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_list_modify_admin", ["id" => twig_get_attribute($this->env, $this->source, $context["tache"], "id", [], "any", false, false, false, 52)]), "html", null, true);
            echo "\"><i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t\t\t|
\t\t\t\t\t\t\t<a href=\"";
            // line 54
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_list_detete_admin", ["id" => twig_get_attribute($this->env, $this->source, $context["tache"], "id", [], "any", false, false, false, 54)]), "html", null, true);
            echo "\" onclick=\"return confirm('Attention vous vous apprettez à supprimer une tâche')\"><i class=\"fas fa-trash\"></i></a>\t\t\t\t\t\t\t
\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tache'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 58
        echo "\t\t\t\t</tbody>
\t\t\t</table>

\t\t\t<div class=\"mb-5\"></div>

\t\t\t<div class=\"text-center bg-pink-shebam color-white-shebam p-3\">Rendez-vous</div>
\t\t\t<table class=\"table table-striped table-light\" data-toggle=\"table\">
\t\t\t\t<thead class=\"bg-yellow-dark color-white-shebam\">
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th scope=\"col\">Entreprise</th>
\t\t\t\t\t\t<th scope=\"col\">Sujet</th>
\t\t\t\t\t\t<th>Personne(s) Désignée(s)</th>
\t\t\t\t\t\t<th scope=\"col\">Statut</th>
\t\t\t\t\t\t<th scope=\"col\">Date et heure</th>
\t\t\t\t\t\t<th scope=\"col\">Action</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>
\t\t\t\t<tbody>
\t\t\t\t\t";
        // line 76
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($context["rendezvous"]);
        foreach ($context['_seq'] as $context["_key"] => $context["rendezvous"]) {
            // line 77
            echo "\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td>";
            // line 78
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "name", [], "any", false, false, false, 78), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>";
            // line 79
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "sujet", [], "any", false, false, false, 79), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t";
            // line 81
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["rendezvous"], "utilisateur", [], "any", false, false, false, 81));
            foreach ($context['_seq'] as $context["_key"] => $context["rendezvous"]) {
                // line 82
                echo "\t\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "firstname", [], "any", false, false, false, 82), "html", null, true);
                echo " <br>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rendezvous'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 84
            echo "\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td>";
            // line 85
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "statut", [], "any", false, false, false, 85), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>";
            // line 86
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "heuredurendezvous", [], "any", false, false, false, 86), "j F Y"), "html", null, true);
            echo " à ";
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "heuredurendezvous", [], "any", false, false, false, 86), "H:i"), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<a href=\"";
            // line 88
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_appointment_modify_admin", ["id" => twig_get_attribute($this->env, $this->source, $context["rendezvous"], "id", [], "any", false, false, false, 88)]), "html", null, true);
            echo "\"><i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t\t\t|
\t\t\t\t\t\t\t\t<a href=\"";
            // line 90
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_appointment_detete_admin", ["id" => twig_get_attribute($this->env, $this->source, $context["rendezvous"], "id", [], "any", false, false, false, 90)]), "html", null, true);
            echo "\" onclick=\"return confirm('Attention vous vous apprettez à supprimer un rendez-vous')\"><i class=\"fas fa-trash\"></i></a>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rendezvous'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 94
        echo "\t\t\t\t</tbody>
\t\t\t</table>

\t\t\t<div class=\"mb-5\"></div>

\t\t\t<div class=\"text-center bg-blue-light-shebam color-white-shebam p-3\">Devis</div>
\t\t\t<table class=\"table table-striped table-light\" data-toggle=\"table\">
\t\t\t\t<thead class=\"bg-yellow-dark color-white-shebam\">
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th scope=\"col\">Client</th>
\t\t\t\t\t\t<th scope=\"col\">Sujet</th>
\t\t\t\t\t\t<th>Personne(s) Désignée(s)</th>
\t\t\t\t\t\t<th scope=\"col\">Statut</th>
\t\t\t\t\t\t<th scope=\"col\">Remarque</th>
\t\t\t\t\t\t<th scope=\"col\">Action</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>
\t\t\t\t<tbody>
\t\t\t\t\t";
        // line 112
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($context["quote"]);
        foreach ($context['_seq'] as $context["_key"] => $context["quote"]) {
            // line 113
            echo "\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td>";
            // line 114
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "enterprise", [], "any", false, false, false, 114), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>";
            // line 115
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "subject", [], "any", false, false, false, 115), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t";
            // line 117
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["quote"], "person", [], "any", false, false, false, 117));
            foreach ($context['_seq'] as $context["_key"] => $context["quote"]) {
                // line 118
                echo "\t\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "firstname", [], "any", false, false, false, 118), "html", null, true);
                echo " <br>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['quote'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 120
            echo "\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td>";
            // line 121
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "status", [], "any", false, false, false, 121), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>";
            // line 122
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "comment", [], "any", false, false, false, 122), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<a href=\"";
            // line 124
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_quote_modify_admin", ["id" => twig_get_attribute($this->env, $this->source, $context["quote"], "id", [], "any", false, false, false, 124)]), "html", null, true);
            echo "\"><i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t\t\t|
\t\t\t\t\t\t\t\t<a href=\"";
            // line 126
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_quote_detete_admin", ["id" => twig_get_attribute($this->env, $this->source, $context["quote"], "id", [], "any", false, false, false, 126)]), "html", null, true);
            echo "\" onclick=\"return confirm('Attention vous vous apprettez à supprimer un devis')\"><i class=\"fas fa-trash\"></i></a>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['quote'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 130
        echo "\t\t\t\t</tbody>
\t\t\t</table>

\t\t\t<div class=\"mb-5\"></div>

\t\t\t<div class=\"text-center bg-blue-light-shebam color-white-shebam p-3\">Priorité 2</div>
\t\t\t<table class=\"table table-striped table-light\" data-toggle=\"table\">
\t\t\t\t<thead class=\"bg-yellow-dark color-white-shebam\">
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th scope=\"col\">Client</th>
\t\t\t\t\t\t<th scope=\"col\">Sujet</th>
\t\t\t\t\t\t<th scope=\"col\">Personne(s) Désignée(s)</th>
\t\t\t\t\t\t<th scope=\"col\">Statut</th>
\t\t\t\t\t\t<th scope=\"col\">Remarque</th>
\t\t\t\t\t\t<th scope=\"col\">Action</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>
\t\t\t\t<tbody>
\t\t\t\t\t ";
        // line 148
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($context["task2"]);
        foreach ($context['_seq'] as $context["_key"] => $context["task2"]) {
            // line 149
            echo "\t\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
            // line 150
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task2"], "customer", [], "any", false, false, false, 150), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 151
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task2"], "subject", [], "any", false, false, false, 151), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 152
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["task2"], "users", [], "any", false, false, false, 152));
            foreach ($context['_seq'] as $context["_key"] => $context["task2"]) {
                // line 153
                echo "\t\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task2"], "firstname", [], "any", false, false, false, 153), "html", null, true);
                echo " <br>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['task2'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 155
            echo "\t\t\t\t\t\t</td>
\t\t\t\t\t\t<td>";
            // line 156
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["task2"], "status", [], "any", false, false, false, 156), "name", [], "any", false, false, false, 156), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 157
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task2"], "comment", [], "any", false, false, false, 157), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t";
            // line 159
            echo "<i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t\t\t|
\t\t\t\t\t\t\t\t";
            // line 161
            echo "<i class=\"fas fa-trash\"></i></a>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['task2'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 165
        echo "\t\t\t\t</tbody>
\t\t\t</table>
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
        return array (  418 => 12,  402 => 165,  393 => 161,  389 => 159,  384 => 157,  380 => 156,  377 => 155,  368 => 153,  364 => 152,  360 => 151,  356 => 150,  353 => 149,  349 => 148,  329 => 130,  319 => 126,  314 => 124,  309 => 122,  305 => 121,  302 => 120,  293 => 118,  289 => 117,  284 => 115,  280 => 114,  277 => 113,  273 => 112,  253 => 94,  243 => 90,  238 => 88,  231 => 86,  227 => 85,  224 => 84,  215 => 82,  211 => 81,  206 => 79,  202 => 78,  199 => 77,  195 => 76,  175 => 58,  165 => 54,  160 => 52,  155 => 50,  151 => 49,  148 => 48,  139 => 46,  135 => 45,  131 => 44,  127 => 43,  124 => 42,  120 => 41,  99 => 23,  94 => 21,  89 => 19,  79 => 12,  69 => 4,  59 => 3,  36 => 1,);
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
\t\t\t\t<div class=\"container\">
\t\t\t<div class=\"d-flex flex-row-reverse\">
\t\t\t\t<a href=\"{{ path('task_quote_add_admin') }}\" type=\"button\" class=\"btn btn-outline-light mb-3\"><i class=\"fas fa-cart-plus\"></i></a>
\t\t\t\t|\t
\t\t\t\t<a href=\"{{ path('task_appointment_add_admin') }}\" type=\"button\" class=\"btn btn-outline-light mb-3\"><i class=\"fas fa-calendar-plus\"></i></a>
\t\t\t\t|
\t\t\t\t<a href=\"{{ path('task_list_add_admin') }}\" type=\"button\" class=\"btn btn-outline-light mb-3\">
\t\t\t\t\t<i class=\"fas fa-plus-circle\"></i>
\t\t\t\t</a>
\t\t\t</div>
\t\t\t<div class=\"mb-2\"></div>
\t\t\t<div class=\"text-center bg-yellow-shebam color-white-shebam p-3\">Priorité 1</div>
\t\t\t<table class=\"table table-striped table-light\" data-toggle=\"table\">
\t\t\t\t<thead class=\"bg-yellow-dark color-white-shebam\">
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th scope=\"col\">Client</th>
\t\t\t\t\t\t<th scope=\"col\">Sujet</th>
\t\t\t\t\t\t<th scope=\"col\">Personne(s) Désignée(s)</th>
\t\t\t\t\t\t<th scope=\"col\">Statut</th>
\t\t\t\t\t\t<th scope=\"col\">Remarque</th>
\t\t\t\t\t\t<th scope=\"col\">Action</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>
\t\t\t\t<tbody>
\t\t\t\t\t\t{% for tache in tache %}
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>{{tache.customer}}</td>
\t\t\t\t\t\t<td>{{tache.subject}}</td>
\t\t\t\t\t\t<td>{% for tache in tache.users %}
\t\t\t\t\t\t\t\t{{ tache.firstname }} <br>
\t\t\t\t\t\t\t{% endfor %}
\t\t\t\t\t\t</td>
\t\t\t\t\t\t<td>{{tache.status.name}}</td>
\t\t\t\t\t\t<td>{{tache.comment}}</td>
\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t<a href=\"{{ path('task_list_modify_admin', {\"id\": tache.id}) }}\"><i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t\t\t|
\t\t\t\t\t\t\t<a href=\"{{ path('task_list_detete_admin', {\"id\": tache.id}) }}\" onclick=\"return confirm('Attention vous vous apprettez à supprimer une tâche')\"><i class=\"fas fa-trash\"></i></a>\t\t\t\t\t\t\t
\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t\t\t{% endfor %}
\t\t\t\t</tbody>
\t\t\t</table>

\t\t\t<div class=\"mb-5\"></div>

\t\t\t<div class=\"text-center bg-pink-shebam color-white-shebam p-3\">Rendez-vous</div>
\t\t\t<table class=\"table table-striped table-light\" data-toggle=\"table\">
\t\t\t\t<thead class=\"bg-yellow-dark color-white-shebam\">
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th scope=\"col\">Entreprise</th>
\t\t\t\t\t\t<th scope=\"col\">Sujet</th>
\t\t\t\t\t\t<th>Personne(s) Désignée(s)</th>
\t\t\t\t\t\t<th scope=\"col\">Statut</th>
\t\t\t\t\t\t<th scope=\"col\">Date et heure</th>
\t\t\t\t\t\t<th scope=\"col\">Action</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>
\t\t\t\t<tbody>
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
\t\t\t\t\t\t\t\t|
\t\t\t\t\t\t\t\t<a href=\"{{ path('task_appointment_detete_admin', {\"id\": rendezvous.id}) }}\" onclick=\"return confirm('Attention vous vous apprettez à supprimer un rendez-vous')\"><i class=\"fas fa-trash\"></i></a>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t{% endfor %}
\t\t\t\t</tbody>
\t\t\t</table>

\t\t\t<div class=\"mb-5\"></div>

\t\t\t<div class=\"text-center bg-blue-light-shebam color-white-shebam p-3\">Devis</div>
\t\t\t<table class=\"table table-striped table-light\" data-toggle=\"table\">
\t\t\t\t<thead class=\"bg-yellow-dark color-white-shebam\">
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th scope=\"col\">Client</th>
\t\t\t\t\t\t<th scope=\"col\">Sujet</th>
\t\t\t\t\t\t<th>Personne(s) Désignée(s)</th>
\t\t\t\t\t\t<th scope=\"col\">Statut</th>
\t\t\t\t\t\t<th scope=\"col\">Remarque</th>
\t\t\t\t\t\t<th scope=\"col\">Action</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>
\t\t\t\t<tbody>
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
\t\t\t\t\t\t\t\t|
\t\t\t\t\t\t\t\t<a href=\"{{ path('task_quote_detete_admin', {\"id\": quote.id}) }}\" onclick=\"return confirm('Attention vous vous apprettez à supprimer un devis')\"><i class=\"fas fa-trash\"></i></a>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t{% endfor %}
\t\t\t\t</tbody>
\t\t\t</table>

\t\t\t<div class=\"mb-5\"></div>

\t\t\t<div class=\"text-center bg-blue-light-shebam color-white-shebam p-3\">Priorité 2</div>
\t\t\t<table class=\"table table-striped table-light\" data-toggle=\"table\">
\t\t\t\t<thead class=\"bg-yellow-dark color-white-shebam\">
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th scope=\"col\">Client</th>
\t\t\t\t\t\t<th scope=\"col\">Sujet</th>
\t\t\t\t\t\t<th scope=\"col\">Personne(s) Désignée(s)</th>
\t\t\t\t\t\t<th scope=\"col\">Statut</th>
\t\t\t\t\t\t<th scope=\"col\">Remarque</th>
\t\t\t\t\t\t<th scope=\"col\">Action</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>
\t\t\t\t<tbody>
\t\t\t\t\t {% for task2 in task2 %}
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>{{task2.customer}}</td>
\t\t\t\t\t\t<td>{{task2.subject}}</td>
\t\t\t\t\t\t<td>{% for task2 in task2.users %}
\t\t\t\t\t\t\t\t{{ task2.firstname }} <br>
\t\t\t\t\t\t\t{% endfor %}
\t\t\t\t\t\t</td>
\t\t\t\t\t\t<td>{{task2.status.name}}</td>
\t\t\t\t\t\t<td>{{task2.comment}}</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t{# <a href=\"{{ path('task_quote_modify_admin', {\"id\": quote.id}) }}\">#}<i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t\t\t|
\t\t\t\t\t\t\t\t{#<a href=\"{{ path('task_quote_detete_admin', {\"id\": quote.id}) }}\" onclick=\"return confirm('Attention vous vous apprettez à supprimer un devis')\">#}<i class=\"fas fa-trash\"></i></a>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t{% endfor %}
\t\t\t\t</tbody>
\t\t\t</table>
\t\t</div>
    </header>
</body>
</html>
{%  endblock %}", "front/home/index.html.twig", "C:\\laragon\\www\\to-do-list-shebam\\templates\\front\\home\\index.html.twig");
    }
}
