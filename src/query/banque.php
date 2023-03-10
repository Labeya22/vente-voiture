<?php



function hasSecret(string $secretCode,$account,  $userid): bool {
    $pdo = DATABASE;
    $req = $pdo->prepare("SELECT * 
    FROM banques 
    WHERE numberAccount = ? AND secret = ?  AND  utilisateurid = ?");
    $req->execute([$account, $secretCode, $userid]);
    return !empty($req->fetch());
}

function hasNumberAccount(string $numberAccount, $userid): bool {
    $pdo = DATABASE;
    $req = $pdo->prepare("SELECT * FROM banques WHERE numberAccount = ? AND utilisateurid = ?");
    $req->execute([$numberAccount, $userid]);
    return !empty($req->fetch());
}

function getBanque($userid) {
    $pdo = DATABASE;
    $req = $pdo->prepare("SELECT * 
    FROM banques 
    WHERE utilisateurid = ?");
    $req->execute([$userid]);
    return $req->fetch();
}

function updateSoldeBanque($userid, $solde) {
    $pdo = DATABASE;
    $req = $pdo->prepare("UPDATE banques SET solde = ?, update_at = NOW() WHERE utilisateurid = ?");
    return $req->execute([$solde, $userid]);
}

function createBanque(string $userid): bool {
    $pdo = DATABASE;
    $banque = getBanque($userid);
    if (empty($banque)) {
        $id = generateToken(60);
        $numberAccount = generateToken(8);
        $query = "INSERT INTO banques 
        SET banque_id = ?, utilisateurid = ?, 
        numberAccount = ?,
        update_at = NOW()";
        $req = $pdo->prepare($query);
        return $req->execute([$id, $userid, $numberAccount]);
    }
    return false;
}