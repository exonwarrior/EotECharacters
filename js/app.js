var App = Ember.Application.create();

App.Router.map(function(){
	this.resource('characters',function(){
		this.resource('character',{path: ':character_id'});
	});
});

// App.Store = DS.Store.extend({
// 	revision: 13,
// 	adapter: 'DS.FixtureAdapter'
// });

App.Store = DS.Store.extend({
  revision: 12,
  adapter: 'App.LSAdapter',
  init: function(){
    this._super();
    var self = this;
    App.skillsArray.forEach(function(item, index){
      var newSkill = App.Skill.createRecord(item);
      newSkill.save();
    });
  }
});

/*App.Store.registerAdapter('App.Skill', DS.FixtureAdapter.extend({
  queryFixtures: function(fixtures, query, type) {
      return fixtures.filter(function(item) {
          var match = true;
          for(var prop in query) {
              if( item[prop] != query[prop]) {
                   match = false;
              }
          }
          return match;
      });
  }
}));*/



App.EditTextView = Ember.TextField.extend({
  insertNewline: function () {
    console.log(this);
    this.get('controller').acceptChanges();
  },
  classNames: ["edit"],
});

App.CharacteristicView = Ember.TextField.extend({
  type: 'number',
  attributeBindings: ['min', 'max', 'step'],
  keyUp: function(){
    if(this.get('value') > 6){
      this.set('value', 6);
    }
  },
  classNames: ["edit"]
});

App.LSAdapter = DS.LSAdapter.extend({
  namespace: 'dossie-emberjs'
});



/*//// Stub data store fixture adapter ///////
App.Store = DS.Store.extend({
    revision: 12,
    //adapter: 'DS.RESTAdapter',
    adapter: DS.FixtureAdapter.extend({
        queryFixtures: function(fixtures, query, type) {
            console.log(query);
            console.log(type);
            return fixtures.filter(function(item) {
                for(var prop in query) {
                    if( item[prop] != query[prop]) {
                        return false;
                    }
                }
                return true;
            });
        }
    })
});*/