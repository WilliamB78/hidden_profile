<?php

//include du haut à mettre 

?>
<form action="#" method="post">
	<fieldset>
		<legend>Laissez-nous un message</legend>
		<label for="lastname">Nom</label>
		<input type="text" name="lastname" id="lastname" required>

		<label for="email">Email</label>
		<input type="email" name="email" id="email" required>

		<label for="telephone">Téléphone</label>
		<input type="tel" name="telephone" id="telephone" required>

		<label for="">Vos questions</label>
		<!-- ajouter un name pour les questions en fonction de la bdd -->
		<textarea id="" name="" cols="30" rows="10"></textarea>
	</fieldset>
	<input type="submit" value="Envoyer">
</form>
<?php
//include du footer à mettre 

?>