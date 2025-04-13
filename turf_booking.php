<?php include 'includes/header.php'; ?>

<div class="bg-gray-950 text-white min-h-screen">
    <section id="turf-booking" class="py-20 text-center">
        <h2 class="text-4xl font-bold text-yellow-400">Turf Booking</h2>
        <p class="text-gray-300 text-xl mt-2">Improve your body control, strength, and performance with expert-guided sports training programs.</p>
        <p class="mt-2 text-xl text-gray-300">Reserve your turf slot and enjoy your game.</p>

        <div class="flex justify-center gap-6 mt-6">
            <button onclick="openModal()" class="bg-yellow-400 text-black px-6 py-3 rounded-lg font-semibold shadow-md hover:bg-yellow-500 transition">
                📅 Book Your Slot
            </button>
            <button onclick="openBookedSlots()" class="bg-blue-500 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:bg-blue-600 transition">
                📋 View Booked Slots
            </button>
        </div>
    </section>

    <!-- Booking Modal -->
    <div id="bookingModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded-lg w-4/5 max-w-2xl text-black relative shadow-lg">
            <h2 class="text-3xl font-bold text-center text-gray-900">⚽ Retro.Fit Turf Booking</h2>
            <p class="text-center text-gray-600">Choose your preferred turf and book your slot.</p>
            
            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-100 p-4 rounded-md shadow">
                    <h3 class="text-xl font-semibold">Turf 1</h3>
                    <h6 class="text-gray-700">Fee: ₹800/hr</h6>
                    <button onclick="openBookingForm('Turf 1', 800)" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-2 w-full">Book Now</button>
                </div>
                <div class="bg-gray-100 p-4 rounded-md shadow">
                    <h3 class="text-xl font-semibold">Turf 2</h3>
                    <h6 class="text-gray-700">Fee: ₹900/hr</h6>
                    <button onclick="openBookingForm('Turf 2', 900)" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-2 w-full">Book Now</button>
                </div>
                <div class="bg-gray-100 p-4 rounded-md shadow">
                    <h3 class="text-xl font-semibold">🏟️ Turf 3</h3>
                    <p class="text-gray-700">Fee: ₹700/hr</p>
                    <button onclick="openBookingForm('Turf 3', 700)" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-2 w-full">Book Now</button>
                </div>
                <div class="bg-gray-100 p-4 rounded-md shadow">
                    <h3 class="text-xl font-semibold">🏟️ Turf 4</h3>
                    <p class="text-gray-700">Fee: ₹950/hr</p>
                    <button onclick="openBookingForm('Turf 4', 950)" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-2 w-full">Book Now</button>
                </div>
                <div class="bg-gray-100 p-4 rounded-md shadow">
                    <h3 class="text-xl font-semibold">🏟️ Turf 5</h3>
                    <p class="text-gray-700">Fee: ₹850/hr</p>
                    <button onclick="openBookingForm('Turf 5', 850)" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-2 w-full">Book Now</button>
                </div>
                <div class="bg-gray-100 p-4 rounded-md shadow">
                    <h3 class="text-xl font-semibold">🏟️ Turf 6</h3>
                    <p class="text-gray-700">Fee: ₹750/hr</p>
                    <button onclick="openBookingForm('Turf 6', 750)" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-2 w-full">Book Now</button>
                </div>
            </div>
            <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 text-xl font-bold">&times;</button>
        </div>
    </div>

    <!-- Booking Form Modal -->
    <div id="bookingFormModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded-lg w-4/5 max-w-md text-black relative shadow-lg">
            <h2 class="text-2xl font-bold text-center">📋 Booking Details</h2>
            <form id="bookingForm" class="mt-4">
                <input type="hidden" id="selectedTurf">
                <input type="hidden" id="selectedFee">

                <label class="block font-semibold">Name:</label>
                <input type="text" id="name" required placeholder="Enter your name" class="w-full p-2 border rounded-md mb-3 text-black">

                <label class="block font-semibold">Phone:</label>
                <input type="tel" id="phone" required placeholder="Enter your phone number" class="w-full p-2 border rounded-md mb-3 text-black">

                <label class="block font-semibold">Email:</label>
                <input type="email" id="email" required placeholder="Enter your email" class="w-full p-2 border rounded-md mb-3 text-black">

                <label class="block font-semibold">Hours:</label>
                <input type="number" id="hours" min="1" required placeholder="Enter hours" class="w-full p-2 border rounded-md mb-3 text-black" oninput="calculateAmount()">

                <p class="text-lg font-bold">Total Amount: ₹<span id="totalAmount">0</span></p>

                <button type="button" onclick="submitBooking()" class="w-full mt-3 bg-green-500 text-white px-4 py-2 rounded-md">Book Now</button>
            </form>
            <button onclick="closeBookingForm()" class="absolute top-2 right-2 text-gray-600 text-xl font-bold">&times;</button>
        </div>
    </div>

    <!-- Booked Slots Modal -->
    <div id="bookedSlotsModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded-lg w-4/5 max-w-md text-black relative shadow-lg">
            <h2 class="text-2xl font-bold text-center">📋 Booked Slots</h2>
            <div id="bookedSlotsList" class="mt-4 space-y-3 max-h-60 overflow-y-auto p-2">
                <p class="text-center text-gray-500">No slots booked yet.</p>
            </div>
            <button onclick="closeBookedSlots()" class="absolute top-2 right-2 text-gray-600 text-xl font-bold">&times;</button>
        </div>
    </div>

    <!-- Turf Images Section -->
    <section id="turfs" class="py-20">
        <h2 class="text-4xl font-bold text-center text-yellow-400">🏟️ Turfs Images</h2>
        <p class="text-lg text-center text-gray-300 mt-2">Choose your favorite turf and book a slot!</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-6 mt-8">
            <!-- Turf 1 -->
            <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden p-4">
                <img src="assets/images/turfs/turf1.jpg" alt="Turf 1" class="w-full h-52 object-cover rounded-lg">
                <div class="mt-4">
                    <h3 class="text-xl font-semibold">Turf 1</h3>
                    <p class="text-gray-400">Fee: ₹800/hr</p>
                </div>
            </div>

            <!-- Turf 2 -->
            <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden p-4">
                <img src="assets/images/turfs/turf2.jpg" alt="Turf 2" class="w-full h-52 object-cover rounded-lg">
                <div class="mt-4">
                    <h3 class="text-xl font-semibold">Turf 2</h3>
                    <p class="text-gray-400">Fee: ₹900/hr</p>
                </div>
            </div>

            <!-- Turf 3 -->
            <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden p-4">
                <img src="assets/images/turfs/turf3.webp" alt="Turf 3" class="w-full h-52 object-cover rounded-lg">
                <div class="mt-4">
                    <h3 class="text-xl font-semibold">Turf 3</h3>
                    <p class="text-gray-400">Fee: ₹700/hr</p>
                </div>
            </div>

            <!-- Turf 4 -->
            <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden p-4">
                <img src="assets/images/turfs/turf4.jpg" alt="Turf 4" class="w-full h-52 object-cover rounded-lg">
                <div class="mt-4">
                    <h3 class="text-xl font-semibold">Turf 4</h3>
                    <p class="text-gray-400">Fee: ₹950/hr</p>
                </div>
            </div>

            <!-- Turf 5 -->
            <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden p-4">
                <img src="assets/images/turfs/turf5.jpg" alt="Turf 5" class="w-full h-52 object-cover rounded-lg">
                <div class="mt-4">
                    <h3 class="text-xl font-semibold">Turf 5</h3>
                    <p class="text-gray-400">Fee: ₹850/hr</p>
                </div>
            </div>

            <!-- Turf 6 -->
            <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden p-4">
                <img src="assets/images/turfs/turf6.jpg" alt="Turf 6" class="w-full h-52 object-cover rounded-lg">
                <div class="mt-4">
                    <h3 class="text-xl font-semibold">Turf 6</h3>
                    <p class="text-gray-400">Fee: ₹750/hr</p>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
function closeBookedSlots() {
    document.getElementById("bookedSlotsModal").classList.add("hidden");
}

function openModal() {
    document.getElementById("bookingModal").classList.remove("hidden");
}

function closeModal() {
    document.getElementById("bookingModal").classList.add("hidden");
}

function openBookingForm(turfName, fee) {
    document.getElementById("selectedTurf").value = turfName;
    document.getElementById("selectedFee").value = fee;
    document.getElementById("totalAmount").innerText = "0";
    document.getElementById("bookingFormModal").classList.remove("hidden");
}

function closeBookingForm() {
    document.getElementById("bookingFormModal").classList.add("hidden");
}

function calculateAmount() {
    let hours = document.getElementById("hours").value;
    let fee = document.getElementById("selectedFee").value;
    let total = hours * fee;
    document.getElementById("totalAmount").innerText = total;
}

function submitBooking() {
    let name = document.getElementById("name").value;
    let phone = document.getElementById("phone").value;
    let email = document.getElementById("email").value;
    let hours = document.getElementById("hours").value;
    let turf = document.getElementById("selectedTurf").value;
    let totalAmount = document.getElementById("totalAmount").innerText;
    let booking = { turf, name, phone, email, hours, totalAmount };
    let bookings = JSON.parse(localStorage.getItem("bookings")) || [];
    bookings.push(booking);
    localStorage.setItem("bookings", JSON.stringify(bookings));
    alert(`✅ Your slot is booked! Pay at entrance.`);
    closeBookingForm();
}

function openBookedSlots() {
    let bookings = JSON.parse(localStorage.getItem("bookings")) || [];
    let bookedSlotsContainer = document.getElementById("bookedSlotsList");
    bookedSlotsContainer.innerHTML = "";

    if (bookings.length === 0) {
        bookedSlotsContainer.innerHTML = `<p class="text-center text-gray-500">No slots booked yet.</p>`;
    } else {
        bookings.forEach((booking, index) => {
            bookedSlotsContainer.innerHTML += `
                <div class='p-3 bg-gray-100 rounded-md shadow text-black'>
                    <p>📍 <strong>Turf:</strong> ${booking.turf}</p>
                    <p>🧑 <strong>Name:</strong> ${booking.name}</p>
                    <p>📞 <strong>Phone:</strong> ${booking.phone}</p>
                    <p>📧 <strong>Email:</strong> ${booking.email}</p>
                    <p>⏳ <strong>Hours:</strong> ${booking.hours}</p>
                    <p>💰 <strong>Total:</strong> ₹${booking.totalAmount}</p>
                    <button onclick="deleteBooking(${index})" class="bg-red-500 text-white px-3 py-1 rounded mt-2 w-full">
                        ❌ Delete Booking
                    </button>
                </div>
            `;
        });
    }
    document.getElementById("bookedSlotsModal").classList.remove("hidden");
}

function deleteBooking(index) {
    let bookings = JSON.parse(localStorage.getItem("bookings"));
    bookings.splice(index, 1);
    localStorage.setItem("bookings", JSON.stringify(bookings));
    openBookedSlots();
}
</script>

<?php include 'includes/footer.php'; ?>
