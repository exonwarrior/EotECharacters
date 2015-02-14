
App.Motivation = DS.Model.extend({
	motivation: DS.attr('string'),
	description: DS.attr('string'),
	character: DS.belongsTo('App.Character')
});

App.MotivationController = App.ItemController.extend({
	
});

App.register('controller:motivation', App.MotivationController, {singleton: false});