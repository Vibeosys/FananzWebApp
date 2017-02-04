/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    $("#country_selector").countrySelect({
        defaultCountry: "ae"        
    });

    $('#btnSaveBasicInfo').on('click', function () {
        $('#frmSaveBasicInfo').submit();
    });
});
