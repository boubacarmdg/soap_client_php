<?php
require_once "clientSOAP.php";
$res = $clientSOAP->__soapCall("getEtudiants", array());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAOP Client PHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<link
	href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
	rel="stylesheet">
</head>

<script>

	function deleteStudent(id){
		Swal.fire({
			title: 'Merci de patienter...',
			showCancelButton: false,
			showConfirmButton: false,
			closeOnCancel: true,
			timer: 1000,
   		 }).then(function(){
		$.ajax({
			type: "POST",
			url: "ajax.delete_student.php",
			data:{
				id: id
			},
			success: function(data){

				if(data == true){
					Swal.fire({
						title: 'L\'étudiant a bien été supprimé',
						icon: 'success',
						showCancelButton: false,
						showConfirmButton: false,
						closeOnCancel: true,
						timer: 2000,
						timerProgressBar: true,
					}).then(function(){
						location.reload();
					})
				} else {
					Swal.fire({
						title: 'Oops, erreur de traitement',
						icon: 'error',
						showCancelButton: false,
						showConfirmButton: false,
						closeOnCancel: true,
						timer: 2000,
						timerProgressBar: true,
					})
				}
			}
		})
		})
	}

	function addStudent(){
		Swal.fire({
			title: 'Ajouter un étudiant',
			html:
				'<input id="aprenom" class="swal2-input" placeholder="Prénom">' +
				'<input id="anom" class="swal2-input" placeholder="Nom">',
			showCancelButton: false,
			showConfirmButton: true,
			closeOnCancel: true,
			confirmButtonText: "Ajouter",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: "POST",
					url: "ajax.add_student.php",
					data:{
						prenom: document.getElementById('aprenom').value,
						nom: document.getElementById('anom').value
					},
					success: function(data){

						if(data == true){
							Swal.fire({
								title: 'L\'étudiant a bien été ajouté',
								icon: 'success',
								showCancelButton: false,
								showConfirmButton: false,
								closeOnCancel: true,
								timer: 2000,
								timerProgressBar: true,
							}).then(function(){
								location.reload();
							})
						} else {
							Swal.fire({
								title: 'Oops, erreur de traitement',
								icon: 'error',
								showCancelButton: false,
								showConfirmButton: false,
								closeOnCancel: true,
								timer: 2000,
								timerProgressBar: true,
							})
						}
					}
				})
			}
		})
	}


	function updateStudent(id,nom,prenom){
		Swal.fire({
			title: `Modification de l'étudiant #${id}`,
			html:
				`<input id="uprenom" class="swal2-input" value="${prenom}" Placeholder="Prénom">
				<input id="unom" class="swal2-input" value="${nom}" placeholder="Nom">`,
			showCancelButton: false,
			showConfirmButton: true,
			closeOnCancel: true,
			confirmButtonText: "Modifier",
		}).then((result) => {
			if (result.isConfirmed) {
			$.ajax({
					type: "POST",
					url: "ajax.update_student.php",
					data:{
						id:id,
						prenom: document.getElementById('uprenom').value,
						nom: document.getElementById('unom').value
					},
					success: function(data){

						if(data == true){
							Swal.fire({
								title: `L'étudiant #${id} a bien été modifié`,
								icon: 'success',
								showCancelButton: false,
								showConfirmButton: false,
								closeOnCancel: true,
								timer: 2000,
								timerProgressBar: true,
							}).then(function(){
								location.reload();
							})
						} else {
							Swal.fire({
								title: 'Oops, erreur de traitement',
								icon: 'error',
								showCancelButton: false,
								showConfirmButton: false,
								closeOnCancel: true,
								timer: 2000,
								timerProgressBar: true,
							})
						}
					}
			})
		}
		})

	}

</script>
<body>
<div class="flex items-center justify-center min-h-screen bg-gradient-to-b from-gray-900 to-slate-700">

<div id="response"></div>

		<div class="overflow-auto lg:overflow-visible ">
		<a href="javascript:void(0)" class="text-right w-full font-xl" onclick="addStudent()"><i class="material-icons-round text-base text-white font-xl">add_circle</i></a>
			<table class="table text-gray-400 border-separate space-y-6 text-sm">
				<thead class="bg-gray-800 text-gray-500l" style="border-radius:10px;">
					<tr>
						<th class="p-3 text-left"></th>
						<th class="p-3 text-left">#</th>
						<th class="p-3 text-left">Nom</th>
						<th class="p-3 text-left">Prénom</th>
						<th class="p-3 text-left">Action</th>
					</tr>
				</thead>
				<tbody>

                <?php foreach ($res->return as $response) {?>
					<tr class="bg-gray-800">
                        <td class="p-3">
                            <img class="rounded-full h-12 w-12  object-cover" src="assets/img/profile.jpg" alt="unsplash image">
						</td>

						<td class="p-3">
						<?=$response->id?>
						</td>

						<td class="p-3">
							<div class="flex gap-2 items-center">
								<div class=""><?=$response->nom?></div>
							</div>
						</td>

						<td class="p-3">
                        	<?=$response->prenom?>
						</td>

						<td class="p-3 ">
							<a href="#" onclick="updateStudent(<?=$response->id?>,'<?=$response->nom?>','<?=$response->prenom?>')" class="text-gray-400 hover:text-gray-100 transition">
								<i class="material-icons-outlined text-base">edit</i>
							</a>
							<a href="javascript:void(0)" onclick="deleteStudent(<?=$response->id?>)" class="text-gray-400 hover:text-gray-100 transition ml-3">
								<i class="material-icons-round text-base">delete_outline</i>
							</a>
						</td>
					</tr>
                <?php }?>

				<?php //for ($i = 0; $i <= 2; $i++) {?>

						<!-- <tr class="bg-gray-800">
                        <td class="p-3">
                            <img class="rounded-full h-12 w-12  object-cover" src="assets/img/profile.jpg" alt="unsplash image">
						</td>

						<td class="p-3">
						1
						</td>

						<td class="p-3">
							<div class="flex gap-2 items-center">
								<div class="">test</div>
							</div>
						</td>

						<td class="p-3">
                        	user
						</td>

						<td class="p-3">
							<a href="#" onclick="updateStudent(1,'test','user')" class="text-gray-400 hover:text-gray-100 transition">
								<i class="material-icons-outlined text-base">edit</i>
							</a>
							<a href="javascript:void(0)" onclick="deleteStudent(1)" class="text-gray-400 hover:text-gray-100 transition ml-3">
								<i class="material-icons-round text-base">delete_outline</i>
							</a>
						</td>
					</tr> -->

					<?php //}?>


				</tbody>
			</table>
	</div>
</div>
<style>
	@font-face {
    font-family: "Touche";
    src: url("//db.onlinewebfonts.com/t/89d8fba73b6d10c300478fad02d4871d.eot"); src: url("//db.onlinewebfonts.com/t/89d8fba73b6d10c300478fad02d4871d.eot?#iefix") format("embedded-opentype"), url("//db.onlinewebfonts.com/t/89d8fba73b6d10c300478fad02d4871d.woff2") format("woff2"), url("//db.onlinewebfonts.com/t/89d8fba73b6d10c300478fad02d4871d.woff") format("woff"), url("//db.onlinewebfonts.com/t/89d8fba73b6d10c300478fad02d4871d.ttf") format("truetype"), url("//db.onlinewebfonts.com/t/89d8fba73b6d10c300478fad02d4871d.svg#Touche") format("svg"); }

	body{
		font-family: "Touche";
	}

	.table {
		border-spacing: 0 15px;
	}

	i {
		font-size: 1rem !important;
	}

	.table tr {
		border-radius: 20px;
	}

	tr td:nth-child(n+5),
	tr th:nth-child(n+5) {
		border-radius: 0 .625rem .625rem 0;
	}

	tr td:nth-child(1),
	tr th:nth-child(1) {
		border-radius: .625rem 0 0 .625rem;
	}
</style>
</body>
</html>
