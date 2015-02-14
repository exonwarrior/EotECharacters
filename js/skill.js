App.Skill = DS.Model.extend({
	name: DS.attr('string'),
	description: DS.attr('string'),
	characteristic: DS.attr('string'),
	rank: DS.hasMany('App.Rank'),
	type: DS.attr('string')
});

App.SkillController = Ember.ObjectController.extend();