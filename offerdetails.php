<?php
session_start();

function __autoload($className){
    require_once("php/classes/$className.php");
} 

if (!isset($_GET['id'])) {
    header("Location: index.php");
}
$offer_id = $_GET['id'];
$file = "./xmls/offers.xml";
$database = new Database($file);

$offer = $database->searchNode("offer", "id", $offer_id);
if ($offer == FALSE) {
    header("Location: index.php");
}

include("includes/header.html");
include("includes/nav.php");

echo "<div class=\"container text-align\">";
echo "<div class=\"row seg\">";
echo "<div class=\"col-md-5\">";
echo "<p><strong>Driver: </strong>" . $offer->username ."</p>";
echo "<p><strong>Depart From: </strong>" . $offer->start ."</p>";
echo "<p><strong>Seats Available: </strong>" . $offer->seats ."</p>";
echo "</div>";
echo "<div class=\"col-md-5\">";
echo "<p><strong>Time: </strong>" . $offer->time ." " . $offer->date ."</p>";
echo "<p><strong>Destination: </strong>" . $offer->end ."</p>";
echo "</div>";
echo "<div class=\"col-md-2\">";
echo "<p><a href=\"#\"><button class=\"btn btn-success\">Reserve a seat</button></a></p>";
echo "<p><a href=\"#\"><button class=\"btn btn-danger\">Cancel Offer</button></a></p>";
echo "</div>";
echo "</div>";
?>
<div class="embed-responsive embed-responsive-16by9">
<iframe id="googleMap" class="embed-responsive-item" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
<script>
    $(function() {
        $("#googleMap").attr("src", "https://www.google.com/maps/embed/v1/directions?origin=" +
        <?php echo("\"" . $offer->start . "\""); ?> +
        "&destination=" +
        <?php echo("\"" . $offer->end . "\""); ?> +
        "&key=AIzaSyAh-wxnCsW7OZsqkWMHXLFtdjwLXo1PsqY");
    });
</script>
</div>