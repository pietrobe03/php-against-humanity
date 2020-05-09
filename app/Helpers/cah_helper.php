<?php
/**
 * Generates a randomized string
 * @param int $length Length of the string
 * @return string Randomized string
 */
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function isLoggedIn() {
    return getUserSession() != null;
}

function getUserSession() {
    $userSessionModel = new \App\Models\UserSessionModel();

    static $sessionDataAnswer = false;
    if ($sessionDataAnswer !== false) {
        return $sessionDataAnswer;
    }

    $sessionToken = get_cookie("cah_token");
    if (!empty($sessionToken)) {
        $sessionData = $userSessionModel->where("sessionToken", $sessionToken)->first();
        if ($sessionData != null) {
            // Logged in
            $sessionDataAnswer = array(
                "username" => $sessionData["username"],
                "usertag" => $sessionData["usertag"],
                "id" => $sessionData["id"]
            );
            $userSessionModel->where("sessionToken", $sessionToken)->set("lastSeen", time())->update();
            return $sessionDataAnswer;
        }
    }
    return null;
}

function url_redirect($to) {
    header("Location: ".$to);
    die("<html><head><script>window.location='$to';</script></head><body>Your browser does not support automated redirection to <a href='$to'>$to</a>.</body></html>");
}