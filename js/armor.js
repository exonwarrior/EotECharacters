App.Armor = DS.Model.extend({
	name: DS.attr('string'),
	stats: DS.attr('string'),
	character: DS.belongsTo('App.Character')
});

App.ArmorController = App.ItemController.extend({
	
});

App.register('controller:armor', App.ArmorController, {singleton: false});