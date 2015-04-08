$(function(){
	$(".plng").click(function(){
		$('.planningjs').hide();
			var semaine = $(this).attr("href");
			$.post('../planning-prof.php',{semaine:semaine,action:"getSemaine"},function(data){
					$('.planningjs').slideDown().html(data);
			});
	return false;
	});
});