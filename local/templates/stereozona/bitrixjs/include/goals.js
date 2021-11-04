var baseGoalsToReal = {
	"contacts_send": {
		page: "",
		realGoals: {
			google: {
				name: "contacts_send",
			},
			metrika: {
				name: "contacts_send"
			}
		}
	},
	"rassilka_send": {
		page: "",
		realGoals: {
			google: {
				name: "rassilka_send",
			},
			metrika: {
				name: "rassilka_send"
			}
		}
	},
	"oneclick_click": {
		page: "",
		realGoals: {
			google: {
				name: "oneclick_click",
			},
			metrika: {
				name: "oneclick_click"
			}
		}
	},
	"oneclick_send": {
		page: "",
		realGoals: {
			google: {
				name: "oneclick_send",
			},
			metrika: {
				name: "oneclick_send"
			}
		}
	},
	"korzina": {
		page: "",
		realGoals: {
			google: {
				name: "korzina",
			},
			metrika: {
				name: "korzina"
			}
		}
	},
	"zakaz_send": {
		page: "",
		realGoals: {
			google: {
				name: "zakaz_send",
			},
			metrika: {
				name: "zakaz_send"
			}
		}
	},
	"korzina_perehod": {
		page: "",
		realGoals: {
			google: {
				name: "korzina_perehod",
			},
			metrika: {
				name: "korzina_perehod"
			}
		}
	},
	"korzina_oform": {
		page: "",
		realGoals: {
			google: {
				name: "korzina_oform",
			},
			metrika: {
				name: "korzina_oform"
			}
		}
	},
	"korzina_oform2": {
		page: "",
		realGoals: {
			google: {
				name: "korzina_oform2",
			},
			metrika: {
				name: "korzina_oform2"
			}
		}
	},
	"izbran_click": {
		page: "",
		realGoals: {
			google: {
				name: "izbran_click",
			},
			metrika: {
				name: "izbran_click"
			}
		}
	},
	"sravn_click": {
		page: "",
		realGoals: {
			google: {
				name: "sravn_click",
			},
			metrika: {
				name: "sravn_click"
			}
		}
	},
	"akk": {
		page: "",
		realGoals: {
			google: {
				name: "akk",
			},
			metrika: {
				name: "akk"
			}
		}
	},
	"akk_vhod": {
		page: "",
		realGoals: {
			google: {
				name: "akk_vhod",
			},
			metrika: {
				name: "akk_vhod"
			}
		}
	},
	"akk_create": {
		page: "",
		realGoals: {
			google: {
				name: "akk_create",
			},
			metrika: {
				name: "akk_create"
			}
		}
	},
	"akk_reg": {
		page: "",
		realGoals: {
			google: {
				name: "akk_reg",
			},
			metrika: {
				name: "akk_reg"
			}
		}
	},
	"low_price_click": {
		page: "",
		realGoals: {
			google: {
				name: "low_price_click",
			},
			metrika: {
				name: "low_price_click"
			}
		}
	},
	"low_price_send": {
		page: "",
		realGoals: {
			google: {
				name: "low_price_send",
			},
			metrika: {
				name: "low_price_send"
			}
		}
	},
	"nalichie_click": {
		page: "",
		realGoals: {
			google: {
				name: "nalichie_click",
			},
			metrika: {
				name: "nalichie_click"
			}
		}
	},
	"nalichie_send": {
		page: "",
		realGoals: {
			google: {
				name: "nalichie_send",
			},
			metrika: {
				name: "nalichie_send"
			}
		}
	},
	"email_click": {
		page: "",
		realGoals: {
			google: {
				name: "email_click",
			},
			metrika: {
				name: "email_click"
			}
		}
	},
};


var goalsSender = (function(){
	var goalsToReal;
	var providers;
	var triggeredBaseEvents;

	var init;
	var registerEvent;
	var getRealGoals;
	var pushGoal;
	var addGoaltoActiveList;
	var getLastTriggeredBaseGoal;
	var getEventByDependiens;


	init = function(inGoalsToReal) {
		goalsToReal = inGoalsToReal;
		triggeredBaseEvents = [];

		var metrika = function(goalName) {
			if (typeof ym === 'function') {
				ym(71527723, 'reachGoal', goalName);
			}
			console.log('metrika-fire');
			console.log(goalName);
		}

		var google = function(goalName) {
			if (typeof gtag === 'function') {
				gtag('event', goalName);
			}
			console.log('google-fire');
			console.log(goalName);
		}

		providers = {
			'metrika' : metrika,
			'google' : google
		}
	}

	getLastTriggeredBaseGoal = function() {
		return triggeredBaseEvents.slice(-1)[0];
	}

	addGoaltoActiveList = function(baseGoalName){
		triggeredBaseEvents.push(baseGoalName);
	}

	getEventByDependiens = function(goalObject){
		var lastBaseEvent;
		lastBaseEvent = getLastTriggeredBaseGoal();

		if ((typeof lastBaseEvent !== 'string') ||
			(typeof goalObject.dependiens !== 'object') ||
			(typeof goalObject.dependiens[lastBaseEvent] !== 'string')
			)
			{
				return false;
		}

		return goalObject.dependiens[lastBaseEvent];
	}

	pushGoal = function(providerName, goal) {
		if (typeof providers[providerName] !== 'function') {
			return false;
		}
		providers[providerName](goal);
	}

	registerEvent = function(element) {
		var eventType;
		eventType = element.data('is-goal');

		element.on('click.metrics', function() {
			var baseGoalName = $(this).data('base-goal-name');
			var goals;

			goals = getRealGoals(baseGoalName);
			for (var goalProvider in goals) {
				var dependiensEvent;
				dependiensEvent = getEventByDependiens(goals[goalProvider]);
				if (dependiensEvent) {
					pushGoal(goalProvider, dependiensEvent);
				} else {
					pushGoal(goalProvider, goals[goalProvider].name);
				}
			}

			addGoaltoActiveList(baseGoalName);
		});
	}

	getRealGoals = function(baseGoalName) {
		if ((typeof goalsToReal[baseGoalName] === 'undefined') ||
			(typeof goalsToReal[baseGoalName].realGoals !== 'object')
		) {
			return false;
		}

		return goalsToReal[baseGoalName]['realGoals'];
	}

	return {
		init: init,
		registerEvent: registerEvent
	}
})();

var sendMetricGoals = function () {
	goalsSender.init(baseGoalsToReal);

	$( '*[data-is-goal]' ).unbind( 'click.metrics' );

	$('*[data-is-goal]').each(function() {
		goalsSender.registerEvent($(this));
	});
}

$(document).ready(sendMetricGoals);

document.addEventListener('swup: contentReplaced', sendMetricGoals);
