

function saveToCookie() {    
    $("input, select").each(function( index ) {
        $.cookie($(this).attr("id"), $( this ).val(), { expires: 30, path: '/' });
    });
}


function getMonthText(index) {
    return Months[index];
}
function getMonthInt(text) {
    var date = new Date(text + "8,  2014");
    return date.getMonth();
}
function formatDate(dateObj) {
    var year = dateObj.getFullYear();
    var month = getMonthText(dateObj.getMonth());
    return (month +" " + year);
}

function toMoney(mon) {
    var div = $('<input value="'+mon+'"></input>');
    $(div).formatCurrency();
    return $(div).val();
}
function restoreFromCookie() {
    
    var cookiesObj = $.cookie();   
    var thecookie = {};
    if(cookiesObj.length > 0) {
        thecookie = cookiesObj[0];
    }    
    for (var index in cookiesObj) {
		$("#"+index).val(cookiesObj[index]);
    }    
}

function mtgCalc(originalloanamount, interestrate, loanlengthyears) {
    
    
    var nummonths = loanlengthyears*12;
    var monthlyinterest = (interestrate / (12 * 100));
    var denominator = 1  - Math.pow( 1 + monthlyinterest, 0-nummonths);
    var monthlypaymentraw = (originalloanamount) * (monthlyinterest / denominator);
    
    var totalinterestraw = (monthlypaymentraw * nummonths) - originalloanamount;
    var totalinterestmonthlyraw = totalinterestraw / nummonths;
    var totalamountraw = totalinterestraw + originalloanamount;
    
    
    var mtg = new Object();
    mtg['originalloanamount'] = Math.round(originalloanamount * 100) / 100;
    mtg['interestrate'] =Math.round(interestrate *10000) / 10000;
    mtg['loanlengthyears'] = loanlengthyears;
    mtg['monthly'] = Math.round(monthlypaymentraw* 100) / 100;
    mtg['totalinterest'] = Math.round(totalinterestraw* 100) / 100;
    mtg['totalpaid'] = Math.round(totalamountraw* 100) / 100;
    
    return mtg;	
        
    
}



// Handler for .ready()
$(function() {

/*
 * Dynamic Dialog example was not used in this tutorial. 
 * Comment out hide() enable. 
*/ 


   $("#LaunchDialogButton").button()
      .click(function() {
        
        //Comment out the remove and see the div count fill up. 
        console.log($("div").length); 
		$('<div/>', {
            text: 'Hello Dynamic Dialog.'
		}).dialog({
         title: 'Sample Dialog Title.',
         show: {effect: 'fold', duration: 250},
         hide: {effect: 'fade', duration: 250},               
         width: 300, height: 200,
         modal:true,
         close: function(){
			$(this).remove(); //remove from DOM
		},
         buttons: {
            "OK": function() {
               alert("doSomething()");
               $(this).dialog("close"); 
            }, 
            "Cancel": function() { 
               $(this).dialog("close"); 
            } 
         }

      });
   });

	//hide dynamic dialog
   $("#LaunchDialogButton").hide();


    $( "input" ).focus(function(){
		$( this ).addClass("ui-state-highlight");
    }).blur(function(){
		$( this ).removeClass("ui-state-highlight");
		var num = $(this).asNumber();

        if ($(this).hasClass("money")) {
            $( this ).val(toMoney(num));
        }
        
        if ($(this).hasClass("percent")) {
            $( this ).val(num + "%");
        }

        if ($(this).hasClass("number")) {
            $( this ).val(num);
        }

    }).change(function(){
        $("#CalculateButton").trigger("click");
    }).keyup(function(){
        $("#CalculateButton").trigger("click");
    });
    
    restoreFromCookie();
    $("#originalloanamount").focus();
    

    $("button").button();


    $(".dialoglink").each(function() {
       
        var targetdialog = $(this).attr("data-target");
        console.log(targetdialog);
        
        $( this ).click(function(){
            $("#"+ targetdialog ).dialog({
				show: {effect: 'fold', duration: 250},
				hide: {effect: 'fade', duration: 250}
             }).dialog( "option", "position", { my: "center", at: "center", of: window } );
    
            $(window).resize(function() {
                $("#"+  targetdialog ).dialog( "option", "position", { my: "center", at: "center", of: window } );
            });
    
        });
        
        
    });

    $( "#CalculateButton" ).click(function(){
                
        var originalloanamount = $('#originalloanamount').asNumber();
        var interestrate = $('#interestrate').asNumber();
        var loanlength = $('#loanlength').asNumber();

        var mtgObj = mtgCalc(originalloanamount, interestrate, loanlength);
         
        var template_vars = {
            monthly: toMoney(mtgObj['monthly']),
            loanlength: loanlength,
            totalinterestpaid: toMoney(mtgObj['totalinterest']),
            totalpaid: toMoney(originalloanamount + mtgObj['totalinterest'])
        };
        
        var resultshtml = Mustache.render(Templates['results'], template_vars);
        $("#results").html(resultshtml);
    
		saveToCookie();
    }).trigger("click");
    
    


});

