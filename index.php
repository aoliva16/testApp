    <html>  
    <head>  
    <Title>Azure SQL Database - PHP Website</Title>  
    </head>  
    <body>  
    <form method="post" action="?action=add" enctype="multipart/form-data" >  
    Emp Id <input type="text" name="t_emp_id" id="t_emp_id"/></br>  
    Name <input type="text" name="t_name" id="t_name"/></br>  
    Education <input type="text" name="t_education" id="t_education"/></br>  
    E-mail address <input type="text" name="t_email" id="t_email"/></br>  
    <input type="submit" name="submit" value="Submit" />  
    </form> 
	
    <?php  
    /*Connect using SQL Server authentication.*/  
		$connstr = getenv('SQLAZURECONNSTR_defaultConnection')
		echo $connstr
    ?>  
    </body>  
    </html>  
