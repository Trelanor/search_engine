$(document).ready(function(){
    $("#search").keyup(function(){
		
        var recherche = $(this).val();
		       
            $.ajax({
                type : "GET",
                url : "search.php",
				dataType: 'json',
                data : {
					search: recherche
				},
				
                success : function(server_response){
					
					console.log(server_response);
					
					// on recupere le template
					var template = $('#template').html();
					
					// on le parse
					Mustache.parse(template);   // optional, speeds up future uses
					
					// on injecte les variables
					var rendered = Mustache.render(template, {datas: server_response});
					
					// on injecte le template rendu dans la div #content
					$('#content').html(rendered);
					
					
                }
            });
        
    });
});