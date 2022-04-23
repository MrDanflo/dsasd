"use strict"

document.addEventListener('DOMContentLoaded', function () {
	const form = document.getElementById('form');
	form.addEventListener('submit' formSend);

	async function formSend(e) {
		e.preventDefault();

		let error = formValidate(form);

		let formData = new FormData(form);

		if (error === 0) {
			let response = await fetch('sendNumber.php', {
				method: 'POST',
				body: formData
				});
				if (response.ok){
					let result = await response.json();
					alert(result.message);
					formPreview.innerHTML = '';
					fotm.reset();
				}else
			}
		} else {
			alert('')
		}
	}


	function formValidate(form) {
		let error = 0;
		let form__input = document.querySelectorAll('form__input');

		for (let index = 0; index < form__input.length; index++) {
			const input = form__input[index];
			formRemoveError(input);

			if (input.classList.contains('form__input')){
				if (numberTest(input)) {
					formAddError(input);
					error++;
				}
			}else if(input.getAttribute("type") === "checkbox" && input.checked === false) {
				formAddError(input);
				error++;
			}else{
				if (input.value === '') {
					formAddError(input);
					error++;
				}
			}
		}
	}
	function formAddError(input) {
		input.parentElement.classList.add('_error');
		input.classList.add('_error');
	}
	function formRemoveError(input) {
		input.parentElement.classList.remove('_error');
		input.classList.remove('_error');
	}

	function numberTest(input) {
		return /^\d[\d\(\)\ -]{4,14}\d$/.test(input.value);
	}
});