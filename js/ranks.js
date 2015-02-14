App.RanksRoute = Ember.Route.extend({
	model: function(){
		return App.Rank.find();
	}
});