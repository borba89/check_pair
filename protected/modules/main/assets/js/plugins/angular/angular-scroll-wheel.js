(function() {
	angular.module('ngWheel', []).directive('ngWheel', ['$parse', function($parse) {
		return function(scope, element, attr) {
			var fn = $parse(attr.ngWheel);

			element.bind('mousewheel DOMMouseScroll', function(event) {
				if (event.type == 'mousewheel') {
					scope.$apply(function() {
						fn(scope, {
							$event: event.originalEvent.deltaY
						});
					});
				}
				else if (event.type == 'DOMMouseScroll') {
					scope.$apply(function() {
						fn(scope, {
							$event: event.originalEvent.detail
						});
					});
				}
			});
		};
	}]);

}.call(this));