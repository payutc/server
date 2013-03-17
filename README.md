Introduction
============

payutc est un système de paiement avec porte-monnaie électronique avec une architecture client/serveur basée sur des Web Services. Il est utilisé au sein des associations de l'[Université de Technologie de Compiègne](http://www.utc.fr).

Ce dépôt héberge le serveur du projet. Il s'agit d'un fork de celui utilisé par [BuckUTT](http://github.com/buckutt/server), projet similaire déjà en service à l'UTT.

Les clients utilisés à l'UTC sont :

* [casper](https://github.com/payutc/casper) : client de gestion de son compte personnel, avec rechargement, virement et visualisation de l'historique
* [scoobydoo](https://github.com/payutc/scoobydoo) :  client d'administration des droits et des produits
* [mozart](https://github.com/payutc/mozart) : client pour les encaissements via une interface tactile
* [pauline](https://github.com/payutc/pauline) : point de vente pour smartphones sous Android

Installation
============

Le projet utilise Composer pour la gestion des dépendances.

Après avoir cloné le dépôt, il faut installer Composer :

    curl -s https://getcomposer.org/installer | php

Puis, installer les dépendances :

    php composer.phar install

Il faut également remplir le fichier de configuration :
    cp config.inc.dist.php config.inc.php

Puis ouvrir `config.inc.php` et modifier les différentes valeurs.

Contribuer
==========

Le projet est distribué sous licence GPLv3. Nous acceptons les contributions directement sous forme de [pull requests](https://help.github.com/articles/using-pull-requests).

Une mailing-liste regroupant les développeurs est disponible, écrivez à [payutc@assos.utc.fr](mailto:payutc@assos.utc.fr) pour demander à être inscrit (ou pour toute autre demande !).