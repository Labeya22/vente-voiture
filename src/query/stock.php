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
    $req = $pdo->prepare("UPDATE stocks SET stock = ?  WHERE vehiculeid = ?");
    return $req->execute([$reste, $stock['vehiculeid']]);
}