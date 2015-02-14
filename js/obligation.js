App.Obligation = DS.Model.extend({
	type: DS.attr('string'),
	magnitude: DS.attr('number'),
	details: DS.attr('string'),
	character: DS.belongsTo('App.Character')
});

App.ObligationController = App.ItemController.extend({
	
});

App.register('controller:obligation', App.ObligationController, {singleton: false});