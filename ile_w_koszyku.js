	$.ajax({
        url: 'ile_w_koszyku.php',
    	dataType: 'json',
    })
    .done(function(data)
    {  
        $('#koszyk-ilosc').text(data.ilosc);
    });

