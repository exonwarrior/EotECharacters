Ember.Handlebars.helper('dice',function(value,options) {
	var string = "";
	var diceURLs = {
		p : "img/dice/proficiencyDie.png",
		a : "img/dice/abilityDie.png",
		d : "img/dice/difficultyDie.png",
		c : "img/dice/challengeDie.png",
		b : "img/dice/boostDie.png",
		s : "img/dice/setbackDie.png",
		f : "img/dice/forceDie.png"
	};
	try{
		var array = value.split("");
			for(var i = 0; i < array.length; i++){
			var item = array[i];
			array[i] = "<img src='"+ diceURLs[item] +"' class='die'>";
		}
		return new Handlebars.SafeString('<span class="dicePool">'+array.join("")+'</span>');
	}
	catch(err){
		return "";
	}
	
});