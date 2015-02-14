App.Criticalinjury = DS.Model.extend({
	name: DS.attr('string'),
	severity: DS.attr('string'),
	result: DS.attr('string'),
	character: DS.belongsTo('App.Character'),
	isEditing: DS.attr('boolean')
});

App.CriticalInjuryController = App.ItemController.extend({
	
});

App.register('controller:criticalinjury', App.CriticalInjuryController, {singleton: false});