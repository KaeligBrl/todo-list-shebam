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
class __TwigTemplate_381a09cedcd187843167ef048dada844da04d72a3da6062460f0d76c76855225 extends Template
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
\t\t\t<div class=\"d-flex flex-row-reverse\">
\t\t\t\t<a href=\"";
        // line 15
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_list_add_admin");
        echo "\" type=\"button\" class=\"btn btn-outline-light mb-3\">
\t\t\t\t\t<i class=\"fas fa-plus-circle\"></i>
\t\t\t\t</a>
\t\t\t\t|
\t\t\t\t<a href=\"";
        // line 19
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task2_list_add_admin");
        echo "\" type=\"button\" class=\"btn btn-outline-light mb-3\">
\t\t\t\t\t<img src=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/images/icon-p2.svg"), "html", null, true);
        echo "\">
\t\t\t\t</a>
\t\t\t\t|
\t\t\t\t<a href=\"";
        // line 23
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_quote_add_admin");
        echo "\" type=\"button\" class=\"btn btn-outline-light mb-3\"><i class=\"fas fa-cart-plus\"></i></a>
\t\t\t\t|\t
\t\t\t\t<a href=\"";
        // line 25
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_appointment_add_admin");
        echo "\" type=\"button\" class=\"btn btn-outline-light mb-3\"><i class=\"fas fa-calendar-plus\"></i></a>
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
        $context['_seq'] = twig_ensure_traversable((isset($context["taches"]) || array_key_exists("taches", $context) ? $context["taches"] : (function () { throw new RuntimeError('Variable "taches" does not exist.', 41, $this->source); })()));
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
            echo "\" onclick=\"return confirm('Attention vous vous apprettez à supprimer une tâche P1')\"><i class=\"fas fa-trash\"></i></a>\t\t\t\t\t\t\t
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

\t\t\t<div class=\"text-center bg-green-light-shebam color-white-shebam p-3\">Priorité 2</div>
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
        // line 148
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($context["task2"]);
        foreach ($context['_seq'] as $context["_key"] => $context["task2"]) {
            // line 149
            echo "\t\t\t\t\t<tr>
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
\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t<a href=\"";
            // line 159
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task2_list_modify_admin", ["id" => twig_get_attribute($this->env, $this->source, $context["task2"], "id", [], "any", false, false, false, 159)]), "html", null, true);
            echo "\"><i class=\"fas fa-cog\"></i></a>
\t\t\t\t\t\t\t\t|
\t\t\t\t\t\t\t<a href=\"";
            // line 161
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task2_list_detete_admin", ["id" => twig_get_attribute($this->env, $this->source, $context["task2"], "id", [], "any", false, false, false, 161)]), "html", null, true);
            echo "\" onclick=\"return confirm('Attention vous vous apprettez à supprimer une tâche P2')\"><i class=\"fas fa-trash\"></i></a>\t\t\t\t\t\t\t
\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['task2'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 165
        echo "\t\t\t\t</tbody>
\t\t\t</table>
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
        return array (  472 => 165,  462 => 161,  457 => 159,  452 => 157,  448 => 156,  445 => 155,  436 => 153,  432 => 152,  428 => 151,  424 => 150,  421 => 149,  417 => 148,  397 => 130,  387 => 126,  382 => 124,  377 => 122,  373 => 121,  370 => 120,  361 => 118,  357 => 117,  352 => 115,  348 => 114,  345 => 113,  341 => 112,  321 => 94,  311 => 90,  306 => 88,  299 => 86,  295 => 85,  292 => 84,  283 => 82,  279 => 81,  274 => 79,  270 => 78,  267 => 77,  263 => 76,  243 => 58,  233 => 54,  228 => 52,  223 => 50,  219 => 49,  216 => 48,  207 => 46,  203 => 45,  199 => 44,  195 => 43,  192 => 42,  188 => 41,  169 => 25,  164 => 23,  158 => 20,  154 => 19,  147 => 15,  143 => 13,  133 => 12,  114 => 10,  104 => 12,  101 => 11,  99 => 10,  93 => 7,  90 => 6,  80 => 5,  61 => 3,  38 => 1,);
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
\t\t\t<div class=\"d-flex flex-row-reverse\">
\t\t\t\t<a href=\"{{ path('task_list_add_admin') }}\" type=\"button\" class=\"btn btn-outline-light mb-3\">
\t\t\t\t\t<i class=\"fas fa-plus-circle\"></i>
\t\t\t\t</a>
\t\t\t\t|
\t\t\t\t<a href=\"{{ path('task2_list_add_admin') }}\" type=\"button\" class=\"btn btn-outline-light mb-3\">
\t\t\t\t\t<img src=\"{{ asset('assets/images/icon-p2.svg') }}\">
\t\t\t\t</a>
\t\t\t\t|
\t\t\t\t<a href=\"{{ path('task_quote_add_admin') }}\" type=\"button\" class=\"btn btn-outline-light mb-3\"><i class=\"fas fa-cart-plus\"></i></a>
\t\t\t\t|\t
\t\t\t\t<a href=\"{{ path('task_appointment_add_admin') }}\" type=\"button\" class=\"btn btn-outline-light mb-3\"><i class=\"fas fa-calendar-plus\"></i></a>
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
\t\t\t\t\t\t{% for tache in taches %}
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
\t\t\t\t\t\t\t<a href=\"{{ path('task_list_detete_admin', {\"id\": tache.id}) }}\" onclick=\"return confirm('Attention vous vous apprettez à supprimer une tâche P1')\"><i class=\"fas fa-trash\"></i></a>\t\t\t\t\t\t\t
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

\t\t\t<div class=\"text-center bg-green-light-shebam color-white-shebam p-3\">Priorité 2</div>
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
\t\t\t\t\t\t\t<a href=\"{{ path('task2_list_detete_admin', {\"id\": task2.id}) }}\" onclick=\"return confirm('Attention vous vous apprettez à supprimer une tâche P2')\"><i class=\"fas fa-trash\"></i></a>\t\t\t\t\t\t\t
\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t\t\t{% endfor %}
\t\t\t\t</tbody>
\t\t\t</table>
\t\t</div>
\t{% endblock %}
{% endblock %}", "back/task/list.html.twig", "C:\\laragon\\www\\to-do-list-shebam\\templates\\back\\task\\list.html.twig");
    }
}
