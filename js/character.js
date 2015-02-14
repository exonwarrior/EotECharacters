App.CharacterController = Ember.ObjectController.extend({
	needs: ['skill'],
	totalXP: function(){
		return this.get('xp').getEach('amount').reduce(function(accum,item) {
			return parseInt(accum) + parseInt(item);
		},0);
	}.property('xp.@each.amount'),
	editCharacter: function(){
		this.set('isEditing', true);
		this.set('isEditingImageURL', true);
	},
	editImage: function(){
		this.set('isEditingImageURL', true);
	},
	acceptChanges: function(){
		this.saveCharacter();
	},
	saveCharacter: function(){
		if(this.get('portraitURL') == "<portrait url>"){
			this.set('portraitURL', "http://placekitten.com/200/200");
		}
		this.set('isEditing', false);
		this.set('isEditingImageURL', false);
		this.get('model').save();
	},
	deleteCharacter: function(){
		var character = this.get('model');
		character.deleteRecord();
		character.save();
		this.transitionToRoute('characters');
	},
	baseSoak: function(){
		return this.get('brawn');
	}.property('brawn'),
	currentSoak: function(){
		return parseInt(this.get('baseSoak')) + parseInt(this.get('soakMod'));
	}.property('baseSoak', 'soakMod'),
	addToSoak: function(amount){
		var newSoakMod = this.get('soakMod') + amount;
		if(newSoakMod === 0){
			this.set('soakModded', false);
		}
		else if(newSoakMod < 0){
			this.set('soakModded', true);
			this.set('soakModdedPref', '');
		}
		else{
			this.set('soakModded', true);
			this.set('soakModdedPref', '+');
		}
		this.set('soakMod', newSoakMod);
		try{this.get('model').save();}
		catch(error){console.log(error.message);}
	},
	addDice: function(amount, type){
		var current = this.get('boostSetbackDice');
		var newCurrent = "";
		if(parseInt(current.length) + amount <= 6){
			if(amount > 0){
				for(var i = 0; i < amount; i++){
					//find the first instance of this letter
					var index = current.indexOf(type);
					if(index == -1){
						index = 0;
					}
					//split the string into two parts, before that letter, and after that letter (including that letter)
					var firstPart = current.substr(0, index);
					var secondPart = current.substr(index);
					//insert the new letter between
					newCurrent = firstPart + type + secondPart;
				}
			}
			else if(amount < 0){
				for(var i = 0; i > amount; i--){
					//find and replace one instance of the character
					newCurrent = current.replace(new RegExp(type), '');
				}
			}
			this.set('boostSetbackDice', newCurrent);
			this.get('model').save();
		}
	},
	addToStat: function(stat, amount){
		var current = this.get(stat);
		var newValue = current + amount;
		this.set(stat, newValue);
		this.get('model').save();
	},
	createWeapon: function(){
		var newWeapon = this.get('weapons').createRecord({
			isEditing: true,
			name: "<name>",
			damage: "<damage>",
			range: "<range>",
			crit: "<crit>",
			special: "<special>",
			skill: "<skill>"
		});
		console.log(newWeapon.get('id'));
	},
	createArmor: function(){
		var newArmor = this.get('armor').createRecord({
			isEditing: true,
			name: "<name>",
			stats: "<stats>"
		});
	},
	createInventoryItem: function(){
		console.log("HI");
		var newItem = this.get('inventory').createRecord({
			isEditing: true,
			name: "<name>",
			description: "<description>"
		});
	},
	createCriticalInjury: function(){
		var newInjury = this.get('criticalInjuries').createRecord({
			isEditing: true,
			injury: "<injury>",
			severity: "<severity>",
			result: "<result>"
		});
	},
	createXPItem: function(){
		var newXPItem = this.get('xp').createRecord({
			isEditing: true,
			source: "<source>",
			amount: "0"
		});
	},
	createMotivation: function(){
		var newMotivation = this.get('motivation').createRecord({
			isEditing: true,
			motivation: "<motivation>",
			description: "<description>" 
		});
	},
	createObligation: function(){
		var newObligation = this.get('obligation').createRecord({
			isEditing: true,
			type: "<type>",
			magnitude: "<magnitude>",
			details: "<details>"
		});
	}
});


App.Character = DS.Model.extend({
  editingImageURL: DS.attr('boolean'),
  species: DS.attr('string'),
  career: DS.attr('string'),
  gender: DS.attr('string'),
  age: DS.attr('string'),
  height: DS.attr('string'),
  hair: DS.attr('string'),
  eyes: DS.attr('string'),
  notableFeatures: DS.attr('string'),
  build: DS.attr('string'),
  playerName: DS.attr('string'),
  name: DS.attr('string'),
  woundsCurrent: DS.attr('number'),
  woundsThreshold: DS.attr('number'),
  strainCurrent: DS.attr('number'),
  strainThreshold: DS.attr('number'),
  defenseMelee: DS.attr('number'),
  defenseRanged: DS.attr('number'),
  boostSetbackDice: DS.attr('string'),
  brawn: DS.attr('number'),
  agility: DS.attr('number'),
  intellect: DS.attr('number'),
  cunning: DS.attr('number'),
  willpower: DS.attr('number'),
  presence: DS.attr('number'),
  portraitURL: DS.attr('string'),
  skills: DS.hasMany('App.Rank'),
  generalSkills: DS.hasMany('App.Rank'),
  combatSkills: DS.hasMany('App.Rank'),
  knowledgeSkills: DS.hasMany('App.Rank'),
  credits: DS.attr('number'),
  inventory: DS.hasMany('App.InventoryItem'),
  weapons: DS.hasMany('App.Weapon'),
  armor: DS.hasMany('App.Armor'),
  criticalInjuries: DS.hasMany('App.Criticalinjury'),
  xp: DS.hasMany('App.Xp'),
  availableXP: DS.attr('number'),
  motivation: DS.hasMany('App.Motivation'),
  obligation: DS.hasMany('App.Obligation'),
  soakMod: DS.attr('number'),
  soakModded: DS.attr('boolean'),
  soakModdedPref: DS.attr('string')
});