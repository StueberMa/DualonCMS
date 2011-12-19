<!-- Create new products for the catalog -->
<h1>Produkt erstellen</h1>
<?php
	echo $this->Form->create('Product', array('enctype' => 'multipart/form-data'));
	echo $this->Form->input('name', array('label' => 'Artikel:'));
	echo $this->Form->input('description', array('rows' => '4', 'label' => 'Beschreibung:'));
	echo $this->Form->input('price', array('label' => 'Preis:'));
	echo $this->Form->file('Product.submittedfile');
	echo $this->Form->end('Save Article');
?>