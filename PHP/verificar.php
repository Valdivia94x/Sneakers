<div class="site-title text-center" style="width: 100%;">
    <div style="margin-left: auto; margin-right: auto; width: 60%;"><img src="archivos/img/checked.png" alt="" style="display: block;
    margin-left: auto;
    margin-right: auto;"></div>
    <h1 class="font-title" style="text-align: center;">Pago realizado con exito!</h1>
</div>



<?php

    $clienteID = "ARgYeJVD71qQo0xJDa1iptMetk3AZf0nrh7URRb2jZHZv6NTubkgiZzRJ6Wke6sAoyhH5dEBs1ATY-lE";
    $secret = "EMKTGU1Ox9tz2UoJRWzNDaVih8QLxaZzqrolHqxloB4EfIF83YaT7ox9-NagpmVyuSh6VoiMhXDFzftn";

    $login = curl_init("https://api.sandbox.paypal.com/v1/oauth2/token");

    curl_setopt($login, CURLOPT_RETURNTRANSFER, TRUE);

    curl_setopt($login, CURLOPT_USERPWD,$clienteID.":".$secret);

    curl_setopt($login, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

    $respuesta = curl_exec($login);
    

    $objRespuesta = json_decode($respuesta);

?>



