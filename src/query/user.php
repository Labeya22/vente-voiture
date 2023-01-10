<?php



function hasFieldOrField($value, ...$fields) {
    $field = implode(' OR ', array_map(function ($field) {
        return "$field = :field";
    }, $fields));
    $pdo = getPDO();

    $req = $pdo->prepare("SELECT * FROM utilisateurs WHERE $field");
    $req->execute([':field' => $value]);
    $fetch = $req->fetch();
    
    return $fetch === false;
}

function hasFieldUser($field, $value , $id = null) {
    $pdo = getPDO();
    if (!is_null($id)) {
        $req = $pdo->prepare("SELECT * FROM utilisateurs WHERE $field = ? AND utilisateur_id != $id");
        $req->execute([$value]);
        return !empty($req->fetch());
    }
    $req = $pdo->prepare("SELECT * FROM utilisateurs WHERE $field = ?");
    $req->execute([$value]);
    return !empty($req->fetch());

}

function createUser(PDO $pdo, array $data): bool
{
    $query = "INSERT INTO utilisateurs SET nom = :nom, prenom = :prenom ,
    utilisateur = :utilisateur, token = :token, code = :code,
    email = :email, password = :password,
    create_at = NOW()";
    return $pdo->prepare($query)->execute([
        ':nom' => $data['nom'],
        ':prenom' => $data['prenom'],
        ':utilisateur' => $data['utilisateur'],
        ':email' => $data['email'],
        ':token' => generateToken(60),
        ':code' => generateToken(8),
        ':password' => hashPass($data['password']),
    ]);
}

function getUser($pdo, $key, $value) {
    $query = "SELECT * FROM utilisateurs WHERE $key = ?";
    $req = $pdo->prepare($query);
    $req->execute([$value]);
    return $req->fetch();
}

function getUserFieldOrField($value, ...$fields) {
    $field = implode(' OR ', array_map(function ($field) {
        return "$field = :field";
    }, $fields));
    $pdo = getPDO();

    $req = $pdo->prepare("SELECT * FROM utilisateurs WHERE $field");
    $req->execute([':field' => $value]);
    $fetch = $req->fetch();
    
    return $fetch === false ? [] : $fetch;
}

function confirmUser($pdo, $id) {
    $query = "UPDATE utilisateurs SET 
    isconfirm = 1, code = NULL, 
    confirm_at = NOW(), token = NULL
    WHERE utilisateur_id = ? ";
    return $pdo->prepare($query)->execute([$id]);
}