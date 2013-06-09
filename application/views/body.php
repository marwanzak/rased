<body>
	<div id="container">
		<?php 
		if($rows == ""){
			echo "What are you doing?";
			exit();
		}
		$tmpl = array ( 'table_open'  => '<table class = "content_table"
				cellpadding = "8" cellspacing = "3" align = "center">'
		);
		$this->table->set_template($tmpl);
		array_unshift($headings,"<input type = 'checkbox' id = 'all_check'/>");
		$this->table->set_heading($headings);
		?>
		<input type = "hidden" value = <?= $table ?> name = "table"/>
		<?php 
		if(count($rows)==0)
			$this->table->add_row("No inputs");
		foreach($rows as $row){
			$id = $row[0];
			array_shift($row);
			array_unshift($row,"<input type = 'checkbox' id ='".$id."' name = 'checks[]' class = 'table_checks'/>");
			array_push($row, "<span id = '".$id."' class = 'modify_span'>".lang("modify")."</span>");
			$this->table->add_row($row);
		}
		echo $this->table->generate();
		?>
		<input type = "button" value = <?= lang("add") ?> class = "add_<?= $table ?>"/>
	</div>
</body>
