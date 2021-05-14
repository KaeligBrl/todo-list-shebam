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
class __TwigTemplate_e1b7d06e00780ce19d633ea2ed01c39b58beb0cd10953a74bd7417d2d3b62951 extends Template
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
\t\t\t<div class=\"mb-2\"></div>
\t\t\t<h1 class=\"text-center color-white-shebam mb-3\">Liste des tâches - Shebam</h1>
\t\t\t<hr class=\"text-center mb-5 mt-5\">
\t\t\t<div class=\"text-center bg-yellow-shebam color-white-shebam p-3 font-weight-bold\">Priorité 1</div>
\t\t\t<table class=\"table table-striped table-light mb-5\" data-toggle=\"table\">
\t\t\t\t<thead class=\"bg-yellow-dark color-white-shebam font-weight-bold\">
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
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($context["task"]);
        foreach ($context['_seq'] as $context["_key"] => $context["task"]) {
            // line 35
            echo "\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
            // line 36
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task"], "customer", [], "any", false, false, false, 36), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 37
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task"], "subject", [], "any", false, false, false, 37), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 38
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["task"], "users", [], "any", false, false, false, 38));
            foreach ($context['_seq'] as $context["_key"] => $context["task"]) {
                // line 39
                echo "\t\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task"], "firstname", [], "any", false, false, false, 39), "html", null, true);
                echo " <br>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['task'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 41
            echo "\t\t\t\t\t\t</td>
\t\t\t\t\t\t<td>";
            // line 42
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["task"], "status", [], "any", false, false, false, 42), "name", [], "any", false, false, false, 42), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 43
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task"], "comment", [], "any", false, false, false, 43), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t<a href=\"";
            // line 45
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_list_modify_admin", ["id" => twig_get_attribute($this->env, $this->source, $context["task"], "id", [], "any", false, false, false, 45)]), "html", null, true);
            echo "\"><i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['task'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 49
        echo "\t\t\t\t</tbody>
\t\t\t</table>

\t\t\t<div class=\"mb-5\"></div>

\t\t\t<div class=\"text-center bg-pink-shebam color-white-shebam p-3 font-weight-bold\">Rendez-vous</div>
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
        // line 67
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($context["rendezvous"]);
        foreach ($context['_seq'] as $context["_key"] => $context["rendezvous"]) {
            // line 68
            echo "\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td>";
            // line 69
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "name", [], "any", false, false, false, 69), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>";
            // line 70
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "sujet", [], "any", false, false, false, 70), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t";
            // line 72
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["rendezvous"], "utilisateur", [], "any", false, false, false, 72));
            foreach ($context['_seq'] as $context["_key"] => $context["rendezvous"]) {
                // line 73
                echo "\t\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "firstname", [], "any", false, false, false, 73), "html", null, true);
                echo " <br>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rendezvous'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 75
            echo "\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td>";
            // line 76
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "statut", [], "any", false, false, false, 76), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>";
            // line 77
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "heuredurendezvous", [], "any", false, false, false, 77), "j F Y"), "html", null, true);
            echo " à ";
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "heuredurendezvous", [], "any", false, false, false, 77), "H:i"), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<a href=\"";
            // line 79
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_appointment_modify_admin", ["id" => twig_get_attribute($this->env, $this->source, $context["rendezvous"], "id", [], "any", false, false, false, 79)]), "html", null, true);
            echo "\"><i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rendezvous'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 83
        echo "\t\t\t\t</tbody>
\t\t\t</table>

\t\t\t<div class=\"mb-5\"></div>

\t\t\t<div class=\"text-center bg-blue-light-shebam color-white-shebam p-3 font-weight-bold\">Devis</div>
\t\t\t<table class=\"table table-striped table-light\" data-toggle=\"table\">
\t\t\t\t<thead class=\"bg-yellow-dark color-white-shebam font-weight-bold\">
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
        // line 101
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($context["quote"]);
        foreach ($context['_seq'] as $context["_key"] => $context["quote"]) {
            // line 102
            echo "\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td>";
            // line 103
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "enterprise", [], "any", false, false, false, 103), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>";
            // line 104
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "subject", [], "any", false, false, false, 104), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t";
            // line 106
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["quote"], "person", [], "any", false, false, false, 106));
            foreach ($context['_seq'] as $context["_key"] => $context["quote"]) {
                // line 107
                echo "\t\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "firstname", [], "any", false, false, false, 107), "html", null, true);
                echo " <br>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['quote'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 109
            echo "\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td>";
            // line 110
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "status", [], "any", false, false, false, 110), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>";
            // line 111
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "comment", [], "any", false, false, false, 111), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<a href=\"";
            // line 113
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_quote_modify_admin", ["id" => twig_get_attribute($this->env, $this->source, $context["quote"], "id", [], "any", false, false, false, 113)]), "html", null, true);
            echo "\"><i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['quote'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 117
        echo "\t\t\t\t</tbody>
\t\t\t</table>

\t\t\t<div class=\"mb-5\"></div>

\t\t\t<div class=\"text-center bg-blue-light-shebam color-white-shebam p-3 font-weight-bold\">Priorité 2</div>
\t\t\t<table class=\"table table-striped table-light\" data-toggle=\"table\">
\t\t\t\t<thead class=\"bg-yellow-dark color-white-shebam font-weight-bold\">
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
        // line 135
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($context["task2"]);
        foreach ($context['_seq'] as $context["_key"] => $context["task2"]) {
            // line 136
            echo "\t\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
            // line 137
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task2"], "customer", [], "any", false, false, false, 137), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 138
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task2"], "subject", [], "any", false, false, false, 138), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 139
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["task2"], "users", [], "any", false, false, false, 139));
            foreach ($context['_seq'] as $context["_key"] => $context["task2"]) {
                // line 140
                echo "\t\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task2"], "firstname", [], "any", false, false, false, 140), "html", null, true);
                echo " <br>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['task2'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 142
            echo "\t\t\t\t\t\t</td>
\t\t\t\t\t\t<td>";
            // line 143
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["task2"], "status", [], "any", false, false, false, 143), "name", [], "any", false, false, false, 143), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 144
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task2"], "comment", [], "any", false, false, false, 144), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<a href=\"";
            // line 146
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_quote_modify_admin", ["id" => twig_get_attribute($this->env, $this->source, (isset($context["quote"]) || array_key_exists("quote", $context) ? $context["quote"] : (function () { throw new RuntimeError('Variable "quote" does not exist.', 146, $this->source); })()), "id", [], "any", false, false, false, 146)]), "html", null, true);
            echo "\"><i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['task2'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 150
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

        echo "Liste des tâches - Shebam";
        
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
        return array (  384 => 12,  368 => 150,  358 => 146,  353 => 144,  349 => 143,  346 => 142,  337 => 140,  333 => 139,  329 => 138,  325 => 137,  322 => 136,  318 => 135,  298 => 117,  288 => 113,  283 => 111,  279 => 110,  276 => 109,  267 => 107,  263 => 106,  258 => 104,  254 => 103,  251 => 102,  247 => 101,  227 => 83,  217 => 79,  210 => 77,  206 => 76,  203 => 75,  194 => 73,  190 => 72,  185 => 70,  181 => 69,  178 => 68,  174 => 67,  154 => 49,  144 => 45,  139 => 43,  135 => 42,  132 => 41,  123 => 39,  119 => 38,  115 => 37,  111 => 36,  108 => 35,  104 => 34,  79 => 12,  69 => 4,  59 => 3,  36 => 1,);
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
    <title>{%  block title %}Liste des tâches - Shebam{% endblock %}</title>
    </style>
</head>
<body>
    <header>
\t\t<div class=\"container\">
\t\t\t<div class=\"mb-2\"></div>
\t\t\t<h1 class=\"text-center color-white-shebam mb-3\">Liste des tâches - Shebam</h1>
\t\t\t<hr class=\"text-center mb-5 mt-5\">
\t\t\t<div class=\"text-center bg-yellow-shebam color-white-shebam p-3 font-weight-bold\">Priorité 1</div>
\t\t\t<table class=\"table table-striped table-light mb-5\" data-toggle=\"table\">
\t\t\t\t<thead class=\"bg-yellow-dark color-white-shebam font-weight-bold\">
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
\t\t\t\t\t\t{% for task in task %}
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>{{task.customer}}</td>
\t\t\t\t\t\t<td>{{task.subject}}</td>
\t\t\t\t\t\t<td>{% for task in task.users %}
\t\t\t\t\t\t\t\t{{ task.firstname }} <br>
\t\t\t\t\t\t\t{% endfor %}
\t\t\t\t\t\t</td>
\t\t\t\t\t\t<td>{{task.status.name}}</td>
\t\t\t\t\t\t<td>{{task.comment}}</td>
\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t<a href=\"{{ path('task_list_modify_admin', {\"id\": task.id}) }}\"><i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t\t\t{% endfor %}
\t\t\t\t</tbody>
\t\t\t</table>

\t\t\t<div class=\"mb-5\"></div>

\t\t\t<div class=\"text-center bg-pink-shebam color-white-shebam p-3 font-weight-bold\">Rendez-vous</div>
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
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t{% endfor %}
\t\t\t\t</tbody>
\t\t\t</table>

\t\t\t<div class=\"mb-5\"></div>

\t\t\t<div class=\"text-center bg-blue-light-shebam color-white-shebam p-3 font-weight-bold\">Devis</div>
\t\t\t<table class=\"table table-striped table-light\" data-toggle=\"table\">
\t\t\t\t<thead class=\"bg-yellow-dark color-white-shebam font-weight-bold\">
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
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t{% endfor %}
\t\t\t\t</tbody>
\t\t\t</table>

\t\t\t<div class=\"mb-5\"></div>

\t\t\t<div class=\"text-center bg-blue-light-shebam color-white-shebam p-3 font-weight-bold\">Priorité 2</div>
\t\t\t<table class=\"table table-striped table-light\" data-toggle=\"table\">
\t\t\t\t<thead class=\"bg-yellow-dark color-white-shebam font-weight-bold\">
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
\t\t\t\t\t\t\t\t<a href=\"{{ path('task_quote_modify_admin', {\"id\": quote.id}) }}\"><i class=\"fas fa-cog\"></i></a>
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
