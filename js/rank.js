App.register('controller:rank',App.RankController,{singleton: false });

App.Rank = DS.Model.extend({
	rank: DS.attr('number'),
	skill: DS.belongsTo('App.Skill'),
	character: DS.belongsTo('App.Character', {inverse: 'skills'}),
	weapons: DS.hasMany('App.Weapon')
});

App.RankController = Ember.ObjectController.extend({
	char: null,
	needs: "character",
	charBinding: "controllers.character",
	dicePool: function(){
		var attrib = this.get("char." + this.get("skill.characteristic"));
		var rank = this.get('rank');
		var largest = Math.max(attrib,rank);
		var smallest = Math.min(attrib,rank);
		var string = "";
		for(var a = 0; a<largest;a++){
			string += "a";
		}
		for(var p = 0; p<smallest;p++){
			string = string.replace("a","p");
		}
		return string;
	}.property('rank','skill.characteristic','char.cunning', 'char.brawn', 'char.agility', 'char.intellect', 'char.willpower', 'char.presence'),
	adjustRank: function(amount){
		console.log("Adjusting " + this.get('skill.name') + " by " + amount);
		var newRank = this.get('rank') + amount;
		if(newRank < 0 ){
			newRank = 0;
		}
		this.set('rank', newRank);
		this.get('model').save();
	}
});