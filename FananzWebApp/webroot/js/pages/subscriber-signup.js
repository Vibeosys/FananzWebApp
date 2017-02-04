/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    $("#cor_country_selector").countrySelect({
        defaultCountry: "ae",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        //preferredCountries: ['ca', 'gb', 'us']
    });
    $("#fl_country_selector").countrySelect({
        defaultCountry: "ae",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        //preferredCountries: ['ca', 'gb', 'us']
    });
});
