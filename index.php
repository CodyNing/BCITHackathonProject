<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/includes/header.html");
?>


<div class="landing">

<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/nav.php");?>


<section id="one" class="wrapper style1 special">
    <div class="container" id="newRide">
        <header class="major">
            <h2>BCIT Carpool Services</h2>
            <p>Find or create a new ride!</p>
            <br/><br/>
            <a href="#"><button class="button alt">Back to Home</button></a>
        </header>
        <div class="row 150%">
            <div class="4u 12u$(medium)">
                <section class="box">
                    <a href="index.php#createRide">
                        <img src="https://image.flaticon.com/icons/svg/599/599147.svg" height="100" width="100" />
                        <br/><br/><br/>
                        <h1>Create a Ride</h1>
                    </a>
                    <br/><br/>
                    <p>Create a new ride and find passengers to tag along with you.</p>
                </section>
            </div>
            <div class="4u 12u$(medium)">
                <section class="box">
                    <a href="index.php#offers">
                        <img src="https://image.flaticon.com/icons/svg/426/426140.svg" height="98" width="95" />
                        <br/><br/><br/>
                        <h1>Find a Ride</h1>
                    </a>
                    <br/><br/>
                    <p>See the list of all available carpool rides and request for a seat.</p>
                </section>
            </div>
            <div class="4u$ 12u$(medium)">
                <section class="box">
                    <a href="https://ride-share.glitch.me/">
                        <img src="/image/slacklogo.png" height="98"/>
                        <br/><br/><br/>
                        <h1>Slack App</h1>
                    </a>
                    <br/><br/>
                    <p>Download RideShare's Slack App and integrate it with your Slack workspace.</p>
                </section>
            </div>
        </div>
    </div>
</section>



<!-- Create Ride -->
<section id="createRide" class="wrapper style2 special">
    <div class="container">
        <header class="major">
            <h2>Create A Ride</h2>
            <img src="https://image.flaticon.com/icons/svg/146/146269.svg" height=200 width=200/>
            <br/><br/>
            <a href="#"><button class="button alt">Back to Home</button></a>
        </header>
        <header class="major">
            <p>Fill out the form to offer a drive: </p>
        </header>
        <div class="container">
            <section class="box">
                <div id="driver">
                        <?php if (isset($_SESSION['user_id'])) { ?>
                                <form method="post" action="php/make_offer.php" id="driverForm" >
                                    <div class="row 150%">
                                        <!-- Driver Date --> 
                                        <div class="6u 12u$(4)">
                                            <label for="driver_date">Date:</label>    
                                            <input class="form-control" type="date" name="driver_date" id="driver_date" />
                                            <script>
                                                Date.prototype.toDateInputValue = (function() {
                                                    var local = new Date(this);
                                                    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
                                                    return local.toJSON().slice(0,10);
                                                });
                                                document.getElementById('driver_date').defaultValue = new Date().toDateInputValue();
                                            </script>
                                        </div>
                                        
                                        <!-- Driver Time -->
                                        <div class="6u$ 12u$(4)">
                                            <label for="driver_time">Start Time:</label>
                                            <input class="form-control" type="time" name="driver_time" id="driver_time" />
                                            <script>
                                                var d = new Date();
                                                var hours = d.getHours().toString();
                                                if (hours.length == 1) {
                                                    hours = "0" + hours;
                                                }
                                                var minutes = d.getMinutes().toString();
                                                if (minutes.length == 1) {
                                                    minutes = "0" + minutes;
                                                }
                                                var time = hours + ":" + minutes;
                                                document.getElementById('driver_time').defaultValue = time;
                                            </script>
                                        </div>
                                        <br/><br/>
                                        <!-- Driver start -->
                                        <div class="12u$">
                                                <label for="driver_start">Start From:</label>
                                                <input class="form-control" type="text" name="driver_start" id="driver_start" required/>
                                            
                                        </div>
                                        <br/><br/>
                                        <!-- Driver end -->
                                        <div class="12u$">
                                                <label for="driver_end">Destination:</label>
                                            <input class="form-control" type="text" name="driver_end" id="driver_end" required/>
                                        </div>
                                        <br/><br/>
                                        <!-- Seats Available -->
                                        <div class="12u$">
                                            <label for="driver_seats">No. of Seats Available</label>
                                                <select class="form-control" name="driver_seats" id="driver_seats">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        
                                        </div>
                                        <br/><br/>
                                        <div class="12u$">
                                            <ul class="actions">
                                                <li><input type="submit" value="Submit" class="special" /></li>
                                                <li><input type="reset" value="Reset" /></li>
                                            </ul>
                                        </div>
                                </div>
                            </form>
                        </section>

                        <?php } else {
                            echo "<header class='major'><h1>Please login to create a ride!</h1></header>";
                            }   
                            ?>  
                </div>
            </div>             
        </section>
    </div>
</section>


<!-- View Offers -->
<section id="two" class="wrapper style3">
    <div class="container" id="offers">
            <header class="major">
                <h2>View Available Rides</h2>
                <img src="https://image.flaticon.com/icons/svg/198/198335.svg" height=200 width=200/>
                <br/><br/>
                <a href="#"><button class="btn btn default">Back to Home</button></a>
            </header>
            <section class="offers">
                <div class="row">
                    <section class="container">
                        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/offers.php")?>
                    </section>
                </div>
            </section>
    </div>
    
</section>
</div>
          
<!--  -->


<?php 
include($_SERVER['DOCUMENT_ROOT'] . "/includes/reserve_modal.html");
include($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.html"); 
?>




    
