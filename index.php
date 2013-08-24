<!--
	
	lhur 
	
	LocalHost Utility Research
	ver. 0.1
	
	Created by 
	Andre Rufo, www.orangedropdesign.com
	
	Project page 
	https://github.com/andrearufo/lhur

-->

<!DOCTYPE html>
<html lang="it">

<head>
	
	<meta charset="utf-8" />
	
	<title>Orange Drop Design Dev</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Andrea Rufo, www.orangedropdesign.com" />
        
    <!-- 
		the css style 
	-->
	
    <style type="text/css">
    
    *{
	    border: 0;
	    padding: 0;
	    font-family: Arial, Helvetica, sans-serif;
	    color: #2c3e50;
	    font-size: 13px;
    }
    
    strong{
	    font-weight: bold;
    }
    
    ul, form{
	    float: left;
	    width: 100%;
    }
    
    li, input{
    	box-sizing: border-box;
	    border: 1px solid #ccc;
	    border-radius: 5px;
	    float: left;
	    width: 16%;
	    margin: 2%;
	    list-style: none;
	    text-align: center;
	    overflow: hidden;
    }
    
    input{
	    width: 96%;
	    text-transform: uppercase;
	    padding: 10px 0;
    }
    
    a{
	    text-transform: uppercase;
	    text-decoration: none;
	    display: block;
	    line-height: 26px;
	    padding: 20px 0;
    }
    
    a:hover{
	    background: #eee;
    }
    
    small{
	    font-size: 10px;
    }
    
    p{
	    text-align: center;
	    clear: both;
    }
    
    .counter{
	    font-weight: bold;
    }
    
    /* responsive */
    
    @media (max-width: 768px) {
    
    	li{
    		width: 46%; 
    	}
	    
    }
     
    @media (max-width: 480px) {
    
    	li{
    		width: 96%; 
    	}
	    
    }
    </style>
    
</head>

<body>
	
	<!-- 
		the search form 
	-->
	
	<form>
		<input type="text" id="sito" name="s" autocomplete="off" placeholder="Search among the elements..."/>
	</form>
	
	<p>Items found: <span class="counter"></span></p>
	
	<!-- 
		the list of items 
	-->

	<ul class="container">
	
		<?php	
			
		$dirname = './';	//starting dir
		$n = 0;				//starting count
		
			if(file_exists($dirname)){
				$handle = opendir($dirname);
				
				//loop
				while (false !== ($file = readdir($handle))) :
				
					if(is_dir($dirname.$file)){
						if($file != "." && $file != ".."){
							
							if(isset($_GET['s']) && $_GET['s'] != ''){
								
								//results for the search
								if(strstr($file, $_GET['s'])){									
									$info = stat($file);
									echo '<li class="'.$file.'">
										<a href="'.$dirname.$file.'">
										'.$file.'</br>
										<small>'.date ('d/m/Y H:i',$info['mtime']).'</small>
										</a>
									</li>';
									
									//elements count
									$n++;
									if($n == 1) $url = $file;
										
								}
								
							}else{
								
								//all the items
								$info = stat($file);
								echo '<li title="'.$file.'">
									<a href="'.$dirname.$file.'">
									<span>'.$file.'</span></br>
									<small>'.date ('d/m/Y H:i',$info['mtime']).'</small>
									</a>
								</li>';	
							
							}
							
						}
					}
					
				endwhile;
				
				//redirect for the unique result
				if($n == 1) echo '<meta http-equiv="refresh" content="0; url='.$dirname.$url.'">';
				
				$handle = closedir($handle);
			}
			
		?>
		
	</ul>
	
	<!-- 
		localhost phpMyAdmin link 
	-->
	
	<p><a href="localhost/phpMyAdmin/?lang=en-iso-8859-1&language=English">Launch phpMyAdmin on localhost</a></p>
	
	<!-- 
		the scripts 
	-->
	
    <script src="http://code.jquery.com/jquery.js"></script>
        
    <script type="text/javascript">
    
    //focus on researc form input	
    function formfocus() {
	   	document.getElementById('sito').focus();
	}
	
	window.onload = formfocus;
    
    // dinamic research
    $(document).ready(function(){
    	
    	// start elements count
    	var n = $('li').size();
    	$('.counter').html(n);
		
		//trigger
    	$('#sito').keyup(function () {
    		
    		$('li').hide().removeClass('showed');
    	
	    	var value = $(this).val();
	    	var regex = new RegExp(value, 'i');
	    	
	    	$('li').each(function(){
	    		if($(this).text().search(regex) > 0){
	    			$(this).show().addClass('showed');
				}
	    	});
	    	
		    // elements showed count
		    n = $('.showed').size();
		    $('.counter').html(n);
		    
		    if(n == 0){
		    	$('.counter').html('nessuno');
			    $('li').show();
		    }
	    
	    }); // keyup()
	    
    }); // ready()
    
    </script>
    
</body>

</html>