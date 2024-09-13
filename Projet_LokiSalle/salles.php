<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include("includes/connection.inc.php");
include("includes/head.php");
include("includes/main.php");
include("includes/functions.php");
?>
<div class="container">
    <div class="row">
        <div class="col-md-3"> 
            <div class="list-group">
                <br>
                <h3>Prix</h3>
                <input type="hidden" id="hidden_minimum_price" value="0" />
                <input type="hidden" id="hidden_maximum_price" value="3000" />
                <p id="price_show" style="color:black">0 - 3000</p>
                <div id="price_range" style="color:black"></div>
                <br>
            </div>		

            <div class="list-group">
    <h3>Catégorie</h3>
    <div class="scrollable">
        <?php
            // Query para obter categorias distintas
            $query = "SELECT DISTINCT categorie FROM salle WHERE categorie != ''";
            $runquery = mysqli_query($con, $query);

            if ($runquery) {
                while ($row = mysqli_fetch_array($runquery)) {
                    ?>
                    <div class="list-group-item checkbox">
                        <label>
                            <input type="checkbox" class="common_selector category" value="<?php echo $row['categorie']; ?>">
                            <?php echo ucfirst($row['categorie']); ?>
                        </label>
                    </div>
                    <?php
                }
            } else {
                echo "Erreur lors de la récupération des catégories.";
            }
        ?>
    </div>
</div>

<div class="list-group">
    <h3>Ville</h3>
    <div class="scrollable">
    <?php
    // Query para obter cidades distintas
    $query = "SELECT DISTINCT ville FROM salle";
    $runquery = mysqli_query($con, $query);

    if ($runquery) {
        while ($row = mysqli_fetch_array($runquery)) {
    ?>
        <div class="list-group-item checkbox">
            <label>
                <input type="checkbox" class="common_selector manufacturer" value="<?php echo $row['ville']; ?>">
                <?php echo $row['ville']; ?>
            </label>
        </div>
    <?php
        }
    } else {
        echo "Erreur lors de la récupération des villes.";
    }
    ?>
    </div>
</div>
            
            <div class="list-group">
                <h3>Capacité</h3>
                <select class="form-control" id="capacity">
                    <option value="">Sélectionner</option>
                    <option value="5">1 - 5</option>
                    <option value="10">6 - 10</option>
                    <option value="20">11 - 20</option>
                    <option value="40">21 - 40</option>
                </select>
            </div>
            <br>

            <div class="list-group">
                <h3>Période</h3>
                <div class="form-group">
                    <label for="arrivalDate">Date d'arrivée</label>
                    <input type="date" class="form-control" id="arrivalDate">
                </div>
                <div class="form-group">
                    <label for="departureDate">Date de départ</label>
                    <input type="date" class="form-control" id="departureDate">
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <br/>
            <ul class="list filter_data"></ul>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script>
$(document).ready(function(){
    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="text-align:center;"><img src="loading.gif" /></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var category = get_filter('category');
        var manufacturer = get_filter('manufacturer');
        var capacity = $('#capacity').val();
        var arrivalDate = $('#arrivalDate').val();
        var departureDate = $('#departureDate').val();

        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{
                action: action, 
                minimum_price: minimum_price, 
                maximum_price: maximum_price, 
                category: category, 
                manufacturer: manufacturer,
                capacity: capacity,
                arrivalDate: arrivalDate,
                departureDate: departureDate
            },
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    $('#capacity, #arrivalDate, #departureDate').change(function(){
        filter_data();
    });

    $('#price_range').slider({
        range: true,
        min: 0,
        max: 3000,
        values: [0, 3000],
        step: 100,
        stop: function(event, ui) {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });
});
</script>

<?php include "includes/footer.php"; ?>
</body>
