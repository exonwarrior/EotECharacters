App.Xp = DS.Model.extend({
	source: DS.attr('string'),
	amount: DS.attr('number'),
	character: DS.belongsTo('App.Character')
});


App.XpController = App.ItemController.extend({
	
});

App.register('controller:xp', App.XpController, {singleton: false});