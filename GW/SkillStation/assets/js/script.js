var events = [];
var currentLocation = '';
var currentCategory = '';
var currentDate = '';
var currentSearch = '';

function loadDropdowns() {
    var dateContainer = document.getElementById('dateContainer');
    let addedDates = { "": true };
    dateContainer.innerHTML = `
        <li><a class="dropdown-item" onclick="updateFilter('date', '')">All</a></li>
    `;
    events.forEach((event) => {
        if (!addedDates[event.date]) {
            addedDates[event.date] = true;
            dateContainer.innerHTML += `
                <li><a class="dropdown-item" onclick="updateFilter('date', '` + event.date + `')">
                    ` + event.date + `
                </a></li>
            `;
        }
    });

    var locationContainer = document.getElementById('locationContainer');
    let addedLocations = { "": true };
    locationContainer.innerHTML = `
        <li><a class="dropdown-item" onclick="updateFilter('location', '')">All</a></li>
    `;
    events.forEach((event) => {
        if (!addedLocations[event.address]) {
            addedLocations[event.address] = true;
            locationContainer.innerHTML += `
                <li><a class="dropdown-item" onclick="updateFilter('location', '` + event.address + `')">
                    ` + event.address + `
                </a></li>
            `;
        }
    });

    var categoryContainer = document.getElementById('categoryContainer');
    let addedCategories = { "": true };
    categoryContainer.innerHTML = `
        <li><a class="dropdown-item" onclick="updateFilter('category', '')">All</a></li>
    `;
    events.forEach((event) => {
        if (!addedCategories[event.category]) {
            addedCategories[event.category] = true;
            categoryContainer.innerHTML += `
                <li><a class="dropdown-item" onclick="updateFilter('category', '` + event.category + `')">
                    ` + event.category + `
                </a></li>
            `;
        }
    });
}


function updateFilter(type, value) {
    if (type == 'date') {
        currentDate = value;
        document.getElementById('dateDropdownButton').innerHTML = value != '' ? value : 'All';
    }

    if (type == 'location') {
        currentLocation = value;
        document.getElementById('locationDropdownButton').innerHTML = value != '' ? value : 'All';
    }

    if (type == 'category') {
        currentCategory = value;
        document.getElementById('categoryDropdownButton').innerHTML = value != '' ? value : 'All';
    }

    loadEvents(currentLocation, currentCategory, currentDate);
}

function updateOrganizerFilter(showMyEvents) {
    showMyEventsOnly = showMyEvents;
    var btnOrganizer = document.getElementById('organizerDropdownButton');
    if (btnOrganizer) btnOrganizer.textContent = showMyEvents ? "My Events" : "All Events";
    loadEvents(currentLocation, currentCategory, currentDate, currentSearch);
}

function searchEvents() {
    currentSearch = document.getElementById('searchInput').value.toLowerCase();
    loadEvents(currentLocation, currentCategory, currentDate, currentSearch);
}

function getAllEvents() {
    fetch(eventListPath)
        .then(response => response.json())
        .then(data => {
            events = data;
            loadDropdowns();
            loadEvents();
        });
}

getAllEvents();

function loadEvents(filterLocation = '', filterCategory = '', filterDate = '', searchTerm = '') {
    var eventContainer = document.getElementById("eventContainer");
    eventContainer.innerHTML = '';

    events.forEach(event => {
        var locationFilter = !filterLocation || event.location.includes(filterLocation);
        var categoryFilter = !filterCategory || event.category == filterCategory;
        var dateFilter = !filterDate || event.date == filterDate;
        var searchFilter = !searchTerm || event.title.toLowerCase().includes(searchTerm) || event.organizer.toLowerCase().includes(searchTerm);
        var organizerFilter = !showMyEventsOnly || (event.organizerId == organizerId);

        if (locationFilter && categoryFilter && dateFilter && searchFilter && organizerFilter) {
            eventContainer.innerHTML += `
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="` + imagePath + event.image + `" class="card-img-top">
                        <div class="card-body">
                            <div class="h5">` + event.title + `</div>
                            <p class="fst-italic mb-1">` + event.location + `</p>
                            <p class="mb-1" style="color: var(--primaryColor);">` + event.date + `</p>
                            <a href="events-info.php?eventId=` + event.eventId + `" class="btn btn-primary mt-2">View Details</a>
                        </div>
                    </div>
                </div>`;
        }
    });
}


