document.addEventListener("DOMContentLoaded", function(){

	const users_button = document.querySelectorAll('.option');
	const users_list =   document.querySelectorAll('.option-body')

	console.log(users_button);
	console.log(users_list);
for (let i = users_button.length - 1; i >= 0; i--) {
	users_button[i].addEventListener('click', function(){
		users_list[i].classList.toggle('unvisible');
		});
}


});
