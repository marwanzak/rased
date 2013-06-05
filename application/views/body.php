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
		$this->table->set_heading($headings);
		foreach($rows as $row)
		$this->table->add_row($row);
		echo $this->table->generate();
		

		?>
	</div>
</body>
