<?php
if (!isConnect('admin')) {
	throw new Exception('{{401 - Accès non autorisé}}');
}
$plugin = plugin::byId('seniorcarebehavior');
sendVarToJS('eqType', $plugin->getId());
$eqLogics = eqLogic::byType($plugin->getId());
?>

<div class="row row-overflow">

  <div class="col-xs-12 eqLogicThumbnailDisplay">
    <legend><i class="fas fa-cog"></i>  {{Gestion}}</legend>
    <div class="eqLogicThumbnailContainer">
        <div class="cursor eqLogicAction logoPrimary" data-action="add">
          <i class="fas fa-plus-circle"></i>
          <br>
          <span>{{Ajouter}}</span>
      </div>
        <div class="cursor eqLogicAction logoSecondary" data-action="gotoPluginConf">
        <i class="fas fa-wrench"></i>
      <br>
      <span>{{Configuration}}</span>
    </div>
    </div>
    <legend><i class="fas fa-user-plus"></i> {{Personne dépendante}}</legend>
  	   <input class="form-control" placeholder="{{Rechercher}}" id="in_searchEqlogic" />
  <div class="eqLogicThumbnailContainer">
      <?php
  foreach ($eqLogics as $eqLogic) {
  	$opacity = ($eqLogic->getIsEnable()) ? '' : 'disableCard';
  	echo '<div class="eqLogicDisplayCard cursor '.$opacity.'" data-eqLogic_id="' . $eqLogic->getId() . '">';
  	echo '<img src="' . $plugin->getPathImgIcon() . '"/>';
  	echo '<br>';
  	echo '<span class="name">' . $eqLogic->getHumanName(true, true) . '</span>';
  	echo '</div>';
  }
  ?>
  </div>
  </div>

<div class="col-xs-12 eqLogic" style="display: none;">
		<div class="input-group pull-right" style="display:inline-flex">
			<span class="input-group-btn">
				<a class="btn btn-default btn-sm eqLogicAction roundedLeft" data-action="configure"><i class="fa fa-cogs"></i> {{Configuration avancée}}</a><a class="btn btn-default btn-sm eqLogicAction" data-action="copy"><i class="fas fa-copy"></i> {{Dupliquer}}</a><a class="btn btn-sm btn-success eqLogicAction" data-action="save"><i class="fas fa-check-circle"></i> {{Sauvegarder}}</a><a class="btn btn-danger btn-sm eqLogicAction roundedRight" data-action="remove"><i class="fas fa-minus-circle"></i> {{Supprimer}}</a>
			</span>
		</div>
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation"><a href="#" class="eqLogicAction" aria-controls="home" role="tab" data-toggle="tab" data-action="returnToThumbnailDisplay"><i class="fa fa-arrow-circle-left"></i></a></li>
    <li role="presentation" class="active"><a href="#eqlogictab" aria-controls="home" role="tab" data-toggle="tab"><i class="fas fa-tachometer-alt"></i> {{Général}}</a></li>

<!-- id="rythmetab" style="display: none;" -->
    <li role="presentation"><a href="#rythmetab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-calendar-alt"></i> {{Rythme de vie}}</a></li>

    <li role="presentation"><a href="#isolementtab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fas fa-heartbeat"></i> {{Isolement}}</a></li>

    <li role="presentation"><a href="#infectiontab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fas fa-toggle-on"></i> {{Infection urinaire}}</a></li>

    <li role="presentation"><a href="#alimentationtab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fas fa-spa"></i> {{Alimentation}}</a></li>

    <li role="presentation"><a href="#actiontab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fas fa-exclamation-triangle"></i> {{Actions d'alerte}}</a></li>

    <li role="presentation"><a href="#commandtab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-list-alt"></i> {{Avancé - Commandes Jeedom}}</a></li>

  </ul>

  <div class="tab-content" style="height:calc(100% - 50px);overflow:auto;overflow-x: hidden;">

    <!-- TAB GENERAL -->
    <div role="tabpanel" class="tab-pane active" id="eqlogictab">
      <br/>
      <form class="form-horizontal">
        <fieldset>
          <legend><i class="fas fa-tachometer-alt"></i> {{Informations Jeedom}} </legend>
          <div class="form-group">
            <label class="col-sm-3 control-label">{{Nom Jeedom}}</label>
            <div class="col-sm-3">
              <input type="text" class="eqLogicAttr form-control" data-l1key="id" style="display : none;" />
              <input type="text" class="eqLogicAttr form-control" data-l1key="name" placeholder="{{Nom }}"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" >{{Objet parent}}</label>
            <div class="col-sm-3">
              <select id="sel_object" class="eqLogicAttr form-control" data-l1key="object_id">
                <option value="">{{Aucun}}</option>
                <?php
                  foreach (jeeObject::all() as $object) {
                    echo '<option value="' . $object->getId() . '">' . $object->getName() . '</option>';
                  }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-9">
              <label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="isEnable" checked/>{{Activer}}</label>
              <label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="isVisible" checked/>{{Visible}}</label>
            </div>
          </div>

        </fieldset>
      </form>

<!--       <form class="form-horizontal">
        <fieldset>
          <legend><i class="fas fa-brain"></i> {{Dérives comportementales}} <sup><i class="fas fa-question-circle tooltips" title="{{}}"></i></sup></legend>

          <div class="form-group">
            <label class="col-sm-3 control-label">{{Dérives comportementales à suivre}}</label>
            <div class="col-sm-9">
              <label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="configuration" data-l2key="rythme"/>{{Rythme de vie}}</label>
              <label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="configuration" data-l2key="isolement"/>{{Isolement}}</label>
              <label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="configuration" data-l2key="infection"/>{{Infection urinaire}}</label>
              <label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="configuration" data-l2key="alimentation"/>{{Alimentation}}</label>
            </div>
          </div>

        </fieldset>
      </form> -->

      <form class="form-horizontal">
        <fieldset>
          <legend><i class="fas fa-user-edit"></i> {{Informations concernant la personne dépendante}} <sup><i class="fas fa-question-circle tooltips" title="{{Ces informations seront utilisées uniquement pour la saisie de tags dans les messages d'alertes, tous ces champs sont facultatifs.}}"></i></sup></legend>

          <div class="form-group">
            <label class="col-sm-3 control-label">{{Nom }}</label>
            <div class="col-sm-3">
              <input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="senior_name" placeholder="{{Nom de la personne dépendante}}"/>
            </div>
            <div class="col-sm-3">{{tag <strong>#senior_name#</strong>}}</div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">{{Téléphone }}</label>
            <div class="col-sm-3">
              <input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="senior_phone" placeholder="{{Numéro de téléphone de la personne dépendante}}"/>
            </div>
            <div class="col-sm-3">{{tag <strong>#senior_phone#</strong>}}</div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">{{Adresse ou n° logement }}</label>
            <div class="col-sm-3">
              <input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="senior_address" placeholder="{{Adresse ou n° logement de la personne dépendante}}"/>
            </div>
            <div class="col-sm-3">{{tag <strong>#senior_address#</strong>}}</div>
          </div>

          <br>

          <div class="form-group">
            <label class="col-sm-3 control-label">{{Nom personne de confiance }}</label>
            <div class="col-sm-3">
              <input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="trusted_person_name" placeholder="{{Nom de la personne de confiance}}"/>
            </div>
            <div class="col-sm-3">{{tag <strong>#trusted_person_name#</strong>}}</div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">{{Téléphone personne de confiance }}</label>
            <div class="col-sm-3">
              <input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="trusted_person_phone" placeholder="{{Numéro de téléphone de la personne de confiance}}"/>
            </div>
            <div class="col-sm-3">{{tag <strong>#trusted_person_phone#</strong>}}</div>
          </div>
        </fieldset>
      </form>

    </div>

    <!-- TAB Rythme de vie -->
    <div class="tab-pane" id="rythmetab">
      <br/>
      <div class="alert alert-success">
        <!-- {{TODO}} -->
        <label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="configuration" data-l2key="rythme" checked/>{{Surveiller Rythme de vie}}</label>
      </div>

      <div class="form-group">
      <label class="col-sm-2 control-label">{{Capteur lit}}</label>
        <div class="col-sm-4">
          <div class="input-group">
            <input type="text" class="eqLogicAttr form-control tooltips roundedLeft" data-l1key="configuration" data-l2key="capteur_lit"/>
            <span class="input-group-btn">
              <a class="btn btn-default listCmdInfo roundedRight"><i class="fa fa-list-alt"></i></a>
            </span>
          </div>
        </div>
      </div>

    </div>

    <!-- TAB Isolement -->
    <div class="tab-pane" id="isolementtab">
      <br/>
      <div class="alert alert-success">
        <label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="configuration" data-l2key="isolement" checked/>{{Surveiller Isolement}}</label>
      </div>

      <div class="form-group">
      <label class="col-sm-2 control-label">{{Capteur porte d'entrée principale}}</label>
        <div class="col-sm-4">
          <div class="input-group">
            <input type="text" class="eqLogicAttr form-control tooltips roundedLeft" data-l1key="configuration" data-l2key="capteur_porte_entree"/>
            <span class="input-group-btn">
              <a class="btn btn-default listCmdInfo roundedRight"><i class="fa fa-list-alt"></i></a>
            </span>
          </div>
        </div>
      </div>

    </div>

    <!-- TAB Infection urinaire -->
    <div class="tab-pane" id="infectiontab">
      <br/>
      <div class="alert alert-success">
        <label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="configuration" data-l2key="infection" checked/>{{Surveiller Infection urinaire}}</label>
      </div>

<!--       <div class="form-group">
      <label class="col-sm-2 control-label">{{Capteur lit}}</label>
        <div class="col-sm-4">
          <div class="input-group">
            <input type="text" class="eqLogicAttr form-control tooltips roundedLeft" data-l1key="configuration" data-l2key="capteur_lit_2"/>
            <span class="input-group-btn">
              <a class="btn btn-default listCmdInfo roundedRight"><i class="fa fa-list-alt"></i></a>
            </span>
          </div>
        </div>
      </div> -->

      <div class="form-group">
      <label class="col-sm-2 control-label">{{Capteur chasse d'eau}}</label>
        <div class="col-sm-4">
          <div class="input-group">
            <input type="text" class="eqLogicAttr form-control tooltips roundedLeft" data-l1key="configuration" data-l2key="capteur_toilettes"/>
            <span class="input-group-btn">
              <a class="btn btn-default listCmdInfo roundedRight"><i class="fa fa-list-alt"></i></a>
            </span>
          </div>
        </div>
      </div>

    </div>

    <!-- TAB Alimentation -->
    <div class="tab-pane" id="alimentationtab">
      <br/>
      <div class="alert alert-success">
        <label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="configuration" data-l2key="alimentation" checked/>{{Surveiller Alimentation}}</label>
      </div>

      <div class="form-group">
      <label class="col-sm-2 control-label">{{Capteur frigo}}</label>
        <div class="col-sm-4">
          <div class="input-group">
            <input type="text" class="eqLogicAttr form-control tooltips roundedLeft" data-l1key="configuration" data-l2key="capteur_frigo"/>
            <span class="input-group-btn">
              <a class="btn btn-default listCmdInfo roundedRight"><i class="fa fa-list-alt"></i></a>
            </span>
          </div>
        </div>
      </div>

      <div class="form-group">
      <label class="col-sm-2 control-label">{{Capteur présence/mouvement cuisine}}</label>
        <div class="col-sm-4">
          <div class="input-group">
            <input type="text" class="eqLogicAttr form-control tooltips roundedLeft" data-l1key="configuration" data-l2key="capteur_mvt_cuisine"/>
            <span class="input-group-btn">
              <a class="btn btn-default listCmdInfo roundedRight"><i class="fa fa-list-alt"></i></a>
            </span>
          </div>
        </div>
      </div>

    </div>

    <!-- TAB Actions -->
    <div class="tab-pane" id="actiontab">
      <br/>
      <div class="alert alert-info">
        {{Onglet de configuration de actions d'alerte pour prévenir les aidants - TODO}}
      </div>

      <form class="form-horizontal">
        <fieldset>

          <legend><i class="fas fa-bomb"></i> {{Actions alerte vers les aidants}} <sup><i class="fas fa-question-circle tooltips" title="{{}}"></i></sup>
            <a class="btn btn-success btn-sm addAction" data-type="action_alert_bt" style="margin:5px;"><i class="fas fa-plus-circle"></i> {{Ajouter une action}}</a>
          </legend>

          <div id="div_action_behavior"></div>

        </fieldset>
      </form>

    </div>


    <!-- TAB COMMANDES -->
    <div role="tabpanel" class="tab-pane" id="commandtab">
      <a class="btn btn-success btn-sm cmdAction pull-right" data-action="add" style="margin-top:5px;"><i class="fa fa-plus-circle"></i> {{Commandes}}</a><br/><br/>
      <table id="table_cmd" class="table table-bordered table-condensed">
        <thead>
          <tr>
            <th>{{Nom}}</th><th>{{Type}}</th><th>{{Action}}</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>





  </div> <!-- fin DIV contenant toutes les tab -->

</div>
</div>

<?php include_file('desktop', 'seniorcarebehavior', 'js', 'seniorcarebehavior');?>
<?php include_file('core', 'plugin.template', 'js');?>
