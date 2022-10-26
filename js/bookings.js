const requestTimeSlots = async () => {

	const response = await fetch('/json/timeslots/all');

	const responseJson = await response.json();

	return responseJson;
}

function updateHourInput(dateInput, availableTimeSlots) {

	var bookingHourInput = document.querySelector('#book-hour');

	var dateObj = new Date(dateInput + ' 00:00:00');

	//Clear the hour input to add dynamic options
	for (const option of document.querySelectorAll('#book-hour > option')) {
		option.remove();
	}
	
	const timeOptions = availableTimeSlots[dateInput];

	var openSlotsAvailable = false;

	if (timeOptions !== undefined) {

		
		for (var option in timeOptions) {

			var l10nKeyStrings = {
				'1030-1100': '10:30am - 11:00am',
				'1100-1130': '11:00am - 11:30am',
				'1130-1200': '11:30am - 12:00pm',
				'1200-1230': '12:00pm - 12:30pm',
				'1300-1330': '1:00pm - 1:30pm',
				'1330-1400': '1:30pm - 2:00pm',
				'1400-1430': '2:00pm - 2:30pm',
				'1430-1500': '2:30pm - 3:00pm',
				'1500-1530': '3:00pm - 3:30pm',
				'1530-1600': '3:30pm - 4:00pm',
				'1600-1630': '4:00pm - 4:30pm',
				'1630-1700': '4:30pm - 5:00pm',
				'1700-1730': '5:00pm - 5:30pm',
			}

			if (timeOptions[option] !== 0) {

				openSlotsAvailable = true;
				var optionLabel = option;

				if (l10nKeyStrings[option] !== undefined) {
					optionLabel = l10nKeyStrings[option];
				} 

				bookingHourInput.options[bookingHourInput.options.length] = new Option(optionLabel, option);
			}
		}
	}

	if (openSlotsAvailable === true) {
		updateDateLabel(dateObj, l10nKeyStrings[bookingHourInput.value]);
		document.querySelector('#booking-date-label').classList.remove('wpcf7-not-valid-tip');
	} else {
		document.querySelector('#booking-date-label').innerHTML = 'Sorry, there are no available times for <span class="is-style-font-regular">' + dateObj.toLocaleDateString('en-us', { weekday:"long", month:"long", day:"numeric"}) + '</span>. Please select another day.';
		document.querySelector('#booking-date-label').classList.add('wpcf7-not-valid-tip');
	}
}

function updateDateLabel(dateObj, hour) {

	var hourFields = hour.split(' ');
	
	var hourLabel = hourFields[0];

	var date = new Date();

	var timezone = 'EDT (UTC-4)';

	if (dateObj > new Date(date.getFullYear(), 10, 06) ) {
		timezone = 'EST (UTC-5)';
	}

	document.querySelector('#booking-date-label').innerHTML = 'Time selected:<br/><span class="is-style-font-regular">' + dateObj.toLocaleDateString('en-us', { weekday:"long", year:"numeric", month:"short", day:"numeric"}) + '</span>, at <span class="is-style-font-regular">' + hourLabel + '</span> ' + timezone;

}

document.addEventListener('DOMContentLoaded', async () => {
	
	const requestResponse = await requestTimeSlots(),
		availableTimeSlots = requestResponse.data[0];

	if (availableTimeSlots === undefined) {
		//add no timeslots available logic here later
	} else {

		var showBookingInput = document.querySelector('#show-booking input'),
		bookingDateInput = document.querySelector('#book-date'),
		bookingHourInput = document.querySelector('#book-hour');

		const firstAvailableDay = Object.keys(availableTimeSlots)[0],
		lastAvailableDay = Object.keys(availableTimeSlots)[Object.keys(availableTimeSlots).length - 1];

		bookingDateInput.min = firstAvailableDay;
		bookingDateInput.max = lastAvailableDay;

		if (!bookingDateInput.value) {
			bookingDateInput.value = firstAvailableDay;
		}

		updateHourInput(bookingDateInput.value, availableTimeSlots);

		bookingDateInput.addEventListener('input', function() {

			updateHourInput(this.value, availableTimeSlots);

		});

		bookingHourInput.addEventListener('input', function() {

			var l10nKeyStrings = {
				'1030-1100': '10:30am - 11:00am',
				'1100-1130': '11:00am - 11:30am',
				'1130-1200': '11:30am - 12:00pm',
				'1200-1230': '12:00pm - 12:30pm',
				'1300-1330': '1:00pm - 1:30pm',
				'1330-1400': '1:30pm - 2:00pm',
				'1400-1430': '2:00pm - 2:30pm',
				'1430-1500': '2:30pm - 3:00pm',
				'1500-1530': '3:00pm - 3:30pm',
				'1530-1600': '3:30pm - 4:00pm',
				'1600-1630': '4:00pm - 4:30pm',
				'1630-1700': '4:30pm - 5:00pm',
				'1700-1730': '5:00pm - 5:30pm',
			}

			var dateObj = new Date(bookingDateInput.value + ' 00:00:00');
			
			updateDateLabel(dateObj, l10nKeyStrings[this.value]);
		})
	}
});