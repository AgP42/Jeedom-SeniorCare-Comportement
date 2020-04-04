<?php

/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

/* * ***************************Includes********************************* */
require_once __DIR__  . '/../../../../core/php/core.inc.php';

class seniorcarebehavior extends eqLogic {
    /*     * *************************Attributs****************************** */



    /*     * ***********************Methode static*************************** */

/*    public static function cron() { //executée toutes les min par Jeedom


    } //fin cron*/

    //*
    // * Fonction exécutée automatiquement toutes les 15 minutes par Jeedom
/*      public static function cron15() {


      }*/

    /*
     * Fonction exécutée automatiquement toutes les heures par Jeedom
      public static function cronHourly() {

      }
     */

    /*
     * Fonction exécutée automatiquement tous les jours par Jeedom
      public static function cronDaily() {

      }
     */

    /*     * *********************Méthodes d'instance************************* */


    public function preInsert() {

    }

    public function postInsert() {

    }

    public function preSave() {

    }

    // fct appellée par Jeedom aprés l'enregistrement de la configuration
    public function postSave() {

        // creation des cmd à la sauvegarde de l'équipement

        $cmd = $this->getCmd(null, 'capteur_lit');
        if (!is_object($cmd)) {
          $cmd = new seniorcarebehaviorCmd();
          $cmd->setLogicalId('capteur_lit');
          $cmd->setIsVisible(0);
          $cmd->setEqLogic_id($this->getId());
        }
        $cmd->setIsHistorized(1);
        $cmd->setConfiguration('historizeMode', 'none');
        $cmd->setConfiguration('historizeRound', 0);
        $cmd->setName(__('Capteur Lit', __FILE__));
        $cmd->setValue($this->getConfiguration('capteur_lit'));
        $cmd->setType('info');
        $cmd->setSubType('numeric');
        $cmd->save();

        // va chopper la valeur de la commande puis la suivre a chaque changement
        if (is_nan($cmd->execCmd()) || $cmd->execCmd() == '') {
          $cmd->setCollectDate('');
          $cmd->event($cmd->execute());
        }

        $cmd = $this->getCmd(null, 'capteur_porte_entree');
        if (!is_object($cmd)) {
          $cmd = new seniorcarebehaviorCmd();
          $cmd->setLogicalId('capteur_porte_entree');
          $cmd->setIsVisible(0);
          $cmd->setEqLogic_id($this->getId());
        }
        $cmd->setIsHistorized(1);
        $cmd->setConfiguration('historizeMode', 'none');
        $cmd->setConfiguration('historizeRound', 0);
        $cmd->setName(__('Capteur Porte Principale', __FILE__));
        $cmd->setValue($this->getConfiguration('capteur_porte_entree'));
        $cmd->setType('info');
        $cmd->setSubType('numeric');
        $cmd->save();

        // va chopper la valeur de la commande puis la suivre a chaque changement
        if (is_nan($cmd->execCmd()) || $cmd->execCmd() == '') {
          $cmd->setCollectDate('');
          $cmd->event($cmd->execute());
        }

        $cmd = $this->getCmd(null, 'capteur_toilettes');
        if (!is_object($cmd)) {
          $cmd = new seniorcarebehaviorCmd();
          $cmd->setLogicalId('capteur_toilettes');
          $cmd->setIsVisible(0);
          $cmd->setEqLogic_id($this->getId());
        }
        $cmd->setIsHistorized(1);
        $cmd->setConfiguration('historizeMode', 'none');
        $cmd->setConfiguration('historizeRound', 0);
        $cmd->setName(__('Capteur Toilettes', __FILE__));
        $cmd->setValue($this->getConfiguration('capteur_toilettes'));
        $cmd->setType('info');
        $cmd->setSubType('numeric');
        $cmd->save();

        // va chopper la valeur de la commande puis la suivre a chaque changement
        if (is_nan($cmd->execCmd()) || $cmd->execCmd() == '') {
          $cmd->setCollectDate('');
          $cmd->event($cmd->execute());
        }

        $cmd = $this->getCmd(null, 'capteur_frigo');
        if (!is_object($cmd)) {
          $cmd = new seniorcarebehaviorCmd();
          $cmd->setLogicalId('capteur_frigo');
          $cmd->setIsVisible(0);
          $cmd->setEqLogic_id($this->getId());
        }
        $cmd->setIsHistorized(1);
        $cmd->setConfiguration('historizeMode', 'none');
        $cmd->setConfiguration('historizeRound', 0);
        $cmd->setName(__('Capteur Frigo', __FILE__));
        $cmd->setValue($this->getConfiguration('capteur_frigo'));
        $cmd->setType('info');
        $cmd->setSubType('numeric');
        $cmd->save();

        // va chopper la valeur de la commande puis la suivre a chaque changement
        if (is_nan($cmd->execCmd()) || $cmd->execCmd() == '') {
          $cmd->setCollectDate('');
          $cmd->event($cmd->execute());
        }

        $cmd = $this->getCmd(null, 'capteur_mvt_cuisine');
        if (!is_object($cmd)) {
          $cmd = new seniorcarebehaviorCmd();
          $cmd->setLogicalId('capteur_mvt_cuisine');
          $cmd->setIsVisible(0);
          $cmd->setEqLogic_id($this->getId());
        }
        $cmd->setIsHistorized(1);
        $cmd->setConfiguration('historizeMode', 'none');
        $cmd->setConfiguration('historizeRound', 0);
        $cmd->setName(__('Capteur Mvt Cuisine', __FILE__));
        $cmd->setValue($this->getConfiguration('capteur_mvt_cuisine'));
        $cmd->setType('info');
        $cmd->setSubType('numeric');
        $cmd->save();

        // va chopper la valeur de la commande puis la suivre a chaque changement
        if (is_nan($cmd->execCmd()) || $cmd->execCmd() == '') {
          $cmd->setCollectDate('');
          $cmd->event($cmd->execute());
        }


    } // fin fct postSave

    // preUpdate ⇒ Méthode appellée avant la mise à jour de votre objet
    // ici on vérifie la présence de nos champs de config obligatoire
    public function preUpdate() {


    }

    public function postUpdate() {

    }

    public function preRemove() {

    }

    public function postRemove() {

    }

    /*
     * Non obligatoire mais permet de modifier l'affichage du widget si vous en avez besoin
      public function toHtml($_version = 'dashboard') {

      }
     */

    /*
     * Non obligatoire mais ca permet de déclencher une action après modification de variable de configuration
    public static function postConfig_<Variable>() {
    }
     */

    /*
     * Non obligatoire mais ca permet de déclencher une action avant modification de variable de configuration
    public static function preConfig_<Variable>() {
    }
     */

    /*     * **********************Getteur Setteur*************************** */
}

class seniorcarebehaviorCmd extends cmd {
    /*     * *************************Attributs****************************** */


    /*     * ***********************Methode static*************************** */


    /*     * *********************Methode d'instance************************* */

    /*
     * Non obligatoire permet de demander de ne pas supprimer les commandes même si elles ne sont pas dans la nouvelle configuration de l'équipement envoyé en JS
      public function dontRemoveCmd() {
      return true;
      }
     */

    public function execute($_options = array()) {

      log::add('seniorcarebehavior', 'debug', 'Fct execute pour : ' . $this->getLogicalId() . $this->getHumanName() . '- valeur renvoyée : ' . jeedom::evaluateExpression($this->getValue()));

      return jeedom::evaluateExpression($this->getValue());

    //  $eqLogic = $this->getEqLogic();

    }

    /*     * **********************Getteur Setteur*************************** */
}


