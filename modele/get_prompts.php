<?php
function get_prompt($offset, $limit)
{
global $bdd;
$offset = (int) $offset;
$limit = (int) $limit;

$req = $bdd->prepare('SELECT Id, phrase FROM prompts ORDER BY Id ASC LIMIT
:offset, :limit');

$req->bindParam(':offset', $offset, PDO::PARAM_INT);
$req->bindParam(':limit', $limit, PDO::PARAM_INT);
$req->execute();
$prompts = $req->fetchAll();
return $prompts;
}