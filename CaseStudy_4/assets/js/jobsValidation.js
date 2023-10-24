console.log("jobsValidation.js working");

document.addEventListener("DOMContentLoaded", function () {
	const form = document.querySelector("form");
	form.addEventListener("submit", function (event) {
		// Validate the name field
		const nameInput = document.getElementById("name");
		const nameValue = nameInput.value;
		const namePattern = /^[A-Za-z\s]+$/;

		if (!namePattern.test(nameValue)) {
			alert("Invalid name format. Please use only alphabet characters and spaces.");
			event.preventDefault();
		}

		// Validate the email field
		const emailInput = document.getElementById("email");
		const emailValue = emailInput.value;
		const emailPattern = /^[a-zA-Z0-9.-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$/;

		if (!emailPattern.test(emailValue)) {
			alert("Invalid email format. Please make sure it contains a user name part follows by “@” and a domain name part.");
			event.preventDefault();
		}

		// Validate the start date
		const startDateInput = document.getElementById("startDate");
		const selectedDate = new Date(startDateInput.value);
		const currentDate = new Date();

		if (selectedDate <= currentDate) {
			alert("Start date cannot be today or in the past.");
			event.preventDefault();
		}
	});
});


