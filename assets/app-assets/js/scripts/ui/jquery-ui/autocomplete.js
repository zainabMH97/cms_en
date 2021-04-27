/*=========================================================================================
    File Name: autocomplete.js
    Description: jQuery UI autocomplete
    ----------------------------------------------------------------------------------------
    Item Name: Modern Admin - Clean Bootstrap 4 Dashboard HTML Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(document).ready(function(){

	/************************************
	*			Auto Complete			*
	************************************/

	var peopleTags = [
        "Aaron",
        "Abel",
        "Bacon",
        "Barry",
        "Clancy",
        "Cornstalk",
        "Daniel",
        "David",
        "Edison",
        "Frank",
        "George",
        "Hamilton",
        "Irvine",
        "Jackson",
        "Kelly",
        "Lumb",
        "Magee",
        "Newton",
        "Olson",
        "Paul",
        "Quine",
        "Roy",
        "Smith",
        "Tony",
        "Young",
        "Zampa"
    ];
    $( ".category-default" ).autocomplete({
        source: peopleTags
    });

  

});