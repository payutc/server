<?php

class IntrospectableBase {
    /**
     * Renvoie la liste des méthodes utilisables sur ce service
     */
    public function getMethods() {
        $excluded_methods = array('__construct', '__wakeup');

        $r = new \ReflectionClass($this);
        $methods = $r->getMethods(\ReflectionMethod::IS_PUBLIC);
        $res = array();

        foreach ($methods as $method) {
            if ($method->isStatic() || in_array($method->getName(), $excluded_methods)) {
                continue;
            }

            // On récupère le docstrinf de la fonction
            $doc = $method->getDocComment();
            if ($doc === false) {
                // si il n'y a pas de doc on renvoie juste une chaine vide
                $doc = "";
            } else {
                $doc = str_replace( "\r", "\n", $doc);
                $lines = explode("\n", $doc);
                $clean_doc = "";

                $nb_lines = count($lines);
                for ($i = 1; $i < $nb_lines -1; $i++) {
                    // on ignore la première ligne ( /** )
                    // et la dernière ( */ )
                    $clean_doc .= preg_replace('/^[\s\t]*\*[ ]?(.*)/i', '$1', $lines[$i])."\n";
                }

                $doc = substr($clean_doc, 0, -1);
            }

            // on récupère le nom de la fonction et les paramètres
            $m = array('name' => $method->getName(),
                       'comment' => $doc,
                       'parameters' => array());

            foreach ($method->getParameters() as $param) {
                // pour chaque méthode on récupère le nom et la valeur
                // par défaut si le paramètre est optionel
                $p = array('name' => $param->getName());
                if ($param->isOptional()) {
                    $p['default'] = $param->getDefaultValue();
                }
                $m['parameters'][] = $p;
            }

            $res[] = $m;
        }
        return $res;
    }
}
