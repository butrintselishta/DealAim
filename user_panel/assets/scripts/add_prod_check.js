var cat_bool = false;
var auc_title_bool = false;
var auc_price_bool = false;
//chose category qe me i shfaqe specifikat varesisht prej kategorise se zgjedhur
function cat_choose() {
    var cat = document.getElementById("choosed_cat"); //merre prej selektit vleren e zgjedhur
    if (cat.value == "") {
        cat.style.borderColor = "red";
        var cat_bool = false;
    } else if (cat.value == "Laptop") {
        cat_bool = true;
        document.getElementById("btn_spec").style.display = "block";
        document.getElementById("spec_h3").style.display = "block";
        document.getElementById("spec_laptop").style.display = "block";
        document.getElementById("spec_phone").style.display = "none";
        document.getElementById("spec_cars").style.display = "none";
        document.getElementById("spec_template").style.display = "none";
        cat.style.borderColor = "green";
        document.getElementById("auc_title").focus();
    } else if (cat.value == "Telefon") {
        cat_bool = true;
        document.getElementById("btn_spec").style.display = "block";
        document.getElementById("spec_h3").style.display = "block";
        document.getElementById("spec_laptop").style.display = "none";
        document.getElementById("spec_phone").style.display = "block";
        document.getElementById("spec_cars").style.display = "none";
        document.getElementById("spec_template").style.display = "none";
        cat.style.borderColor = "green";
        document.getElementById("auc_title").focus();
    } else if (cat.value == "Vetura") {
        cat_bool = true;
        document.getElementById("btn_spec").style.display = "block";
        document.getElementById("spec_h3").style.display = "block";
        document.getElementById("spec_laptop").style.display = "none";
        document.getElementById("spec_phone").style.display = "none";
        document.getElementById("spec_cars").style.display = "block";
        document.getElementById("spec_template").style.display = "none";
        cat.style.borderColor = "green";
        document.getElementById("auc_title").focus();
    } else if (cat.value == "Template") {
        cat_bool = true;
        document.getElementById("btn_spec").style.display = "block";
        document.getElementById("spec_h3").style.display = "block";
        document.getElementById("spec_laptop").style.display = "none";
        document.getElementById("spec_phone").style.display = "none";
        document.getElementById("spec_cars").style.display = "none";
        document.getElementById("spec_template").style.display = "block";
        cat.style.borderColor = "green";
        document.getElementById("auc_title").focus();
    } else {
        cat_bool = false;
        document.getElementById("btn_spec").style.display = "none";
        document.getElementById("spec_h3").style.display = "none";
        document.getElementById("spec_laptop").style.display = "none";
        document.getElementById("spec_phone").style.display = "none";
        document.getElementById("spec_cars").style.display = "none";
        document.getElementById("spec_template").style.display = "none";
        cat.style.borderColor = "red";
    }
}
//title check for errors
document.getElementById("auc_title").onkeyup = function() {
        var auc_title = document.getElementById("auc_title");
        if (auc_title.value.length < 5) {
            auc_title_bool = false;
            auc_title.style.border = "1px solid #FF0000";
        } else {
            auc_title_bool = true;
            auc_title.style.border = "1px solid green";
        }
    }
    //price check for errors
document.getElementById("auc_price").onkeyup = function() {
    var auc_price = document.getElementById("auc_price");
    if (auc_price.value.match(/^\d+$/) && auc_price.value < 9999) {
        auc_price.style.border = "1px solid green";
        auc_price_bool = true;
    } else {
        auc_price.style.border = "1px solid #FF0000";
        auc_price_bool = false;
    }
}

document.getElementById("auc_description").onkeyup = function() {
    var auc_from = document.getElementById("auc_description");
    console.log(auc_from.value)
}