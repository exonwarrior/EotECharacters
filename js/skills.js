App.SkillsRoute = Ember.Route.extend({
	model: function(){
		return App.Skill.find();
	}
});

App.SkillsController = Ember.ArrayController.extend({
	
});

App.skillsArray = [
{
	id: 1,
	name: "Astrogation (Int)",
	description: "",
	type: 1,
	characteristic: "intellect"
},
{
	id: 2,
	name: "Athletics (Br)",
	description: "",
	type: 1,
	characteristic: "brawn"
},
{
	id: 3,
	name: "Charm (Pr)",
	description: "",
	type: 1,
	characteristic: "presence"
},
{
	id: 4,
	name: "Coercion (Will)",
	description: "",
	type: 1,
	characteristic: "willpower"
},
{
	id: 5,
	name: "Computers (Int)",
	description: "",
	type: 1,
	characteristic: "intellect"
},
{
	id: 6,
	name: "Cool (Pr)",
	description: "",
	type: 1,
	characteristic: "presence"
},
{
	id: 7,
	name: "Coordination (Ag)",
	description: "",
	type: 1,
	characteristic: "agility"
},
{
	id: 8,
	name: "Deception (Cun)",
	description: "",
	type: 1,
	characteristic: "cunning"
},
{
	id: 9,
	name: "Discipline (Will)",
	description: "",
	type: 1,
	characteristic: "willpower"
},
{
	id: 10,
	name: "Leadership (Pr)",
	description: "",
	type: 1,
	characteristic: "presence"
},
{
	id: 11,
	name: "Mechanics (Int)",
	description: "",
	type: 1,
	characteristic: "intellect"
},
{
	id: 12,
	name: "Medicine (Int)",
	description: "",
	type: 1,
	characteristic: "intellect"
},
{
	id: 13,
	name: "Negotiation (Pr)",
	description: "",
	type: 1,
	characteristic: "presence"
},
{
	id: 14,
	name: "Perception (Cun)",
	description: "",
	type: 1,
	characteristic: "cunning"
},
{
	id: 15,
	name: "Piloting - Planetary (Ag)",
	description: "",
	type: 1,
	characteristic: "agility"
},
{
	id: 16,
	name: "Piloting - Space (Ag)",
	description: "",
	type: 1,
	characteristic: "agility"
},
{
	id: 17,
	name: "Resilience (Br)",
	description: "",
	type: 1,
	characteristic: "brawn"
},
{
	id: 18,
	name: "Skulduggery (Cun)",
	description: "",
	type: 1,
	characteristic: "cunning"
},
{
	id: 19,
	name: "Stealth (Ag)",
	description: "",
	type: 1,
	characteristic: "agility"
},
{
	id: 20,
	name: "Streetwise (Cun)",
	description: "",
	type: 1,
	characteristic: "cunning"
},
{
	id: 21,
	name: "Survival (Cun)",
	description: "",
	type: 1,
	characteristic: "cunning"
},
{
	id: 22,
	name: "Vigilance (Will)",
	description: "",
	type: 1,
	characteristic: "willpower"
},
{
	id: 23,
	name: "Brawl (Br)",
	description: "",
	type: 2,
	characteristic: "brawn"
},
{
	id: 24,
	name: "Gunnery (Ag)",
	description: "",
	type: 2,
	characteristic: "agility"
},
{
	id: 25,
	name: "Melee (Br)",
	description: "",
	type: 2,
	characteristic: "brawn"
},
{
	id: 26,
	name: "Ranged - Light (Ag)",
	description: "",
	type: 2,
	characteristic: "agility"
},
{
	id: 27,
	name: "Ranged - Heavy (Ag)",
	description: "",
	type: 2,
	characteristic: "agility"
},
{
	id: 28,
	name: "Core Worlds (Int)",
	description: "",
	type: 3,
	characteristic: "intellect"
},
{
	id: 29,
	name: "Education (Int)",
	description: "",
	type: 3,
	characteristic: "intellect"
},
{
	id: 30,
	name: "Lore (Int)",
	description: "",
	type: 3,
	characteristic: "intellect"
},
{
	id: 31,
	name: "Outer Rim (Int)",
	description: "",
	type: 3,
	characteristic: "intellect"
},
{
	id: 32,
	name: "Underworld (Int)",
	description: "",
	type: 3,
	characteristic: "intellect"
},
{
	id: 33,
	name: "Xenology (Int)",
	description: "",
	type: 3,
	characteristic: "intellect"
}
];


