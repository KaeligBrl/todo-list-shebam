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

/* back/task/download.html.twig */
class __TwigTemplate_2ba01e9fa6945dddf28428d2ad0449755a36c8ca45198119a893cf2f531c56d1 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "back/task/base-pdf.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "back/task/download.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "back/task/download.html.twig"));

        $this->parent = $this->loadTemplate("back/task/base-pdf.html.twig", "back/task/download.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "    <h3 class=\"text-center mb-3\" style=\"color: caa904;\"> Liste des tâches téléchargé le ";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "d/m/Y"), "html", null, true);
        echo "</h3>
    <div class=\"text-center p-3\" style=\"background-color: #FFD600; color: #ffffff; font-weight: bold;\">Priorité 1</div>
    <table class=\"table table-striped table-light\" data-toggle=\"table\">
        <thead style=\"background-color: #caa904; color: #ffffff\">
            <tr>
                <th scope=\"col\">Client</th>
                <th scope=\"col\">Sujet</th>
                <th scope=\"col\">Personne(s) Désignée(s)</th>
                <th scope=\"col\">Statut</th>
                <th scope=\"col\">Remarque</th>
            </tr>
        </thead>
        <tbody>
                ";
        // line 17
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($context["task"]);
        foreach ($context['_seq'] as $context["_key"] => $context["task"]) {
            // line 18
            echo "            <tr>
                <td>";
            // line 19
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task"], "customer", [], "any", false, false, false, 19), "html", null, true);
            echo "</td>
                <td>";
            // line 20
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task"], "subject", [], "any", false, false, false, 20), "html", null, true);
            echo "</td>
                <td>";
            // line 21
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["task"], "users", [], "any", false, false, false, 21));
            foreach ($context['_seq'] as $context["_key"] => $context["task"]) {
                // line 22
                echo "                        ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task"], "firstname", [], "any", false, false, false, 22), "html", null, true);
                echo " <br>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['task'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 24
            echo "                </td>
                <td>";
            // line 25
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["task"], "status", [], "any", false, false, false, 25), "name", [], "any", false, false, false, 25), "html", null, true);
            echo "</td>
                <td>";
            // line 26
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task"], "comment", [], "any", false, false, false, 26), "html", null, true);
            echo "</td>
            </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['task'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo "        </tbody>
    </table>

    <div class=\"mb-5\"></div>

    <div style=\"background-color: #DE99C3; color: #ffffff; font-weight: bold;\" class=\"text-center p-3\">Rendez-vous</div>
    <table class=\"table table-striped table-light\" data-toggle=\"table\">
        <thead style=\"background-color: #caa904; color: #ffffff \">
            <tr>
                <th scope=\"col\">Entreprise</th>
                <th scope=\"col\">Sujet</th>
                <th>Personne(s) Désignée(s)</th>
                <th scope=\"col\">Statut</th>
                <th scope=\"col\">Date et heure</th>
            </tr>
        </thead>
        <tbody>
            ";
        // line 46
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($context["rendezvous"]);
        foreach ($context['_seq'] as $context["_key"] => $context["rendezvous"]) {
            // line 47
            echo "                <tr>
                    <td>";
            // line 48
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "name", [], "any", false, false, false, 48), "html", null, true);
            echo "</td>
                    <td>";
            // line 49
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "sujet", [], "any", false, false, false, 49), "html", null, true);
            echo "</td>
                    <td>
                    ";
            // line 51
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["rendezvous"], "utilisateur", [], "any", false, false, false, 51));
            foreach ($context['_seq'] as $context["_key"] => $context["rendezvous"]) {
                // line 52
                echo "                        ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "firstname", [], "any", false, false, false, 52), "html", null, true);
                echo " <br>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rendezvous'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 54
            echo "                    </td>
                    <td>";
            // line 55
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "statut", [], "any", false, false, false, 55), "html", null, true);
            echo "</td>
                    <td>";
            // line 56
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "heuredurendezvous", [], "any", false, false, false, 56), "j F Y"), "html", null, true);
            echo " à ";
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rendezvous"], "heuredurendezvous", [], "any", false, false, false, 56), "H:i"), "html", null, true);
            echo "</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rendezvous'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 59
        echo "        </tbody>
    </table>

    <div class=\"mb-5\"></div>

    <div style=\"background-color: #34BDE8; color: #ffffff; font-weight: bold;\" class=\"text-center p-3\">Devis</div>
    <table class=\"table table-striped table-light\" data-toggle=\"table\">
        <thead style=\"background-color: #caa904; color: #ffffff\">
            <tr>
                <th scope=\"col\">Client</th>
                <th scope=\"col\">Sujet</th>
                <th>Personne(s) Désignée(s)</th>
                <th scope=\"col\">Statut</th>
                <th scope=\"col\">Remarque</th>
            </tr>
        </thead>
        <tbody>
            ";
        // line 76
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($context["quote"]);
        foreach ($context['_seq'] as $context["_key"] => $context["quote"]) {
            // line 77
            echo "                <tr>
                    <td>";
            // line 78
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "enterprise", [], "any", false, false, false, 78), "html", null, true);
            echo "</td>
                    <td>";
            // line 79
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "subject", [], "any", false, false, false, 79), "html", null, true);
            echo "</td>
                    <td>
                    ";
            // line 81
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["quote"], "person", [], "any", false, false, false, 81));
            foreach ($context['_seq'] as $context["_key"] => $context["quote"]) {
                // line 82
                echo "                        ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "firstname", [], "any", false, false, false, 82), "html", null, true);
                echo " <br>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['quote'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 84
            echo "                    </td>
                    <td>";
            // line 85
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "status", [], "any", false, false, false, 85), "html", null, true);
            echo "</td>
                    <td>";
            // line 86
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quote"], "comment", [], "any", false, false, false, 86), "html", null, true);
            echo "</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['quote'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 89
        echo "        </tbody>
    </table>

    <div class=\"mb-5\"></div>

    <div style=\"background-color: #6CBFA5; color: #ffffff; font-weight: bold;\" class=\"text-center p-3\">Priorité 2</div>
    <table class=\"table table-striped table-light\" data-toggle=\"table\">
        <thead style=\"background-color: #caa904; color: #ffffff\">
            <tr>
                <th scope=\"col\">Client</th>
                <th scope=\"col\">Sujet</th>
                <th scope=\"col\">Personne(s) Désignée(s)</th>
                <th scope=\"col\">Statut</th>
                <th scope=\"col\">Remarque</th>
            </tr>
        </thead>
        <tbody>
                ";
        // line 106
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($context["task2"]);
        foreach ($context['_seq'] as $context["_key"] => $context["task2"]) {
            // line 107
            echo "            <tr>
                <td>";
            // line 108
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task2"], "customer", [], "any", false, false, false, 108), "html", null, true);
            echo "</td>
                <td>";
            // line 109
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task2"], "subject", [], "any", false, false, false, 109), "html", null, true);
            echo "</td>
                <td>";
            // line 110
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["task2"], "users", [], "any", false, false, false, 110));
            foreach ($context['_seq'] as $context["_key"] => $context["task2"]) {
                // line 111
                echo "                        ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task2"], "firstname", [], "any", false, false, false, 111), "html", null, true);
                echo " <br>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['task2'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 113
            echo "                </td>
                <td>";
            // line 114
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["task2"], "status", [], "any", false, false, false, 114), "name", [], "any", false, false, false, 114), "html", null, true);
            echo "</td>
                <td>";
            // line 115
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["task2"], "comment", [], "any", false, false, false, 115), "html", null, true);
            echo "</td>
            </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['task2'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 118
        echo "        </tbody>
    </table>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "back/task/download.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  322 => 118,  313 => 115,  309 => 114,  306 => 113,  297 => 111,  293 => 110,  289 => 109,  285 => 108,  282 => 107,  278 => 106,  259 => 89,  250 => 86,  246 => 85,  243 => 84,  234 => 82,  230 => 81,  225 => 79,  221 => 78,  218 => 77,  214 => 76,  195 => 59,  184 => 56,  180 => 55,  177 => 54,  168 => 52,  164 => 51,  159 => 49,  155 => 48,  152 => 47,  148 => 46,  129 => 29,  120 => 26,  116 => 25,  113 => 24,  104 => 22,  100 => 21,  96 => 20,  92 => 19,  89 => 18,  85 => 17,  68 => 4,  58 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'back/task/base-pdf.html.twig' %}

{% block body %}
    <h3 class=\"text-center mb-3\" style=\"color: caa904;\"> Liste des tâches téléchargé le {{ \"now\"|date(\"d/m/Y\") }}</h3>
    <div class=\"text-center p-3\" style=\"background-color: #FFD600; color: #ffffff; font-weight: bold;\">Priorité 1</div>
    <table class=\"table table-striped table-light\" data-toggle=\"table\">
        <thead style=\"background-color: #caa904; color: #ffffff\">
            <tr>
                <th scope=\"col\">Client</th>
                <th scope=\"col\">Sujet</th>
                <th scope=\"col\">Personne(s) Désignée(s)</th>
                <th scope=\"col\">Statut</th>
                <th scope=\"col\">Remarque</th>
            </tr>
        </thead>
        <tbody>
                {% for task in task %}
            <tr>
                <td>{{task.customer}}</td>
                <td>{{task.subject}}</td>
                <td>{% for task in task.users %}
                        {{ task.firstname }} <br>
                    {% endfor %}
                </td>
                <td>{{task.status.name}}</td>
                <td>{{task.comment}}</td>
            </tr>
                {% endfor %}
        </tbody>
    </table>

    <div class=\"mb-5\"></div>

    <div style=\"background-color: #DE99C3; color: #ffffff; font-weight: bold;\" class=\"text-center p-3\">Rendez-vous</div>
    <table class=\"table table-striped table-light\" data-toggle=\"table\">
        <thead style=\"background-color: #caa904; color: #ffffff \">
            <tr>
                <th scope=\"col\">Entreprise</th>
                <th scope=\"col\">Sujet</th>
                <th>Personne(s) Désignée(s)</th>
                <th scope=\"col\">Statut</th>
                <th scope=\"col\">Date et heure</th>
            </tr>
        </thead>
        <tbody>
            {% for rendezvous in rendezvous %}
                <tr>
                    <td>{{rendezvous.name}}</td>
                    <td>{{rendezvous.sujet}}</td>
                    <td>
                    {% for rendezvous in rendezvous.utilisateur %}
                        {{ rendezvous.firstname }} <br>
                    {% endfor %}
                    </td>
                    <td>{{rendezvous.statut}}</td>
                    <td>{{ rendezvous.heuredurendezvous|date('j F Y')  }} à {{rendezvous.heuredurendezvous|date('H:i')}}</td>
                </tr>
            {% endfor %}
        </tbody>
    </table>

    <div class=\"mb-5\"></div>

    <div style=\"background-color: #34BDE8; color: #ffffff; font-weight: bold;\" class=\"text-center p-3\">Devis</div>
    <table class=\"table table-striped table-light\" data-toggle=\"table\">
        <thead style=\"background-color: #caa904; color: #ffffff\">
            <tr>
                <th scope=\"col\">Client</th>
                <th scope=\"col\">Sujet</th>
                <th>Personne(s) Désignée(s)</th>
                <th scope=\"col\">Statut</th>
                <th scope=\"col\">Remarque</th>
            </tr>
        </thead>
        <tbody>
            {% for quote in quote %}
                <tr>
                    <td>{{ quote.enterprise }}</td>
                    <td>{{ quote.subject }}</td>
                    <td>
                    {% for quote in quote.person %}
                        {{ quote.firstname }} <br>
                    {% endfor %}
                    </td>
                    <td>{{ quote.status }}</td>
                    <td>{{ quote.comment }}</td>
                </tr>
            {% endfor %}
        </tbody>
    </table>

    <div class=\"mb-5\"></div>

    <div style=\"background-color: #6CBFA5; color: #ffffff; font-weight: bold;\" class=\"text-center p-3\">Priorité 2</div>
    <table class=\"table table-striped table-light\" data-toggle=\"table\">
        <thead style=\"background-color: #caa904; color: #ffffff\">
            <tr>
                <th scope=\"col\">Client</th>
                <th scope=\"col\">Sujet</th>
                <th scope=\"col\">Personne(s) Désignée(s)</th>
                <th scope=\"col\">Statut</th>
                <th scope=\"col\">Remarque</th>
            </tr>
        </thead>
        <tbody>
                {% for task2 in task2 %}
            <tr>
                <td>{{task2.customer}}</td>
                <td>{{task2.subject}}</td>
                <td>{% for task2 in task2.users %}
                        {{ task2.firstname }} <br>
                    {% endfor %}
                </td>
                <td>{{task2.status.name}}</td>
                <td>{{task2.comment}}</td>
            </tr>
                {% endfor %}
        </tbody>
    </table>
{% endblock %}", "back/task/download.html.twig", "C:\\laragon\\www\\to-do-list-shebam\\templates\\back\\task\\download.html.twig");
    }
}
