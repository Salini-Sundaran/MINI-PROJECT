<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System</title>
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <!-- <?php include './component/header.php' ?> -->
    <div class="section background-bg py-5">
        <div class="bg-image"></div>
        <h2 class="text-center pt-2 pb-3">Application for admission to RIT Hostels for the period 2023-24</h2>
        <div class="container col-lg-8 p-md-5 p-3 mt-3 border border-2 rounded-3 bg-light shadow">
            <form action="hostel_application_form.php" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="photo" class="form-label">Upload Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*"
                                onchange="displayImage(this)">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 row">
                            <label for="photoDisplay" class="form-label">Uploaded Photo</label>
                            <img id="photoDisplay" src="" alt="Uploaded Photo" class="img-thumbnail"
                                style="max-width: 200px;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-3">
                            <label for="name" class="form-label important">Name of Applicant</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter Name of Applicant">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-3">
                            <label for="gender" class="form-label important">Gender</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female"
                                        value="female">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="other" value="other">
                                    <label class="form-check-label" for="other">Other</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-3">
                            <label for="course" class="form-label important">Degree</label>
                            <select class="form-select" id="degree" name="degree">
                                <option value="" selected>Select your course</option>
                                <option value="math">B.Tech</option>
                                <option value="science">M.Tech</option>
                                <option value="history">B.Arch</option>
                                <option value="history">MCA</option>
                                <!-- <option value="english">English</option> -->
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-3">
                            <label for="yearOfStudy" class="form-label important">Year of Study</label>
                            <select class="form-select" id="yearList" name="yearOfStudy">
                                <option value="" selected>Select year</option>
                                <option value="1">first year</option>
                                <option value="2">second year</option>
                                <option value="3">third year</option>
                                <option value="4">fourth year</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-3">
                            <label for="admissionNo" class="form-label important">Admission Number</label>
                            <input type="text" class="form-control" id="admissionNo" name="admissionNo"
                                placeholder="Enter Admission Number">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-3">
                            <label for="admissionNo" class="form-label important">Email</label>
                            <input type="email" class="form-control" id="admissionNo" name="email"
                                placeholder="Enter Email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-3">
                            <label for="semester" class="form-label important">Semester</label>
                            <select class="form-select" id="semester" name="semester">
                                <option value="" selected>Select your semester</option>
                                <option value="1">Semester 1</option>
                                <option value="2">Semester 2</option>
                                <option value="3">Semester 3</option>
                                <option value="4">Semester 4</option>
                                <option value="5">Semester 5</option>
                                <option value="6">Semester 6</option>
                                <option value="7">Semester 7</option>
                                <option value="8">Semester 8</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-3">
                            <label for="branch" class="form-label important">Branch</label>
                            <select class="form-select" id="branch" name="branch">
                                <option value="" selected>Select your branch</option>
                                <option value="cse">Computer Science and Engineering (CSE)</option>
                                <option value="ece">Electronics and Communication Engineering (ECE)</option>
                                <option value="me">Mechanical Engineering (ME)</option>
                                <option value="ce">Civil Engineering (CE)</option>
                                <option value="ee">Electrical Engineering (EE)</option>
                                <option value="it">Information Technology (IT)</option>
                                <option value="mca">Master of Computer Applications (MCA)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-3">
                            <label for="pAddress" class="form-label important">Permanent Address</label>
                            <textarea class="form-control" id="pAddress" name="pAddress" rows="3"
                                placeholder="Enter your Permanent address"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-3">
                            <label for="gAddress" class="form-label important">Guardian Address</label>
                            <textarea class="form-control" id="gAddress" name="gAddress" rows="3"
                                placeholder="Enter your Guardian Address"></textarea>
                        </div>
                    </div>
                    <!-- Add a button for calculating distance -->
                    <div class="col-md-6">
                        <div class="my-3">
                            <label for="pincode" class="form-label important">Enter PIN Code</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pincode" name="pincode"
                                    placeholder="Enter PIN Code" pattern="[0-9]{6}" title="Enter a 6-digit PIN Code"
                                    >
                                <button type="button" class="btn btn-primary" id="calculateDistanceButton"
                                    onclick="calculateDistance()">Calculate Distance</button>
                            </div>
                        </div>
                        <!-- Display the distance result here -->
                        <div id="distanceResult" class="mt-2"></div>
                        <!-- Display the loading message here -->
                        <div id="loadingMessage" class="mt-2" style="display: none;">Please wait...</div>
                    </div>


                    <div class="col-md-6">
                        <div class="my-3">
                            <label for="mobile" class="form-label important">Your Mobile Number</label>
                            <input type="phone" class="form-control" id="mobile" name="mobile"
                                placeholder="Enter your Phone Number">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-3">
                            <label for="gMobile" class="form-label important">Guardian Mobile Number</label>
                            <input type="phone" class="form-control" id="gMobile" name="gMobile"
                                placeholder="Enter Guardian Mobile Number">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-3">
                            <label for="prAddress" class="form-label">Present Residential Address</label>
                            <textarea class="form-control" id="prAddress" name="prAddress" rows="3"
                                placeholder="Enter your Present Residential Address"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-3">
                            <label for="priority" class="form-label important">Priority to which the applicant belongs :
                                <br>Priority I — Other States/Central Govt.
                                Nominees
                                <br>Priority II - SC/ST/PH/BPL
                                <br>(Priority II students must attach copy of
                                roof)Whether belongs to OBC/OEC?</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="p1" id="p1" value="p1">
                                    <label class="form-check-label" for="p1">Priority 1</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="p2" id="p2" value="p2">
                                    <label class="form-check-label" for="p2">Priority 2</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="other" id="other" value="other">
                                    <label class="form-check-label" for="other">Others</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-3">
                            <label for="aIncome" class="form-label important">Annual Income</label>
                            <input type="text" class="form-control" id="aIncome" name="aIncome"
                                placeholder="Enter Annual Income">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-3">
                            <label for="obcOrOec" class="form-label important">Whether belongs to OBC/OEC?</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="obcOrOec" id="obcOrOecYes"
                                        value="Yes">
                                    <label class="form-check-label" for="male">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="obcOrOec" id="obcOrOecNo"
                                        value="No">
                                    <label class="form-check-label" for="female">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-3">
                            <label for="distance" class="form-label important">Minimum distance from the Post
                                Office in the address specified in the Adhaar
                                Card to RIT Pampady, Kottayam</label>
                            <input type="text" class="form-control" id="distance" name="distance"
                                placeholder="Calculated Distance" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-3">
                            <label for="sgpa" class="form-label important">SGPA of each semester Average SGPA —
                                (considering last published University results)</label>
                            <div class="row">
                                <div class="col-md-6 d-flex gap-2 mb-2 align-items-center">
                                    <label for="">1.</label>
                                    <input type="text" class="form-control" id="sgpa1" name="sgpa1" placeholder="">
                                </div>
                                <div class="col-md-6 d-flex gap-2 mb-2 align-items-center">
                                    <label for="">2.</label>
                                    <input type="text" class="form-control" id="sgpa2" name="sgpa2" placeholder="">
                                </div>
                                <div class="col-md-6 d-flex gap-2 mb-2 align-items-center">
                                    <label for="">3.</label>
                                    <input type="text" class="form-control" id="sgpa3" name="sgpa3" placeholder="">
                                </div>
                                <div class="col-md-6 d-flex gap-2 mb-2 align-items-center">
                                    <label for="">4.</label>
                                    <input type="text" class="form-control" id="sgpa4" name="sgpa4" placeholder="">
                                </div>
                                <div class="col-md-6 d-flex gap-2 mb-2 align-items-center">
                                    <label for="">5.</label>
                                    <input type="text" class="form-control" id="sgpa5" name="sgpa5" placeholder="">
                                </div>
                                <div class="col-md-6 d-flex gap-2 mb-2 align-items-center">
                                    <label for="">6.</label>
                                    <input type="text" class="form-control" id="sgpa6" name="sgpa6" placeholder="">
                                </div>
                                <div class="col-md-6 d-flex gap-2 mb-2 align-items-center">
                                    <label for="">7.</label>
                                    <input type="text" class="form-control" id="sgpa7" name="sgpa7" placeholder="">
                                </div>
                                <div class="col-md-6 d-flex gap-2 mb-2 align-items-center">
                                    <label for="">8.</label>
                                    <input type="text" class="form-control" id="sgpa8" name="sgpa8" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-3">
                            <label for="rank" class="form-label important">Rank in entrance exam/DTE list (for first
                                year UG and PG)</label>
                            <input type="text" class="form-control" id="rank" name="rank" placeholder="Rank">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-3">
                            <label for="dAction" class="form-label">Any disciplinary action from the college</label>
                            <input type="text" class="form-control" id="dAction" name="dAction" placeholder="Explain">
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <button type="reset" class="btn btn-secondary px-4 mx-1">Reset</button>
                    <button type="submit" name="submit" class="btn btn-primary px-4 mx-1">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <!-- <?php include './component/footer.php' ?> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script>
    function displayImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('photoDisplay').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }



    function calculateDistance() {
        var pincode = document.getElementById('pincode').value;

        // Display the loading message
        document.getElementById('loadingMessage').style.display = 'block';
        // Hide the distance result
        document.getElementById('distanceResult').style.display = 'none';

        // Make an AJAX request to your PHP script
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                // Hide the loading message
                document.getElementById('loadingMessage').style.display = 'none';

                if (xhr.status === 200) {
                    // Show the distance result
                    document.getElementById('distanceResult').style.display = 'block';
                    // Update the content of the distanceResult div with the response from PHP
                    document.getElementById('distanceResult').innerHTML = 'Distance: ' + xhr.responseText;
                    var calculatedDistance = xhr.responseText;
                    document.getElementById('distance').value = calculatedDistance;

                } else {
                    // Handle the error case (e.g., display an error message)
                    console.error('Error in AJAX request');
                }
            }
        };

        // Replace 'your_php_script.php' with the actual path to your PHP script
        xhr.open('GET', 'distance_calculate.php?pincode=' + pincode, true);
        xhr.send();
    }
    </script>

</body>

</html>