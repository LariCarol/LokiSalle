<?php

include('includes/connection.inc.php');

if(isset($_POST["action"]))
{
	$query = "SELECT s.*, pr.* FROM salle s JOIN produit pr WHERE s.id_salle = pr.id_salle AND s.id_salle IS NOT NULL";
	
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]))
	{
		$query .= "
		  AND pr.prix BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}

	if(isset($_POST["category"]))
	{
		$category_filter = implode("','", $_POST["category"]);
		$query .= "
		 AND categorie IN('".$category_filter."')
		";
	}

	if(isset($_POST["manufacturer"]))
	{
		$manufacturer_filter = implode("','", $_POST["manufacturer"]);
		$query .= "
		 AND ville IN('".$manufacturer_filter."')
		";
	}

	if(isset($_POST["capacity"]) && !empty($_POST["capacity"]))
	{
		$capacity_filter = (int) $_POST["capacity"];
		$query .= "
			AND capacite BETWEEN " . $capacity_filter . " AND " . ($capacity_filter * 2) . "
		";
	}

	if(isset($_POST["arrivalDate"]) && !empty($_POST["arrivalDate"]))
	{		
		$date_arrive = $_POST["arrivalDate"];
		$query .= "
			AND date_arrive >= '". $date_arrive . "'
		";
	}

	if(isset($_POST["departureDate"]) && !empty($_POST["departureDate"]))
	{
		$date_depart = $_POST["departureDate"];
		$query .= "
			AND date_depart >= '". $date_depart . "'
		";
	}

	$result = mysqli_query($con, $query);
	$total_row = mysqli_num_rows($result);
	$output = '';

	if($total_row > 0)
	{
		while($row = mysqli_fetch_array($result))
{
    $prix = isset($row['prix']) ? $row['prix'] : 'Prix non disponible';
    
    $photo = isset($row['photo']) && !empty($row['photo']) ? $row['photo'] : 'default.jpg';  
	if ($row['etat'] == 'libre') {
			$output .= '
			<li class="list-item">
			<div class="list-content">
				<a href="fiche_produit.php?produit=' . $row["id_produit"] . '">
					<img src="/Projet_LokiSalle/images/' . $photo . '" alt="image of ' . $row["titre"] . '" style="width:100%; height:auto;"/>
				</a>

				<div style="padding: 10px;">
					<a align="center" href="fiche_produit.php?produit=' . $row["id_produit"] . '" style="font-weight: bold; font-size: 16px; display: block; text-align: center;">
						' . $row["titre"] . '
					</a>
					<h4 style="text-align:center; color: #d9534f;">' . $prix . ' €</h4>

					<p style="text-align:center; font-size: 12px; color: #555;">' . $row['description'] . '</p>

					<p style="text-align:center; font-size: 12px; color: #555;">
						<i class="fas fa-calendar-alt"></i>
						' . date("d/m/Y", strtotime($row["date_arrive"])) . ' au ' . date("d/m/Y", strtotime($row["date_depart"])) . '
					</p>

					<div style="text-align: center; color: #f39c12;">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
					</div>

					<div style="text-align: right;">
						<a href="fiche_produit.php?produit=' . $row["id_produit"] . '" class="btn btn-link">Voir</a>
					</div>
				</div>
			</div>
		</li>
		';
	}

	else {
		$output .= '
			<li class="list-item">
			<div class="list-content">
					<img style="filter: grayscale(100%)" src="/Projet_LokiSalle/images/' . $photo . '" alt="image of ' . $row["titre"] . '" style="width:100%; height:auto;"/>

				<div style="padding: 10px;">
					<p align="center" style="color: #000; font-weight: bold; font-size: 16px; display: block; text-align: center;">' . $row["titre"] . '</p>
					<h4 style="text-align:center; color: #d9534f;">Déjà réservé</h4>

					<p style="text-align:center; font-size: 12px; color: #555;">' . $row["description"] .'</p>

					<p style="text-align:center; font-size: 12px; color: #555;">
						<i class="fas fa-calendar-alt"></i>
						' . date("d/m/Y", strtotime($row["date_arrive"])) . ' au ' . date("d/m/Y", strtotime($row["date_depart"])) . '
					</p>

					<div style="text-align: center; color: #f39c12;">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
					</div>
				</div>
			</div>
		</li>
		';
	}
}

	}
	else
	{
		$output = '<h3>Pas de salles trouvées</h3>';
	}

	echo $output;
}