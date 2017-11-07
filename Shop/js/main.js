var db = openDatabase('sos01_offline_db', '1.0', 'Offline DB', 2 * 1024 * 1024);

db.transaction(function(tx) {
    /*
        CREATE THE SQL DATA TABLE TO STORE THE LOGGED IN USER
    */
    tx.executeSql("CREATE TABLE IF NOT EXISTS user (email unique, status TEXT, balance TEXT)", []);

});


$(function() {

    $('#login-form-link').click(function(e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#register-form-link').click(function(e) {
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });

});


function formSubmit() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var confirm_password = document.getElementById("confirm-password").value;

    var dataString = "email=" + email + "&password=" + password + "&confirm_password=" + confirm_password;

    jQuery.ajax({
        url: "http://localhost/OnlineShop/API/new_user_register_api.php",
        data: dataString,
        type: "POST",
        success: function(data) {
            $("#register-form").html(data);
            console.log('success');
        },
        error: function() {
            console.log('error');
        }
    });
    return true;
}

function formLogin() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    var dataString = "email=" + email + "&password=" + password;

    jQuery.ajax({
        url: "http://localhost/OnlineShop/API/fetch_user_login_api.php",
        data: dataString,
        type: "POST",
        success: function(data) {
            //$("#login-form").html(data);
            console.log('success');

            var obj = jQuery.parseJSON(data);
            var log_email = obj[0].email;
            var log_status = obj[0].status;
            var log_balance = obj[0].balance;

            db.transaction(function(tx) {
                tx.executeSql("CREATE TABLE IF NOT EXISTS user (email unique, status TEXT, balance TEXT)", []);

                //empty table on every new log in
                tx.executeSql('DELETE FROM USER');

                //put data into local DB
                tx.executeSql('INSERT INTO user (email, status, balance) VALUES (?,?,?)', [log_email, log_status, log_balance]);

            }, null);

            window.location.href = "store.html";

        },
        error: function() {
            console.log('error');
        }
    });
    return true;
}

function getCustomer() {
    var count = 0;
    document.querySelector('#user_session').innerHTML = '';
    db.transaction(function(tx) {
        tx.executeSql('SELECT * FROM user', [], function(tx, results) {
            var len = results.rows.length,
                i;

            for (i = 0; i < len; i++) {
                var sess_email = results.rows.item(i).email;
                var sess_status = results.rows.item(i).status;
                var sess_balance = results.rows.item(i).balance;

                var sees_user = "<li>" + sess_email + "</li><li>Balance : " + sess_balance + "</li>";

                //console.log(sees_user);
                document.querySelector('#user_session').innerHTML += sees_user;
            }
        });
    });
    // This returns always 0!
    //return count;
}


$(document).ready(function() {
    var url = "http://localhost/OnlineShop/API/fetch_products_api.php";
    $.getJSON(url, function(result) {
        console.log(result);
        $.each(result, function(i, field) {
            var productName = field.productName;
            var productDescription = field.productDescription;
            var price = field.price;
            var discountPercentage = field.discountPercentage;
            var discountAmount = field.discountAmount;
            var adjustedPrice = field.adjustedPrice;
            var id = field.id;
            $("#listproducts").append("<tr><form name=" + id + " method='post'><td>" + productName + "</td><td>" + productDescription + "</td><td>" + price + "</td><td>" + discountPercentage + "</td><td>" + discountAmount + "</td><td>" + adjustedPrice + "</td><td><input type='hidden' name='id' id='id' value=" + id + "><input type='hidden' name='adjustedPrice' id='adjustedPrice' value=" + adjustedPrice + "><input type='button' class='form-control btn btn-login' onclick='return formBuy();' value='Buy'> </td></form></tr>");

        });
    });
});


function formBuy() {
    var id = document.getElementById("id").value;
    var adjustedPrice = document.getElementById("adjustedPrice").value;

    //get user and balance
    var userBalance = 0;
    var sess_email = "";

    db.transaction(function(tx) {
        tx.executeSql('SELECT * FROM user', [], function(tx, results) {
            var len = results.rows.length,
                i;

            for (i = 0; i < len; i++) {
                sess_email = results.rows.item(i).email;

                var dataString = "email=" + sess_email;

                jQuery.ajax({
                    url: "http://localhost/OnlineShop/API/fetch_user_balance_api.php",
                    data: dataString,
                    type: "POST",
                    success: function(data) {
                        //$("#login-form").html(data);
                        console.log('success');

                        var obj = jQuery.parseJSON(data);

                        var log_status = obj[0].status;
                        userBalance = obj[0].balance;
                    },
                    error: function() {
                        console.log('error');
                    }
                });
            }
        });
    });
    //if userBalance < adjustedPrice => topup otherwise 
    console.log('user balanace ' + userBalance);
    console.log('adjusted price ' + adjustedPrice);

    if (userBalance < adjustedPrice) {
        console.log("Balance too low for purchase. Topup!");
        window.location.href = "topup.html";
    } else {
        var dataString = "email=" + sess_email + "&id=" + id + "&adjustedPrice=" + adjustedPrice;

        jQuery.ajax({
            url: "http://localhost/OnlineShop/API/purchase_products_api.php",
            data: dataString,
            type: "POST",
            success: function(data) {
                console.log('success');
                alert('Purchase successful!');
                window.location.href = "store.html";
            },
            error: function() {
                console.log('error');
            }
        });
        return true;
    }

}


function formTopup() {
    var topupamnt = document.getElementById("topupamnt").value;
    console.log('Top up amount ' + topupamnt);
    db.transaction(function(tx) {
        tx.executeSql('SELECT * FROM user', [], function(tx, results) {
            var len = results.rows.length,
                i;
            for (i = 0; i < len; i++) {
                sess_email = results.rows.item(i).email;
                var dataString = "email=" + sess_email + "&topupamnt=" + topupamnt;

                jQuery.ajax({
                    url: "http://localhost/OnlineShop/API/top_up_user_balance.php",
                    data: dataString,
                    type: "POST",
                    success: function(data) {
                        window.location.href = "store.html";
                    },
                    error: function() {
                        console.log('error');
                    }
                });
            }
        });
    });
    return true;
}