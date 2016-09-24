(function() {
	function addEvent(obj, event_name, handler) {
		var handler_wrapper = function(event) {
			event = event || window.event;
			if (!event.target && event.srcElement) {
				event.target = event.srcElement;
			}
			return handler.call(obj, event);
		};

		if (obj.addEventListener) {
			obj.addEventListener(event_name, handler_wrapper, false);
		} else if (obj.attachEvent) {
			obj.attachEvent('on' + event_name, handler_wrapper);
		}
		return handler_wrapper;
	}
	if (document.body.clientWidth <= '768') {
		document.querySelector('.logo').innerHTML = '<a href="./index.php?controller=static&page=my-tasks">My Tasks</a>';
	}
	addEvent(
			window,
			'resize',
			function(e) {
				if (document.querySelector('.logo')) {
					console.log(document.body.clientWidth + 15);
					if (document.body.clientWidth <= '768') {
						document.querySelector('.logo').innerHTML = '<a href="./index.php?controller=static&page=my-tasks">My Tasks</a>';
					} else {
						document.querySelector('.logo').innerHTML = '<a href="./index.php?controller=static&page=my-tasks"><img src="./view/default/img/logo.jpeg"></a>';
					}
				}
			});
	if (document.querySelector('.delete-task')) {
		for (var i = 0; i <= document.querySelectorAll('.delete-task').length - 1; i++) {
			addEvent(document.querySelectorAll('.delete-task')[i], 'click',
					function(e) {
						if (!confirm("You confirm removal?")) {
							e.preventDefault();
						}
					});
		}
	}
})();
