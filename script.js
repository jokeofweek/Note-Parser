function hideStatus(status){
	comb('.' + status, function(e){
		e.style.display = 'none';
	});
}

function showStatus(status){
	comb('.' + status, function(e){
		e.style.display = '';
	});
}

function statusToggle(element, caption, status){
	if (element.innerHTML === 'Show ' + caption){
		showStatus(status);
		element.innerHTML = 'Hide ' + caption;
	} else {
		hideStatus(status);
		element.innerHTML = 'Show ' + caption;
	}
	return false;
}

function toggleList(element){
	var e = comb('#' + element.childNodes[0].innerHTML + '-list')[0];
	if (e.style.display === ''){
		e.style.display = 'none';
		element.childNodes[0].className = 'hidden';
	} else {
		e.style.display = '';
		element.childNodes[0].className = '';
	}
}

function init(){
	comb('#task-done-visible', function(e){e.onclick = function(){statusToggle(e, 'Finished Tasks', 'task-done');};});
	comb('#task-progress-visible', function(e){e.onclick = function(){statusToggle(e, 'Tasks In Progress', 'task-progress');};});
	comb('#task-todo-visible', function(e){e.onclick = function(){statusToggle(e, 'Tasks To Do', 'task-todo');};});
	comb('#note-visible', function(e){e.onclick = function(){statusToggle(e, 'Notes', 'note');};});
	comb('.list-header', function(e){e 	.onclick = function(){toggleList(e);};});
}

window.onload = init;