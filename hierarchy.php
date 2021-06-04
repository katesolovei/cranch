<?php
// array with initial data
$reportage = [
    [
        'user' => 'Melissa Jones',
        'reportsTo' => false
    ],
    [
        'user' => 'Sam Little',
        'reportsTo' => 'Jason Beake'
    ],
    [
        'user' => 'Colleen Adams',
        'reportsTo' => 'Amy Barnes'
    ],
    [
        'user' => 'Amy Barnes',
        'reportsTo' => 'Melissa Jones'
    ],
    [
        'user' => 'Allison Meyers',
        'reportsTo' => 'Colleen Adams'
    ],
    [
        'user' => 'Jason Beake',
        'reportsTo' => 'Amy Barnes'
    ],
];

$array = hierarchyDesc($reportage);
$count = count($array);
for ($i = 0; $i < $count; $i++) {
    echo $array[$i] . '<br><hr>';
}

/***
 * @param array $data
 * @param string $searchUser
 * @return array
 */
function hierarchyDesc(array $data, string $searchUser = 'Allison Meyers'): array
{
    static $intermRes = [];
    $result = [];
    foreach ($data as $key => $user) {
        /** determining the boss and creating intermediate data array
         * if not director (top hierarchy) call the function again
         */
        if ($user['user'] === $searchUser) {
            $searchUser = $user['reportsTo'];
            array_push($intermRes, $searchUser);
            $newData = array_splice($data, 0, $key);
            hierarchyDesc($newData, $searchUser);
        }
    }

    $lengthRes = count($intermRes);
    for ($i = $lengthRes - 1; $i >= 0; $i--) {
        array_push($result, strval($intermRes[$i]));
    }

    return $result;
}