<x-layouts.student-app>
    <div class="bg-gray-100 rounded-lg shadow-xl w-1/2 max-w-1/2 mx-auto mt-10 p-10 h-auto relative">
        <form action="{{ route('booking.store', $lesson->id) }}" onsubmit="return validateMultipleSessionBooking(event)" method="POST" class="flex flex-col justify-between">
            @csrf

            {{-- Lesson Details Section --}}
            <div class="space-y-4 mb-6">
                <div class="flex flex-col rounded">
                    <h1 class="text-3xl font-semibold mb-2">{{ $lesson->title }}</h1>
                    <label class="text-md font-semibold mb-6">{{ $lesson->description }}</label>
                    <label class="text-md">Tutor: <span class="font-semibold">{{ $lesson->tutor->name }}</span></label>
                </div>
                <div class="flex flex-row gap-6">
                    <div class="flex items-center rounded w-auto">
                        <label>Price: ₱<span class="font-semibold">{{ $lesson->price }}</span></label>
                    </div>
                    <div class="flex items-center rounded w-auto">
                        <label>Total Duration (hours): <span class="font-semibold">{{ $lesson->duration }}</span></label>
                    </div>
                    <div class="flex items-center rounded w-auto">
                        <label>No. topics: <span class="font-semibold">{{ $lesson->topics }}</span></label>
                    </div>
                </div>
            </div>

            {{-- One Day Session Message --}}
            @php
                $canOneDaySession = $lesson->duration <= 8;
                $lessonDuration = $lesson->duration;
            @endphp

            @if($canOneDaySession)
                <div id="one-day-message" class="mb-4 bg-green-100 p-3 rounded-md">
                    <p class="text-green-800 font-semibold">
                        Session can be done in one day or choose multiple day session.
                    </p>
                </div>
            @endif

            {{-- Booking Options --}}
            <div class="space-y-4 mb-6" id="booking-options">
                <div class="flex space-x-4">
                    @if($canOneDaySession)
                        <label class="flex items-center">
                            <input type="radio"
                                   name="booking_method"
                                   value="one_day"
                                   class="mr-2"
                                   onchange="toggleBookingMethod('one_day')">
                            Finish in One Day
                        </label>
                    @endif
                    <label class="flex items-center">
                        <input type="radio"
                               name="booking_method"
                               value="multiple_sessions"
                               class="mr-2"
                               onchange="toggleBookingMethod('multiple_sessions')">
                        Finish in Multiple Sessions/Days
                    </label>
                </div>
            </div>

            {{-- One Day Session Container --}}
            <div id="one-day-session-container" class="hidden space-y-4 mb-6">
                <div class="flex flex-col">
                    <label for="one_day_date" class="mb-2 font-semibold">Session Date</label>
                    <input type="date"
                           id="one_day_date"
                           name="one_day_date"
                           class="w-full p-2 border rounded-md"
                           min="{{ now()->format('Y-m-d') }}">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col">
                        <label for="morning_session" class="mb-2 font-semibold">Morning Session (8am - 12pm)</label>
                        <select
                            id="morning_session"
                            name="morning_session"
                            class="w-full p-2 border rounded-md"
                            onchange="updateRemainingHours('one_day')">
                            <!-- Morning time slots will be dynamically populated -->
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="afternoon_session" class="mb-2 font-semibold">Afternoon Session (1pm - 5pm)</label>
                        <select
                            id="afternoon_session"
                            name="afternoon_session"
                            class="w-full p-2 border rounded-md"
                            onchange="updateRemainingHours('one_day')">
                            <!-- Afternoon time slots will be dynamically populated -->
                        </select>
                    </div>
                </div>

                <div id="one-day-remaining-duration" class="mt-4 bg-blue-100 p-3 rounded-md hidden">
                    <p>Remaining Lesson Duration: <span id="one_day_remaining_hours">0</span> hours</p>
                </div>
            </div>

            {{-- Multiple Sessions Container --}}
            <div id="multiple-sessions-container" class="hidden space-y-4 mb-2">
                <div id="sessions-list">
                    <!-- First session will be added here dynamically -->
                </div>


                <div id="total-remaining-duration" class="mt-4 bg-blue-100 p-3 rounded-md">
                    <p>Remaining Lesson Duration: <span id="total_remaining_hours">{{ $lesson->duration }}</span> hours</p>
                </div>

                <button type="button"
                        id="add-session-btn"
                        class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600"
                        onclick="addNewSession()">
                    Add Another Session
                </button>
            </div>

            {{-- Booking Buttons --}}
            <div class="flex flex-row justify-between">
                <button type="submit" class="bg-green-500 mr-2 text-white py-2 px-4 rounded-md hover:bg-green-600">
                    Confirm Booking
                </button>
                <a href="/topics" class="bg-white text-black py-2 px-4 border rounded-md hover:bg-gray-200">
                    Close
                </a>
            </div>
        </form>
    </div>

    <script>
    const totalLessonDuration = {{ $lesson->duration }};
    const lessonDuration = {{ $lessonDuration }};
    let totalRemainingHours = totalLessonDuration;
    let sessionCounter = 0;

    // Morning time slots
    const morningTimeSlots = [
    {label: '8:00am - 9:00am', value: 1},
    {label: '8:00am - 10:00am', value: 2},
    {label: '8:00am - 11:00am', value: 3},
    {label: '8:00am - 12:00pm', value: 4},
    {label: '9:00am - 10:00am', value: 1},
    {label: '9:00am - 11:00am', value: 2},
    {label: '9:00am - 12:00pm', value: 3},
    {label: '10:00am - 11:00am', value: 1},
    {label: '10:00am - 12:00pm', value: 2},
    {label: '11:00am - 12:00pm', value: 1}
    ];

    const afternoonTimeSlots = [
    {label: '1:00pm - 2:00pm', value: 1},
    {label: '1:00pm - 3:00pm', value: 2},
    {label: '1:00pm - 4:00pm', value: 3},
    {label: '1:00pm - 5:00pm', value: 4},
    {label: '2:00pm - 3:00pm', value: 1},
    {label: '2:00pm - 4:00pm', value: 2},
    {label: '2:00pm - 5:00pm', value: 3},
    {label: '3:00pm - 4:00pm', value: 1},
    {label: '3:00pm - 5:00pm', value: 2},
    {label: '4:00pm - 5:00pm', value: 1}
    ];

    // Function to find valid time slot combinations
    function findValidTimeCombinations(totalDuration) {
        const validCombinations = [];

    // Iterate through morning and afternoon time slots
        morningTimeSlots.forEach(morningSlot => {
            afternoonTimeSlots.forEach(afternoonSlot => {
                if (morningSlot.value + afternoonSlot.value === totalDuration) {
                    validCombinations.push({
                    morning: morningSlot,
                    afternoon: afternoonSlot
                    });
                }
            });
        });

        return validCombinations;
    }

    // Initialize page
    document.addEventListener('DOMContentLoaded', function() {
    // Find valid time slot combinations for the lesson duration
    const validCombinations = findValidTimeCombinations(lessonDuration);

    // Dynamically populate time slots based on valid combinations
    populateTimeSlots('morning_session', 'afternoon_session', validCombinations);
    });

    function findValidTimeCombinations(totalDuration) {
        const validCombinations = [];

        // For 3 and 4-hour durations, we need more specific handling
        if (totalDuration === 3 || totalDuration === 4) {
            // Check for combinations that exactly match the lesson duration
            morningTimeSlots.forEach(morningSlot => {
                afternoonTimeSlots.forEach(afternoonSlot => {
                    // Ensure the combination exactly matches the total duration
                    if (morningSlot.value + afternoonSlot.value === totalDuration) {
                        validCombinations.push({
                            morning: morningSlot,
                            afternoon: afternoonSlot
                        });
                    }
                });
            });

            // If no split session works, allow single session options
            if (validCombinations.length === 0) {
                // Check morning slots
                morningTimeSlots.forEach(morningSlot => {
                    if (morningSlot.value === totalDuration) {
                        validCombinations.push({
                            morning: morningSlot,
                            afternoon: null
                        });
                    }
                });

                // Check afternoon slots
                afternoonTimeSlots.forEach(afternoonSlot => {
                    if (afternoonSlot.value === totalDuration) {
                        validCombinations.push({
                            morning: null,
                            afternoon: afternoonSlot
                        });
                    }
                });
            }
        } else {
            // Existing logic for other durations
            morningTimeSlots.forEach(morningSlot => {
                afternoonTimeSlots.forEach(afternoonSlot => {
                    if (morningSlot.value + afternoonSlot.value === totalDuration) {
                        validCombinations.push({
                            morning: morningSlot,
                            afternoon: afternoonSlot
                        });
                    }
                });
            });
        }

        return validCombinations;
    }

    function populateTimeSlots(morningSelectId, afternoonSelectId, validCombinations) {
        const morningSelect = document.getElementById(morningSelectId);
        const afternoonSelect = document.getElementById(afternoonSelectId);

        // Clear existing options
        morningSelect.innerHTML = '<option value="">Select Time Slot</option>';
        afternoonSelect.innerHTML = '<option value="">Select Time Slot</option>';

        // For 3 or 4 hour lessons, special handling
        if (lessonDuration === 3 || lessonDuration === 4) {
            // Populate ALL morning time slots
            morningTimeSlots.forEach(slot => {
                const option = document.createElement('option');
                option.value = slot.value;
                option.textContent = slot.label;

                // Disable options that exceed lesson duration
                option.disabled = slot.value > lessonDuration;

                morningSelect.appendChild(option);
            });

            // Populate ALL afternoon time slots
            afternoonTimeSlots.forEach(slot => {
                const option = document.createElement('option');
                option.value = slot.value;
                option.textContent = slot.label;

                // Disable options that exceed lesson duration
                option.disabled = slot.value > lessonDuration;

                afternoonSelect.appendChild(option);
            });

            // Event listener for morning slot selection
            morningSelect.addEventListener('change', function() {
                const selectedMorningValue = parseFloat(this.value || 0);

                // Clear and update afternoon slots
                afternoonSelect.innerHTML = '<option value="">Select Time Slot</option>';
                afternoonTimeSlots.forEach(slot => {
                    const option = document.createElement('option');
                    option.value = slot.value;
                    option.textContent = slot.label;

                    // Disable options that would make total duration incorrect
                    option.disabled = (selectedMorningValue + slot.value !== lessonDuration);

                    afternoonSelect.appendChild(option);
                });

                updateRemainingHours('one_day');
            });

            // Event listener for afternoon slot selection
            afternoonSelect.addEventListener('change', function() {
                const selectedAfternoonValue = parseFloat(this.value || 0);

                // Clear and update morning slots
                morningSelect.querySelectorAll('option').forEach(option => {
                    const morningValue = parseFloat(option.value);

                    // Disable options that would make total duration incorrect
                    option.disabled = (morningValue + selectedAfternoonValue !== lessonDuration);
                });

                updateRemainingHours('one_day');
            });
        } else {
            // Existing logic for duration > 4
            // Get all unique valid morning and afternoon values
            const validMorningValues = [...new Set(validCombinations.map(combo => combo.morning.value))];
            const validAfternoonValues = [...new Set(validCombinations.map(combo => combo.afternoon.value))];

            // Populate morning time slots with ALL options
            morningTimeSlots.forEach(slot => {
                const option = document.createElement('option');
                option.value = slot.value;
                option.textContent = slot.label;

                // Disable slots not in valid combinations
                option.disabled = !validMorningValues.includes(slot.value);

                morningSelect.appendChild(option);
            });

            // Add event listener to update afternoon slots when morning slot is selected
            morningSelect.addEventListener('change', function() {
                const selectedMorningValue = parseFloat(this.value);

                // Clear and populate afternoon slots
                afternoonSelect.innerHTML = '<option value="">Select Time Slot</option>';

                // Get valid afternoon slots for the selected morning slot
                const filteredAfternoonSlots = validCombinations
                    .filter(combo => combo.morning.value === selectedMorningValue)
                    .map(combo => combo.afternoon);

                // Populate all afternoon time slots
                afternoonTimeSlots.forEach(slot => {
                    const option = document.createElement('option');
                    option.value = slot.value;
                    option.textContent = slot.label;

                    // Disable slots not in valid combinations for the selected morning slot
                    option.disabled = !filteredAfternoonSlots.some(validSlot => validSlot.value === slot.value);

                    afternoonSelect.appendChild(option);
                });

                updateRemainingHours('one_day');
            });

            // Add event listener to afternoon select to update remaining hours
            afternoonSelect.addEventListener('change', function() {
                updateRemainingHours('one_day');
            });
        }
    }

    function populateMultipleSessionTimeSlots(morningSelect, afternoonSelect, remainingHours) {
        // Clear existing options
        morningSelect.innerHTML = '<option value="">Select Time Slot</option>';
        afternoonSelect.innerHTML = '<option value="">Select Time Slot</option>';

        // Populate morning time slots with special filtering
        morningTimeSlots.forEach(morningSlot => {
            const option = document.createElement('option');
            option.value = morningSlot.value;
            option.textContent = morningSlot.label;

            // Modify the filtering logic
            if (remainingHours <= 4) {
                // If remaining hours are 4 or less, only allow slots less than or equal to remaining hours
                option.disabled = morningSlot.value > remainingHours;
            } else {
                // For remaining hours > 4, allow morning slots less than remaining hours
                option.disabled = morningSlot.value >= remainingHours;
            }

            morningSelect.appendChild(option);
        });

        // Add event listener for morning slot selection in multiple sessions
        morningSelect.addEventListener('change', function() {
            const selectedMorningValue = parseFloat(this.value || 0);

            // Clear afternoon slots
            afternoonSelect.innerHTML = '<option value="">Select Time Slot</option>';

            // Populate afternoon time slots
            afternoonTimeSlots.forEach(afternoonSlot => {
                const option = document.createElement('option');
                option.value = afternoonSlot.value;
                option.textContent = afternoonSlot.label;

                // Modify the filtering logic for afternoon slots
                if (remainingHours <= 4) {
                    // If total selected time would exceed remaining hours, disable
                    option.disabled = (selectedMorningValue + afternoonSlot.value > remainingHours);
                } else {
                    // Disable afternoon slots that would make total duration equal to or exceed remaining hours
                    option.disabled = (selectedMorningValue + afternoonSlot.value >= remainingHours);
                }

                afternoonSelect.appendChild(option);
            });

            // Update remaining hours
            updateMultiSessionRemainingHours();
        });

        // Add event listener for afternoon slot
        afternoonSelect.addEventListener('change', function() {
            updateMultiSessionRemainingHours();
        });
    }

    // The rest of the script remains the same as in the previous implementation

    function toggleBookingMethod(method) {
        const oneDaySessionContainer = document.getElementById('one-day-session-container');
        const multipleSessionsContainer = document.getElementById('multiple-sessions-container');

        if (method === 'one_day') {
            oneDaySessionContainer.classList.remove('hidden');
            multipleSessionsContainer.classList.add('hidden');

            // Reset multiple sessions
            document.getElementById('sessions-list').innerHTML = '';
            sessionCounter = 0;

            // Reset total remaining hours
            document.getElementById('total_remaining_hours').textContent = totalLessonDuration;
        } else if (method === 'multiple_sessions') {
            oneDaySessionContainer.classList.add('hidden');
            multipleSessionsContainer.classList.remove('hidden');

            // Add first session automatically
            addNewSession();

            // Reset one-day session dropdowns
            document.getElementById('morning_session').selectedIndex = 0;
            document.getElementById('afternoon_session').selectedIndex = 0;
            document.getElementById('one-day-remaining-duration').classList.add('hidden');
        }
    }

    function updateMultiSessionRemainingHours() {
        let totalHoursUsed = 0;
        const sessionsContainer = document.getElementById('sessions-list');
        const sessions = sessionsContainer.querySelectorAll('.session-entry');
        const addSessionBtn = document.getElementById('add-session-btn');

        sessions.forEach(session => {
            const morningSessions = session.querySelector('[name="morning_sessions[]"]');
            const afternoonSessions = session.querySelector('[name="afternoon_sessions[]"]');

            totalHoursUsed += morningSessions ? parseFloat(morningSessions.value || 0) : 0;
            totalHoursUsed += afternoonSessions ? parseFloat(afternoonSessions.value || 0) : 0;
        });

        const remainingHours = Math.max(0, totalLessonDuration - totalHoursUsed);
        const remainingHoursDisplay = document.getElementById('total_remaining_hours');
        remainingHoursDisplay.textContent = remainingHours.toFixed(1);

        // Disable/enable Add Another Session button based on remaining hours
        if (remainingHours === 0) {
            addSessionBtn.disabled = true;
            addSessionBtn.classList.add('opacity-50', 'cursor-not-allowed');
        } else {
            addSessionBtn.disabled = false;
            addSessionBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        }

        return remainingHours;
    }

    function updateRemainingHours(type) {
    let remainingHours = totalLessonDuration;

    if (type === 'one_day') {
    const morningSession = parseFloat(document.getElementById('morning_session').value || 0);
    const afternoonSession = parseFloat(document.getElementById('afternoon_session').value || 0);

    remainingHours -= morningSession + afternoonSession;

    const remainingDurationDiv = document.getElementById('one-day-remaining-duration');
    const remainingHoursSpan = document.getElementById('one_day_remaining_hours');

    remainingHoursSpan.textContent = Math.max(0, remainingHours).toFixed(1);
    remainingDurationDiv.classList.remove('hidden');
    }
    }

    function addNewSession() {
        // Check if there are remaining hours
        const remainingHours = updateMultiSessionRemainingHours();

        // Prevent adding new session if no remaining hours
        if (remainingHours === 0) {
            return;
        }

        sessionCounter++;
        const sessionsList = document.getElementById('sessions-list');

        const sessionHtml = `
    <div class="session-entry border-2 border-gray-200 p-4 mb-4 rounded-md" id="session-${sessionCounter}">
        <div class="flex flex-col mb-4">
            <label for="session_date_${sessionCounter}" class="mb-2 font-semibold">Session ${sessionCounter} Date</label>
            <input type="date"
                   id="session_date_${sessionCounter}"
                   name="session_dates[]"
                   class="w-full p-2 border rounded-md"
                   min="{{ now()->format('Y-m-d') }}"
                   onchange="validateSessionDate(${sessionCounter})">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="flex flex-col">
                <label for="morning_session_${sessionCounter}" class="mb-2 font-semibold">Morning Session (8am - 12pm)</label>
                <select
                    id="morning_session_${sessionCounter}"
                    name="morning_sessions[]"
                    class="w-full p-2 border rounded-md morning-session-select"
                    onchange="updateMultiSessionRemainingHours()">
                    <option value="">Select Time Slot</option>
                </select>
            </div>
            <div class="flex flex-col">
                <label for="afternoon_session_${sessionCounter}" class="mb-2 font-semibold">Afternoon Session (1pm - 5pm)</label>
                <select
                    id="afternoon_session_${sessionCounter}"
                    name="afternoon_sessions[]"
                    class="w-full p-2 border rounded-md afternoon-session-select"
                    onchange="updateMultiSessionRemainingHours()">
                    <option value="">Select Time Slot</option>
                </select>
            </div>
        </div>
    </div>
    `;

        sessionsList.insertAdjacentHTML('beforeend', sessionHtml);

        // Populate time slots for the new session
        const morningSelect = document.getElementById(`morning_session_${sessionCounter}`);
        const afternoonSelect = document.getElementById(`afternoon_session_${sessionCounter}`);
        populateMultipleSessionTimeSlots(morningSelect, afternoonSelect, remainingHours);

        updateMultiSessionRemainingHours();
    }

    function generateTimeSlotOptions(sessionType, sessionDuration) {
    const validCombinations = findValidTimeCombinations(sessionDuration);
    const timeSlots = sessionType === 'morning' ? morningTimeSlots : afternoonTimeSlots;

    let optionsHtml = '<option value="">Select Time Slot</option>';
    const uniqueSlots = [...new Set(validCombinations.map(combo =>
    sessionType === 'morning' ? combo.morning : combo.afternoon
    ))];

    uniqueSlots.forEach(slot => {
    optionsHtml += `<option value="${slot.value}">${slot.label}</option>`;
    });

    return optionsHtml;
    }

    function removeSession(sessionCounter) {
        const sessionToRemove = document.getElementById(`session-${sessionCounter}`);
        sessionToRemove.remove();

        // Re-enable Add Another Session button if there are remaining hours
        updateMultiSessionRemainingHours();
    }

    function validateSessionDate(sessionCounter) {
        const currentSession = document.getElementById(`session_date_${sessionCounter}`);
        const allSessions = document.querySelectorAll('input[name="session_dates[]"]');

        const currentDate = new Date(currentSession.value);

        // Check if the date is before today
        const today = new Date();
        if (currentDate < today) {
            alert('Please select a date from today or in the future.');
            currentSession.value = '';
            return;
        }

        // Check for duplicate dates
        let duplicateDates = false;
        allSessions.forEach(session => {
            if (session.id !== currentSession.id && session.value === currentSession.value) {
                duplicateDates = true;
            }
        });

        if (duplicateDates) {
            alert('You cannot book multiple sessions on the same date.');
            currentSession.value = '';
        }
    }

    function validateMultipleSessionBooking(event) {
        // Determine the current booking method
        const oneDayMethod = document.querySelector('input[name="booking_method"][value="one_day"]').checked;
        const multipleSessionsMethod = document.querySelector('input[name="booking_method"][value="multiple_sessions"]').checked;

        // For one-day booking, validate time slots
        if (oneDayMethod) {
            const morningSession = document.getElementById('morning_session').value;
            const afternoonSession = document.getElementById('afternoon_session').value;

            // Ensure at least one time slot is selected
            if (!morningSession && !afternoonSession) {
                event.preventDefault();
                alert('Please select at least one time slot for the session.');
                return false;
            }

            // Verify total booked hours match lesson duration
            const morningValue = parseFloat(morningSession || 0);
            const afternoonValue = parseFloat(afternoonSession || 0);

            if (morningValue + afternoonValue !== lessonDuration) {
                event.preventDefault();
                alert(`Please book all ${lessonDuration} hours for the lesson.`);
                return false;
            }

            return true;
        }

        // For multiple sessions method, keep existing validation
        const remainingHoursElement = document.getElementById('total_remaining_hours');
        const remainingHours = parseFloat(remainingHoursElement.textContent);

        // Prevent booking if any hours remain unbooked
        if (remainingHours > 0) {
            event.preventDefault();
            alert(`You still have ${remainingHours.toFixed(1)} hours remaining. Please complete booking all lesson hours before confirming.`);
            return false;
        }

        // Additional validation for multiple sessions
        const sessionDates = document.querySelectorAll('input[name="session_dates[]"]');
        const morningSessionSelects = document.querySelectorAll('select[name="morning_sessions[]"]');
        const afternoonSessionSelects = document.querySelectorAll('select[name="afternoon_sessions[]"]');

        for (let i = 0; i < sessionDates.length; i++) {
            if (!sessionDates[i].value) {
                event.preventDefault();
                alert('Please select a date for all sessions.');
                return false;
            }

            const morningValue = morningSessionSelects[i].value;
            const afternoonValue = afternoonSessionSelects[i].value;

            if (!morningValue && !afternoonValue) {
                event.preventDefault();
                alert(`Please select at least one time slot for Session ${i + 1}.`);
                return false;
            }
        }

        return true;
    }

    // NEW: Attach validation to form submission
    document.querySelector('form').addEventListener('submit', validateMultipleSessionBooking);
    </script>
</x-layouts.student-app>
