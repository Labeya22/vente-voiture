<?php


function getStock($product) {
    $pdo = DATABASE;
    $req = $pdo->prepare("SELECT * FROM stocks WHERE vehiculeid = ?");
    $req->execute([$product]);
    return $req->fetch();
}

function stockUpdate($productid, int $quantity) {
    $pdo = DATABASE;
    $stock = getStock($productid);
    $reste = ($stock['stock'] - $quantity);
    if ($stock['stock'] < $reste) {
        $req = $pdo->prepare("UPDATE stocks SET stock = ?  WHERE vehiculeid = ? AND stock >=");
        return $req->execute([$reste, $stock['vehiculeid']]);
    }

    return false;
    
}

function createSock($product, $stock): bool {
    $pdo = DATABASE;
    $generateId = generateToken(60);
    $req = $pdo->prepare("INSERT INTO stocks SET vehiculeid = ?, stock = ?,stock_id = ?, create_at = NOW()");
    return $req->execute([$product, $stock, $generateId]);
}