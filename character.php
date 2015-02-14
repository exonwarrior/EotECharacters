<?php
require_once('connection.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Dossier</title>
		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/fontello.css">
		<script src="//use.edgefonts.net/advent-pro.js"></script>
		<meta name="viewport" content="width=device-width initial-scale=1.0, user-scalable=no">
	</head>
<body>
	<div class="charListContainer">
		<div class="characterList">
			<h2>Characters</h2>
			<div class="characters">
				<?php
					// create query 
					$query = "SELECT * FROM exon_character";

					// execute query 
					$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error()); 

					// see if any rows were returned 
					if (mysql_num_rows($result) > 0) {
						while($row = mysql_fetch_row($result)) {
							echo '<div class="characterList">'.$row[2].'</div>';
						}
					}
				?>
				<button {{action 'createCharacter'}} class="icon-plus"></button>
			</div>
		</div>
	</div>

    <div class="character">
      {{partial "header"}}
      <div class="characterStats">
        {{partial currentStats}}     
      </div> 
      <div class="characterCharacteristics">
        <div class="characteristicBox">
          <div class="characteristicValue">{{#if isEditing}}
              {{view App.CharacteristicView min="0" max="6" step="1" maxlength="1" valueBinding="brawn"}}
            {{else}}
              {{brawn}}
            {{/if}}</div>
          <div class="characteristicLabel">Brawn</div>
        </div>
        <div class="characteristicBox">
          <div class="characteristicValue">{{#if isEditing}}
              {{view App.CharacteristicView min="0" max="6" step="1" maxlength="1" valueBinding="agility"}}
            {{else}}
              {{agility}}
            {{/if}}</div>
          <div class="characteristicLabel">Agility</div>
        </div>
        <div class="characteristicBox">
          <div class="characteristicValue">{{#if isEditing}}
              {{view App.CharacteristicView min="0" max="6" step="1" maxlength="1" valueBinding="intellect"}}
            {{else}}
              {{intellect}}
            {{/if}}</div>
          <div class="characteristicLabel">Intellect</div>
        </div>
        <div class="characteristicBox">
          <div class="characteristicValue">{{#if isEditing}}
              {{view App.CharacteristicView min="0" max="6" step="1" maxlength="1" valueBinding="cunning"}}
            {{else}}
              {{cunning}}
            {{/if}}</div>
          <div class="characteristicLabel">Cunning</div>
        </div>
        <div class="characteristicBox">
          <div class="characteristicValue">{{#if isEditing}}
              {{view App.CharacteristicView min="0" max="6" step="1" maxlength="1" valueBinding="willpower"}}
            {{else}}
              {{willpower}}
            {{/if}}</div>
          <div class="characteristicLabel">Willpower</div>
        </div>
        <div class="characteristicBox">
          <div class="characteristicValue">{{#if isEditing}}
              {{view App.CharacteristicView min="0" max="6" step="1" valueBinding="presence"}}
            {{else}}
              {{presence}}
            {{/if}}</div>
          <div class="characteristicLabel">Presence</div>
        </div>
      </div>
      <div class="characterSkills">
        <h1>Skills</h1>
        <div class="characterGeneralSkills contentBlock">
          {{partial generalSkills}}
        </div>
        <div class="characterOtherSkills contentBlock">
          {{partial combatSkills}}
          {{partial knowledgeSkills}}
        </div>
      </div>
      <div class="characterWeaponsContainer">
        <div class="characterWeapons">
          <h1>Weapons <button {{action createWeapon}}>[+]</button></h1>
          <div class="contentBlock col6">
            <table class="">
              <thead>
                <tr>
                  <td class="col1">Weapon</td>
                  <td class="col2">Skill</td>
                  <td class="col3">Damage</td>
                  <td class="col4">Range</td>
                  <td class="col5">Crit</td>
                  <td class="col6">Special</td>
                </tr>
              </thead>
              <tbody>
                {{#each weapon in weapons}}
                  {{control "weapon" weapon}}
                {{/each}}
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="characterEquipment">
        <div class="characterArmor twoUp">
          <h1>Armor <button {{action 'createArmor'}}>[+]</button></h1>
          <div class="contentBlock col2">
            <table>
              <thead>
                <tr>
                  <td class="col1">Name</td>
                  <td class="col2">Stats</td>
                </tr>
              </thead>
              <tbody>
                {{#each armor in armor}}
                  {{control "armor" armor}}
                {{/each}} 
              </tbody>
            </table>
          </div>
        </div>
        <div class="characterInventory twoUp">
          <h1>Inventory <button {{action 'createInventoryItem'}}>[+]</button></h1>
          <div class="contentBlock col2">
            <table>
              <thead>
                <tr>
                  <td class="col1">Name</td>
                  <td class="col2">Description</td>
                </tr>
              </thead>
              <tbody>
                {{#each item in inventory}}
                  {{control "inventoryItem" item}}
                {{/each}}
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="characterMiscInfo">
        <div class="characterCritInjuries twoUp">
          <h1>Critical Injuries <button {{action 'createCriticalInjury'}}>[+]</button></h1>
          <div class="contentBlock col3">
            <table>
              <thead>
                <tr>
                  <td class="col1">Injury</td>
                  <td class="col2">Severity</td>
                  <td class="col3">Result</td>
                </tr>
              </thead>
              <tbody>
                {{#each item in criticalInjuries}}
                  {{control "criticalInjury" item}}
                {{/each}}
              </tbody>
            </table>
          </div>
        </div>
        <div class="characterXP twoUp">
          <h1>XP <button {{action 'createXPItem'}}>[+]</button></h1>
          <div class="contentBlock col2">
            <table>
              <thead>
                <tr>
                  <td class="col1">Source</td>
                  <td class="col2">Amount</td>
                </tr>
              </thead>
              <tbody>
                {{#each xpItem in xp}}
                  {{control "xp" xpItem}}
                {{/each}}
                 <tr class="total">
                  <td class="col1"><strong>Total XP</strong></td>
                  <td class="col2"><strong>{{totalXP}}</strong></td> 
                </tr>
                <tr>
                  <td class="col1"><strong>Available XP</strong></td>
                  <td class="col2"><strong>{{availableXP}}</strong></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="characterMotivation twoUp">
          <h1>Motivations <button {{action 'createMotivation'}}>[+]</button></h1>
          <table>
            <tbody>
              {{#each item in motivation}}
                {{control "motivation" item}}
              {{/each}}
            </tbody>
          </table>
        </div>
        <div class="characterObligation twoUp">
          <h1>Obligation <button {{action 'createObligation'}}>[+]</button></h1>
          <div class="contentBlock col3">
            <table>
              <thead>
                <tr>
                  <td class="col1">Type</td>
                  <td class="col2">Magnitude</td>
                  <td class="col3">Details</td>
                </tr>
              </thead>
              <tbody>
                {{#each item in obligation}}
                  {{control "obligation" item}}
                {{/each}}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </script>

	<script type="text/x-handlebars" data-template-name="_currentStats">
  		<h1>Current Stats</h1>
		<div class="statBox dual">
      			<div class="row statRow">
				<div class="statLeft current">{{woundsCurrent}}
					<div class="statBoxLabel">
						<button {{action 'addToStat' "woundsCurrent" 1}}>[+]</button> 
						Current 
						<button {{action 'addToStat' "woundsCurrent" -1}}>[-]</button>
					</div>
				</div>
				<div class="statRight threshold">{{woundsThreshold}}
					<div class="statBoxLabel">
						<button {{action 'addToStat' "woundsThreshold" 1}}>[+]</button> 
						Threshold 
						<button {{action 'addToStat' "woundsThreshold" -1}}>[-]</button>
					</div>
				</div>
			</div>
      			<div class="statRow bottom">
        			<div class="statLabel">Wounds
				</div>
      			</div>
    		</div>
	    	<div class="statBox dual">
	      		<div class="row statRow">
				<div class="statLeft current">{{strainCurrent}}
					<div class="statBoxLabel">
						<button {{action 'addToStat' "strainCurrent" 1}}>[+]</button> 
						Current 
						<button {{action 'addToStat' "strainCurrent" -1}}>[-]</button>
					</div>
				</div>
				<div class="statRight threshold">{{strainThreshold}}
					<div class="statBoxLabel">
						<button {{action 'addToStat' "strainThreshold" 1}}>[+]</button> 
						Threshold 
						<button {{action 'addToStat' "strainThreshold" -1}}>[-]</button>
					</div>
				</div>
	      		</div>
	      		<div class="statRow bottom">
				<div class="statLabel">Strain
				</div>
			</div>
		</div>
		<div class="statBox dual">
			<div class="row statRow">
				<div class="statLeft ranged">{{defenseRanged}}
					<div class="statBoxLabel">
						<button {{action 'addToStat' "defenseRanged" 1}}>[+]</button> 
						Ranged 
						<button {{action 'addToStat' "defenseRanged" -1}}>[-]</button>
					</div>
				</div>
				<div class="statRight melee">{{defenseMelee}}
					<div class="statBoxLabel">
						<button {{action 'addToStat' "defenseMelee" 1}}>[+]</button> 
						Melee 
						<button {{action 'addToStat' "defenseMelee" -1}}>[-]</button>
					</div>
				</div>
			</div>
			<div class="statRow bottom">
				<div class="statLabel">Defense
				</div>
			</div>
		</div>
		<div class="statBox solo">
			<div class="row statRow">
				<div class="statLeft">{{currentSoak}}
					<div class="statBoxLabel">{{#if soakModded}}( {{soakModdedPref}}{{soakMod}} ){{else}}&nbsp;{{/if}}
					</div>
				</div>
			</div>
			<div class="statRow bottom">
				<div class="statLabel">
					<button {{action 'addToSoak' 1}}>[+]</button>
					Soak 
					<button {{action 'addToSoak' -1}}>[-]</button> 
				</div>
			</div>
		</div>
		<div class="statBox solo">
			<div class="row statRow">
				<div class="statLeft">{{#if boostSetbackDice}}{{dice boostSetbackDice}}{{else}}&nbsp;{{/if}}
					<div class="statBoxLabel">&nbsp;
					</div>
				</div>
			</div>
			<div class="statRow bottom">
				<div class="statLabel">
					<span class="boostDice">
						<button {{action 'addDice' 1 "b"}}>[+]</button> 
						<button {{action 'addDice' -1 "b"}}>[-]</button>
					</span> 
					Boost/Setback 
					<span class="setbackDice">
						<button {{action 'addDice' 1 "s"}}>[+]</button> 
						<button {{action 'addDice' -1 "s"}}>[-]</button>
					</span>
				</div>
			</div>
		</div>
	</script> 

  <script type="text/x-handlebars" data-template-name="_header">
    <header class="characterInfo">
      <table class="inlineBlock">
        <tbody>
          <tr>
            <td class="fieldLabel col1">Species</td>
            <td class="field col2">
            {{#if isEditing}}
              {{view App.EditTextView valueBinding="species"}}
            {{else}}
              {{species}}
            {{/if}}
            </td>
          </tr>
          <tr>
            <td class="fieldLabel col1">Career</td>
            <td class="field col2">{{#if isEditing}}
              {{view App.EditTextView valueBinding="career"}}
            {{else}}
              {{career}}
            {{/if}}</td>
          </tr>
          <tr>
            <td class="fieldLabel col1">Gender</td>
            <td class="field col2">{{#if isEditing}}
              {{view App.EditTextView valueBinding="gender"}}
            {{else}}
              {{gender}}
            {{/if}}</td>
          </tr>
          <tr>
            <td class="fieldLabel col1">Age</td>
            <td class="field col2">{{#if isEditing}}
              {{view App.EditTextView valueBinding="age"}}
            {{else}}
              {{age}}
            {{/if}}</td>
          </tr>
          <tr>
            <td class="fieldLabel col1">Height</td>
            <td class="field col2">{{#if isEditing}}
              {{view App.EditTextView valueBinding="height"}}
            {{else}}
              {{height}}cm
            {{/if}}</td>
          </tr>
        </tbody>
      </table>
      <table class="inlineBlock">
        <tbody>
          <tr>
            <td class="fieldLabel col1">Hair</td>
            <td class="field col2">{{#if isEditing}}
              {{view App.EditTextView valueBinding="hair"}}
            {{else}}
              {{hair}}
            {{/if}}</td>
          </tr>
          <tr>
            <td class="fieldLabel col1">Eyes</td>
            <td class="field col2">{{#if isEditing}}
              {{view App.EditTextView valueBinding="eyes"}}
            {{else}}
              {{eyes}}
            {{/if}}</td>
          </tr>
          <tr>
            <td class="fieldLabel col1">Notable Features</td>
            <td class="field col2">{{#if isEditing}}
              {{view App.EditTextView valueBinding="notableFeatures"}}
            {{else}}
              {{notableFeatures}}
            {{/if}}</td>
          </tr>
          <tr>
            <td class="fieldLabel col1">Build</td>
            <td class="field col2">{{#if isEditing}}
              {{view App.EditTextView valueBinding="build"}}
            {{else}}
              {{build}}
            {{/if}}</td>
          </tr>
          <tr>
            <td class="fieldLabel col1">Player</td>
            <td class="field col2">{{#if isEditing}}
              {{view App.EditTextView valueBinding="playerName"}}
            {{else}}
              {{playerName}}
            {{/if}}</td>
          </tr>
        </tbody>
      </table>
      <div class="characterBadge inlineBlock">
        {{#if isEditingImageURL}} {{view App.EditTextView class="editImageURL" valueBinding="portraitURL"}}{{else}}<img {{action "editImage" on="doubleClick"}} {{bindAttr src="portraitURL"}} alt="" class="">{{/if}}{{#if isEditing}}
              {{view App.EditTextView valueBinding="name"}}
            {{else}}<h1 class="">
              {{name}}
            </h1>{{/if}}
      </div>
      {{#if isEditing}}
        <div class="editButtons"><button {{action 'saveCharacter'}} class="icon-ok"></button></div>
      {{else}}
        <div class="editButtons"><button {{action 'editCharacter'}} class="icon-pencil"></button> <button {{action 'deleteCharacter'}} class="icon-cancel"></button></div>
      {{/if}}
    </header>
    

    
  </script>

  <script type="text/x-handlebars" data-template-name="_generalSkills">
    <h2>General Skills</h2>
    <table class="">
      <thead>
        <tr>
          <td class="col1">Skill</td>
          <td class="col2 adjustRank"></td>
          <td class="col3">Rank</td>
          <td class="col4">Dice Pool</td>
        </tr>
      </thead>
      <tbody>
        {{#each rank in generalSkills}}
          {{control "rank" rank}}
        {{/each}}
      </tbody>
    </table>
  </script>

  <script type="text/x-handlebars" data-template-name="rank">
    <tr><td class="col1">{{skill.name}}</td><td class="col2"> <button {{action 'adjustRank' -1}}>[-]</button>  <button {{action 'adjustRank' 1}}>[+]</button></td><td class="col3">{{rank.rank}}</td><td class="col4">{{dice dicePool}}</td></tr>
  </script>

  <script type="text/x-handlebars" data-template-name="weapon">
    <tr>
      <td class="col1">{{#if isEditing}}{{view App.EditTextView valueBinding="name"}} <button {{action 'deleteItem'}}>[x]</button>{{else}}<button {{action "editItem" on="doubleClick"}}>{{name}}</button>{{/if}}</td>
      <td class="col2">{{#if isEditing}}{{view App.EditTextView valueBinding="id"}}{{else}}<button {{action "editItem" on="doubleClick"}}>{{id}}</button>{{/if}}</td>
      <td class="col3">{{#if isEditing}}{{view App.EditTextView valueBinding="damage"}}{{else}}<button {{action "editItem" on="doubleClick"}}>{{damage}}</button>{{/if}}</td>
      <td class="col4">{{#if isEditing}}{{view App.EditTextView valueBinding="range"}}{{else}}<button {{action "editItem" on="doubleClick"}}>{{range}}</button>{{/if}}</td>
      <td class="col5">{{#if isEditing}}{{view App.EditTextView valueBinding="crit"}}{{else}}<button {{action "editItem" on="doubleClick"}}>{{crit}}</button>{{/if}}</td> 
      <td class="col6">{{#if isEditing}}{{view App.EditTextView valueBinding="special"}}{{else}}<button {{action "editItem" on="doubleClick"}}>{{special}}</button>{{/if}}</td>
    </tr>
  </script>

  <script type="text/x-handlebars" data-template-name="armor">
    <tr>
      <td class="itemName col1">{{#if isEditing}}{{view App.EditTextView valueBinding="name"}} <button {{action 'deleteItem'}}>[x]</button>{{else}}<button {{action "editItem" on="doubleClick"}}>{{name}}</button>{{/if}}</td>
      <td class="armorStats col2">{{#if isEditing}}{{view App.EditTextView valueBinding="stats"}}{{else}}<button {{action "editItem" on="doubleClick"}}>{{stats}}</button>{{/if}}</td>
    </tr>   
  </script>

  <script type="text/x-handlebars" data-template-name="inventoryItem">
    <tr>
      <td class="itemName col1">{{#if isEditing}}{{view App.EditTextView valueBinding="name"}} <button {{action 'deleteItem'}}>[x]</button>{{else}}<button {{action "editItem" on="doubleClick"}}>{{name}}</button>{{/if}}</td>
      <td class="itemStats col2">{{#if isEditing}}{{view App.EditTextView valueBinding="description"}} <button {{action 'deleteItem'}}>[x]</button>{{else}}<button {{action "editItem" on="doubleClick"}}>{{description}}</button>{{/if}}</td>
    </tr>   
  </script>

  <script type="text/x-handlebars" data-template-name="criticalInjury">
    <tr>
      <td class="col1">{{#if isEditing}}{{view App.EditTextView valueBinding="injury"}} <button {{action 'deleteItem'}}>[x]</button>{{else}}<button {{action "editItem" on="doubleClick"}}>{{injury}}</button>{{/if}}</td>
      <td class="col2">{{#if isEditing}}{{view App.EditTextView valueBinding="severity"}} {{else}}<button {{action "editItem" on="doubleClick"}}>{{severity}}</button>{{/if}}</td>
      <td class="col3">{{#if isEditing}}{{view App.EditTextView valueBinding="result"}} {{else}}<button {{action "editItem" on="doubleClick"}}>{{result}}</button>{{/if}}</td>
    </tr>
  </script>

<script type="text/x-handlebars" data-template-name="xp">
  <tr>
    <td class="col1">{{#if isEditing}}{{view App.EditTextView valueBinding="source"}} <button {{action 'deleteItem'}}>[x]</button>{{else}}<button {{action "editItem" on="doubleClick"}}>{{source}}</button>{{/if}}</td>
    <td class="col2">{{#if isEditing}}{{view App.EditTextView valueBinding="amount"}} {{else}}<button {{action "editItem" on="doubleClick"}}>{{amount}}</button>{{/if}}</td>
  </tr>
</script>

<script type="text/x-handlebars" data-template-name="motivation">
    <tr>
      <td class="col1">{{#if isEditing}}{{view App.EditTextView valueBinding="motivation"}} <button {{action 'deleteItem'}}>[x]</button>{{else}}<button {{action "editItem" on="doubleClick"}}>{{motivation}}</button>{{/if}}</td>
      <td class="col2">{{#if isEditing}}{{view App.EditTextView valueBinding="description"}} {{else}}<button {{action "editItem" on="doubleClick"}}>{{description}}</button>{{/if}}</td>
    </tr>
</script>

<script type="text/x-handlebars" data-template-name="obligation">
    <tr>
      <td class="col1">{{#if isEditing}}{{view App.EditTextView valueBinding="type"}} <button {{action 'deleteItem'}}>[x]</button>{{else}}<button {{action "editItem" on="doubleClick"}}>{{type}}</button>{{/if}}</td>
      <td class="col2">{{#if isEditing}}{{view App.EditTextView valueBinding="magnitude"}} {{else}}<button {{action "editItem" on="doubleClick"}}>{{magnitude}}</button>{{/if}}</td>
      <td>{{#if isEditing}}{{view App.EditTextView valueBinding="details"}} {{else}}<button {{action "editItem" on="doubleClick"}}>{{details}}</button>{{/if}}</td>
    </tr>
</script>



 <script type="text/x-handlebars" data-template-name="_combatSkills">
    <h2>Combat Skills</h2>
    <table class="">
     <thead>
       <tr>
         <td class="col1">Skill</td>
          <td class="col2 adjustRank"></td>
          <td class="col3">Rank</td>
          <td class="col4">Dice Pool</td>
       </tr>
     </thead>
     <tbody>
        {{#each rank in combatSkills}}
          {{control "rank" rank}}
        {{/each}}
     </tbody>
    </table>
  </script>
  <script type="text/x-handlebars" data-template-name="_knowledgeSkills">
    <h2>Knowledge Skills</h2>
    <table class="">
      <thead>
       <tr>
          <td class="col1">Skill</td>
          <td class="col2 adjustRank"></td>
          <td class="col3">Rank</td>
          <td class="col4">Dice Pool</td>
       </tr>
     </thead>
     <tbody>
        {{#each rank in knowledgeSkills}}
         {{control "rank" rank}}
        {{/each}}
     </tbody>
    </table>
    <!--<h2>Custom Skills [+]</h2>
    <table class="">
      <thead>
       <tr>
         <td class="col1">Skill</td>
         <td class="col2">Rank</td>
       </tr>
     </thead>
     <tbody>
       {{#each rank in customSkills}}
          {{control "rank" rank}}
        {{/each}}
     </tbody>
    </table>-->
  </script>

    <!--
    <div class="campaign span12">
      <section class="group">
        <section class="characters">                  
        </section>
        <section class="baseOfOperations"></section>
        <section class="groupObligation"></section>
        <section class="groupResources">
          <section class="groupContacts"></section>
          <section class="groupPosessions"></section>
        </section>
        <section class="groupDestinyPool"></section>
      </section>
      <section class="vehicle"></section>
      <section class="notes"></section>
    </div>
    -->
  <script type='application/javascript'>
      ENV = {
          EXPERIMENTAL_CONTROL_HELPER: true
      };
  </script>
  <script src="js/libs/jquery-1.9.1.js"></script>
  <script src="js/libs/handlebars-1.0.0-rc.4.js"></script>
  <script src="js/libs/ember-1.0.0-rc.6.js"></script>
  <script src="js/libs/ember-data-0.13.js"></script>
  <script src="js//libs/localstorage_adapter.js"></script>
  <script src="js/app.js"></script>
  <script src="js/router.js"></script>
  <script src="js/item.js"></script>
  <script src="js/character.js"></script>
  <script src="js/characters.js"></script>
  <script src="js/obligation.js"></script>
  <script src="js/motivation.js"></script>
  <script src="js/xp.js"></script>
  <script src="js/criticalInjury.js"></script>
  <script src="js/armor.js"></script>
  <script src="js/weapon.js"></script>
  <script src="js/inventoryItem.js"></script>
  <script src="js/rank.js"></script>
  <script src="js/skill.js"></script>
  <script src="js/skills.js"></script>
  <script src="js/ranks.js"></script>
  <script src="js/index.js"></script>
  <script src="js/fixtures.js"></script>
  <script src="js/hbHelpers.js"></script>





</body>
</html>
