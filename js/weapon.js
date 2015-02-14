App.Weapon = DS.Model.extend({
	name: DS.attr('string'),
	//skill: DS.belongsTo('App.Rank'),
	skill: DS.attr('string'),
	damage: DS.attr('string'),
	range: DS.attr('string'),
	crit: DS.attr('string'),
	special: DS.attr('string'),
	character: DS.belongsTo('App.Character')
});

App.WeaponController = App.ItemController.extend({
	
});

App.register('controller:weapon', App.WeaponController, {singleton: false});