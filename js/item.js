App.Item = DS.Model.extend({
	
});

App.ItemController = Ember.ObjectController.extend({
	editItem: function(){
		this.set('isEditing', 'true');
	},
	acceptChanges: function(){
		this.set('isEditing', false);
		this.get('store').commit();
	},
	deleteItem: function(){
		var item = this.get('model');
		item.deleteRecord();
		this.get('store').commit();
	}
});