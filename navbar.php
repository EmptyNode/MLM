<!DOCTYPE html>
<html>
<head>
    <script>
        // Declare selectedValue and selectedOption variables in a higher scope
        let selectedValue = '';
        let selectedOption = '';

        // Event listener for capturing the selected value
        document.addEventListener("DOMContentLoaded", function() {
            const dropdownContent = document.getElementById("dropdownContent");

            dropdownContent.addEventListener("click", function(event) {
                const clickedItem = event.target;
                if (clickedItem.classList.contains("dropdown-item")) {
                    // Get the text content of the selected option
                    selectedValue = clickedItem.textContent;
                }
            });
        });

        // Event listener for capturing the selected option
        document.addEventListener("DOMContentLoaded", function() {
            const dropdownItems = document.querySelectorAll(".dropdown-item");

            dropdownItems.forEach(function(item) {
                item.addEventListener("click", function() {
                    // Get the text content of the selected option
                    selectedOption = item.textContent;
                });
            });
        });

        // JavaScript function to redirect to listingpage.php
        function redirectToListingPage() {
            // Check if both selections are made
            if (selectedValue !== "" && selectedOption !== "") {
                // Redirect to listingpage.php
                window.location.href = "listingpage.php?pincode=" + selectedValue + "&service=" + selectedOption;
            }
        }

    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Ankan Ch</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <div class="dropdown ml-5">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 145px">
                            Select Pincode
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <input type="text" class="form-control" id="searchInput" placeholder="Search...">
                            <div id="dropdownContent">
                                <!-- Dropdown content will be loaded here -->
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    
        <button type="button" class="btn btn-default" onclick="redirectToListingPage()">
                <span class="glyphicon 
                glyphicon-search"></span> Search
            </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Services
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" id="selectedService" href="#">Car</a>
                        <a class="dropdown-item" id="selectedService" href="#">House</a>
                        <!-- Add more service options here -->
                    </div>
                </li>
            </ul>
        </div>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <!-- Add more navigation items here if needed -->
            </ul>
            <button class="btn btn-outline-danger my-2 my-sm-0 m-2" data-bs-toggle="modal" data-bs-target="#signupModal"
                type="button">SignUp</button>
            <button class="btn btn-outline-success my-2 my-sm-0" data-bs-toggle="modal" data-bs-target="#loginModal"
                type="button">Login</button>
        </div>
    </nav>
</body>
</html>
