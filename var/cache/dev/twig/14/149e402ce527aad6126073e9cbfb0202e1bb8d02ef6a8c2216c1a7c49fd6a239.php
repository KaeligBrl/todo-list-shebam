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

/* back/task/list.html.twig */
class __TwigTemplate_af9fe7a46a1d4d591698a187540f02840bc043e93f143e2a2d321e596b70348f extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
            'titre_admin_page' => [$this, 'block_titre_admin_page'],
            'admin_utilisateur' => [$this, 'block_admin_utilisateur'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "back/index.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "back/task/list.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "back/task/list.html.twig"));

        $this->parent = $this->loadTemplate("back/index.html.twig", "back/task/list.html.twig", 1);
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

        echo "Liste des tâches - Administration";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 5
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        echo "
\t\t<link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/custom.js"), "html", null, true);
        echo "\">

\t<div>
\t\t";
        // line 10
        $this->displayBlock('titre_admin_page', $context, $blocks);
        // line 11
        echo "\t</div>
\t";
        // line 12
        $this->displayBlock('admin_utilisateur', $context, $blocks);
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 10
    public function block_titre_admin_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "titre_admin_page"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "titre_admin_page"));

        echo "Liste de nos tâches";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 12
    public function block_admin_utilisateur($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "admin_utilisateur"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "admin_utilisateur"));

        // line 13
        echo "\t\t<div class=\"container\">
\t\t\t<div class=\"text-center bg-yellow-shebam color-white-shebam p-3\">Priorité 1
\t\t\t\t<div class=\"add-icon-custom d-flex flew-row-reverse\">\t\t\t
\t\t\t\t\t<a href=\"";
        // line 16
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_list_add_admin");
        echo "\" type=\"button\" class=\"btn btn-outline-light\">
\t\t\t\t\t\t<i class=\"fas fa-plus-circle\"></i>
\t\t\t\t\t</a>
\t\t\t\t</div>
\t\t\t</div>
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
        // line 33
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($context["task"]);
        foreach ($context['_seq'] as $context["_key"] => $context["task"]) {
            // line 34
            echo "\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
            // line 35
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task"], "customer", [], "any", false, false, false, 35), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 36
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task"], "subject", [], "any", false, false, false, 36), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 37
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["task"], "users", [], "any", false, false, false, 37));
            foreach ($context['_seq'] as $context["_key"] => $context["task"]) {
                // line 38
                echo "\t\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task"], "firstname", [], "any", false, false, false, 38), "html", null, true);
                echo " <br>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['task'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 40
            echo "\t\t\t\t\t\t</td>
\t\t\t\t\t\t<td>";
            // line 41
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["task"], "status", [], "any", false, false, false, 41), "name", [], "any", false, false, false, 41), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 42
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task"], "comment", [], "any", false, false, false, 42), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t<a href=\"";
            // line 44
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_list_modify_admin", ["id" => twig_get_attribute($this->env, $this->source, $context["task"], "id", [], "any", false, false, false, 44)]), "html", null, true);
            echo "\"><i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t\t\t|
\t\t\t\t\t\t\t<a href=\"";
            // line 46
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_list_detete_admin", ["id" => twig_get_attribute($this->env, $this->source, $context["task"], "id", [], "any", false, false, false, 46)]), "html", null, true);
            echo "\" onclick=\"return confirm('Attention vous vous apprettez à supprimer une tâche')\"><i class=\"fas fa-trash\"></i></a>\t\t\t\t\t\t\t
\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['task'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 50
        echo "\t\t\t\t</tbody>
\t\t\t</table>

\t\t\t<div class=\"mb-5\"></div>

\t\t\t<div class=\"text-center bg-pink-shebam color-white-shebam p-3\">Rendez-vous
\t\t\t\t<div class=\"add-icon-custom d-flex flew-row-reverse\">\t\t\t\t
\t\t\t\t\t<a href=\"";
        // line 57
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_appointment_add_admin");
        echo "\" type=\"button\" class=\"btn btn-outline-light\">
\t\t\t\t\t\t<i class=\"fas fa-plus-circle\"></i>
\t\t\t\t\t</a>
\t\t\t\t</div>
\t\t\t</div>
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
        // line 74
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($context["rendezvous"]);
        foreach ($context['_seq'] as $context["_key"] => $context["rendezvous"]) {
            // line 75
            echo "\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td>";
            // line 76
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "name", [], "any", false, false, false, 76), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>";
            // line 77
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "sujet", [], "any", false, false, false, 77), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t";
            // line 79
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["rendezvous"], "utilisateur", [], "any", false, false, false, 79));
            foreach ($context['_seq'] as $context["_key"] => $context["rendezvous"]) {
                // line 80
                echo "\t\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "firstname", [], "any", false, false, false, 80), "html", null, true);
                echo " <br>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rendezvous'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 82
            echo "\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td>";
            // line 83
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "statut", [], "any", false, false, false, 83), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>";
            // line 84
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "heuredurendezvous", [], "any", false, false, false, 84), "j F Y"), "html", null, true);
            echo " à ";
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "heuredurendezvous", [], "any", false, false, false, 84), "H:i"), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<a href=\"";
            // line 86
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_appointment_modify_admin", ["id" => twig_get_attribute($this->env, $this->source, $context["rendezvous"], "id", [], "any", false, false, false, 86)]), "html", null, true);
            echo "\"><i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t\t\t|
\t\t\t\t\t\t\t\t<a href=\"";
            // line 88
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_appointment_detete_admin", ["id" => twig_get_attribute($this->env, $this->source, $context["rendezvous"], "id", [], "any", false, false, false, 88)]), "html", null, true);
            echo "\" onclick=\"return confirm('Attention vous vous apprettez à supprimer un rendez-vous')\"><i class=\"fas fa-trash\"></i></a>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rendezvous'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 92
        echo "\t\t\t\t</tbody>
\t\t\t</table>

\t\t\t<div class=\"mb-5\"></div>

\t\t\t<div class=\"text-center bg-blue-light-shebam color-white-shebam p-3 align-bottom\">Devis
\t\t\t\t<div class=\"add-icon-custom d-flex flew-row-reverse\">\t\t\t\t
\t\t\t\t\t<a href=\"";
        // line 99
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_quote_add_admin");
        echo "\" type=\"button\" class=\"btn btn-outline-light\">
\t\t\t\t\t\t<i class=\"fas fa-plus-circle\"></i>
\t\t\t\t\t</a>
\t\t\t\t</div>
\t\t\t</div>
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
        // line 116
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($context["quote"]);
        foreach ($context['_seq'] as $context["_key"] => $context["quote"]) {
            // line 117
            echo "\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td>";
            // line 118
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "enterprise", [], "any", false, false, false, 118), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>";
            // line 119
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "subject", [], "any", false, false, false, 119), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t";
            // line 121
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["quote"], "person", [], "any", false, false, false, 121));
            foreach ($context['_seq'] as $context["_key"] => $context["quote"]) {
                // line 122
                echo "\t\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "firstname", [], "any", false, false, false, 122), "html", null, true);
                echo " <br>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['quote'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 124
            echo "\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td>";
            // line 125
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "status", [], "any", false, false, false, 125), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>";
            // line 126
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "comment", [], "any", false, false, false, 126), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<a href=\"";
            // line 128
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_quote_modify_admin", ["id" => twig_get_attribute($this->env, $this->source, $context["quote"], "id", [], "any", false, false, false, 128)]), "html", null, true);
            echo "\"><i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t\t\t|
\t\t\t\t\t\t\t\t<a href=\"";
            // line 130
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_quote_detete_admin", ["id" => twig_get_attribute($this->env, $this->source, $context["quote"], "id", [], "any", false, false, false, 130)]), "html", null, true);
            echo "\" onclick=\"return confirm('Attention vous vous apprettez à supprimer un devis')\"><i class=\"fas fa-trash\"></i></a>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['quote'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 134
        echo "\t\t\t\t</tbody>
\t\t\t</table>

\t\t\t<div class=\"mb-5\"></div>

\t\t\t<div class=\"text-center bg-green-light-shebam color-white-shebam p-3\">Priorité 2
\t\t\t\t<div class=\"add-icon-custom d-flex flew-row-reverse\">\t\t\t\t
\t\t\t\t\t<a href=\"";
        // line 141
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task2_list_add_admin");
        echo "\" type=\"button\" class=\"btn btn-outline-light\">
\t\t\t\t\t\t<i class=\"fas fa-plus-circle\"></i>
\t\t\t\t\t</a>
\t\t\t\t</div>
\t\t\t</div>
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
        // line 158
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($context["task2"]);
        foreach ($context['_seq'] as $context["_key"] => $context["task2"]) {
            // line 159
            echo "\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
            // line 160
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task2"], "customer", [], "any", false, false, false, 160), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 161
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task2"], "subject", [], "any", false, false, false, 161), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 162
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["task2"], "users", [], "any", false, false, false, 162));
            foreach ($context['_seq'] as $context["_key"] => $context["task2"]) {
                // line 163
                echo "\t\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task2"], "firstname", [], "any", false, false, false, 163), "html", null, true);
                echo " <br>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['task2'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 165
            echo "\t\t\t\t\t\t</td>
\t\t\t\t\t\t<td>";
            // line 166
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["task2"], "status", [], "any", false, false, false, 166), "name", [], "any", false, false, false, 166), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 167
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task2"], "comment", [], "any", false, false, false, 167), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t<a href=\"";
            // line 169
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task2_list_modify_admin", ["id" => twig_get_attribute($this->env, $this->source, $context["task2"], "id", [], "any", false, false, false, 169)]), "html", null, true);
            echo "\"><i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t\t\t|
\t\t\t\t\t\t\t<a href=\"";
            // line 171
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task2_list_detete_admin", ["id" => twig_get_attribute($this->env, $this->source, $context["task2"], "id", [], "any", false, false, false, 171)]), "html", null, true);
            echo "\" onclick=\"return confirm('Attention vous vous apprettez à supprimer une tâche P2')\"><i class=\"fas fa-trash\"></i></a>\t\t\t\t\t
\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['task2'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 175
        echo "\t\t\t\t</tbody>
\t\t\t</table>
\t\t\t<div class=\"mt-3 text-center btn-submit-admin-shebam btn\"><a href=\"";
        // line 177
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_list_download_admin");
        echo "\">Télécharger la liste des tâches</a>
\t\t</div>
\t";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "back/task/list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  483 => 177,  479 => 175,  469 => 171,  464 => 169,  459 => 167,  455 => 166,  452 => 165,  443 => 163,  439 => 162,  435 => 161,  431 => 160,  428 => 159,  424 => 158,  404 => 141,  395 => 134,  385 => 130,  380 => 128,  375 => 126,  371 => 125,  368 => 124,  359 => 122,  355 => 121,  350 => 119,  346 => 118,  343 => 117,  339 => 116,  319 => 99,  310 => 92,  300 => 88,  295 => 86,  288 => 84,  284 => 83,  281 => 82,  272 => 80,  268 => 79,  263 => 77,  259 => 76,  256 => 75,  252 => 74,  232 => 57,  223 => 50,  213 => 46,  208 => 44,  203 => 42,  199 => 41,  196 => 40,  187 => 38,  183 => 37,  179 => 36,  175 => 35,  172 => 34,  168 => 33,  148 => 16,  143 => 13,  133 => 12,  114 => 10,  104 => 12,  101 => 11,  99 => 10,  93 => 7,  90 => 6,  80 => 5,  61 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'back/index.html.twig' %}

{% block title %}Liste des tâches - Administration{% endblock %}

{% block body %}

\t\t<link rel=\"stylesheet\" href=\"{{ asset('assets/js/custom.js') }}\">

\t<div>
\t\t{% block titre_admin_page %}Liste de nos tâches{% endblock %}
\t</div>
\t{% block admin_utilisateur %}
\t\t<div class=\"container\">
\t\t\t<div class=\"text-center bg-yellow-shebam color-white-shebam p-3\">Priorité 1
\t\t\t\t<div class=\"add-icon-custom d-flex flew-row-reverse\">\t\t\t
\t\t\t\t\t<a href=\"{{ path('task_list_add_admin') }}\" type=\"button\" class=\"btn btn-outline-light\">
\t\t\t\t\t\t<i class=\"fas fa-plus-circle\"></i>
\t\t\t\t\t</a>
\t\t\t\t</div>
\t\t\t</div>
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
\t\t\t\t\t\t\t\t|
\t\t\t\t\t\t\t<a href=\"{{ path('task_list_detete_admin', {\"id\": task.id}) }}\" onclick=\"return confirm('Attention vous vous apprettez à supprimer une tâche')\"><i class=\"fas fa-trash\"></i></a>\t\t\t\t\t\t\t
\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t\t\t{% endfor %}
\t\t\t\t</tbody>
\t\t\t</table>

\t\t\t<div class=\"mb-5\"></div>

\t\t\t<div class=\"text-center bg-pink-shebam color-white-shebam p-3\">Rendez-vous
\t\t\t\t<div class=\"add-icon-custom d-flex flew-row-reverse\">\t\t\t\t
\t\t\t\t\t<a href=\"{{ path('task_appointment_add_admin') }}\" type=\"button\" class=\"btn btn-outline-light\">
\t\t\t\t\t\t<i class=\"fas fa-plus-circle\"></i>
\t\t\t\t\t</a>
\t\t\t\t</div>
\t\t\t</div>
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

\t\t\t<div class=\"text-center bg-blue-light-shebam color-white-shebam p-3 align-bottom\">Devis
\t\t\t\t<div class=\"add-icon-custom d-flex flew-row-reverse\">\t\t\t\t
\t\t\t\t\t<a href=\"{{ path('task_quote_add_admin') }}\" type=\"button\" class=\"btn btn-outline-light\">
\t\t\t\t\t\t<i class=\"fas fa-plus-circle\"></i>
\t\t\t\t\t</a>
\t\t\t\t</div>
\t\t\t</div>
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

\t\t\t<div class=\"text-center bg-green-light-shebam color-white-shebam p-3\">Priorité 2
\t\t\t\t<div class=\"add-icon-custom d-flex flew-row-reverse\">\t\t\t\t
\t\t\t\t\t<a href=\"{{ path('task2_list_add_admin') }}\" type=\"button\" class=\"btn btn-outline-light\">
\t\t\t\t\t\t<i class=\"fas fa-plus-circle\"></i>
\t\t\t\t\t</a>
\t\t\t\t</div>
\t\t\t</div>
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
\t\t\t\t\t\t{% for task2 in task2 %}
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>{{task2.customer}}</td>
\t\t\t\t\t\t<td>{{task2.subject}}</td>
\t\t\t\t\t\t<td>{% for task2 in task2.users %}
\t\t\t\t\t\t\t\t{{ task2.firstname }} <br>
\t\t\t\t\t\t\t{% endfor %}
\t\t\t\t\t\t</td>
\t\t\t\t\t\t<td>{{task2.status.name}}</td>
\t\t\t\t\t\t<td>{{task2.comment}}</td>
\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t<a href=\"{{ path('task2_list_modify_admin', {\"id\": task2.id}) }}\"><i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t\t\t|
\t\t\t\t\t\t\t<a href=\"{{ path('task2_list_detete_admin', {\"id\": task2.id}) }}\" onclick=\"return confirm('Attention vous vous apprettez à supprimer une tâche P2')\"><i class=\"fas fa-trash\"></i></a>\t\t\t\t\t
\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t\t\t{% endfor %}
\t\t\t\t</tbody>
\t\t\t</table>
\t\t\t<div class=\"mt-3 text-center btn-submit-admin-shebam btn\"><a href=\"{{path('task_list_download_admin') }}\">Télécharger la liste des tâches</a>
\t\t</div>
\t{% endblock %}
{% endblock %}", "back/task/list.html.twig", "C:\\laragon\\www\\to-do-list-shebam\\templates\\back\\task\\list.html.twig");
    }
}
