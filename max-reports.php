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

echo 'Using php functions: ';
maxReportsFunctions($reportage);
echo '<hr>';
echo 'Using php functions variant 2: ';
maxReportsFunctions2($reportage);
echo '<hr>';
echo 'Using algorithm: ';
maxReportsAlgorithm($reportage);
echo '<hr>';

/***
 * Find user with max number of reports
 * with using php functions
 * @param array $data
 */
function maxReportsFunctions(array $data)
{
    $result = [];
    foreach ($data as $user) {
        if (empty($user['reportsTo'])) {
            continue;
        }

        if (!isset($result[$user['reportsTo']])) {
            $result[$user['reportsTo']] = 1;
        } else {
            $result[$user['reportsTo']]++;
        }
    }
    ksort($result);

    echo key($result);
}

/***
 *  Find user with max number of reports
 * with using php functions v2
 * @param array $data
 */
function maxReportsFunctions2(array $data)
{
    $result = [];
    $reportsName = [];
    foreach ($data as $user) {
        foreach ($user as $key => $value) {
            if (($key == 'reportsTo') && !empty($value)) {
                array_push($reportsName, $value);
            }
        }

        $countedRep = array_count_values($reportsName);
        asort($countedRep);
        $result = array_slice($countedRep, -1);
    }

    $result = key($result);
    echo $result;
}

/***
 * Find user with max number of reports
 * with using algorithm
 * @param array $data
 */
function maxReportsAlgorithm(array $data)
{
    $numbRep = [];
    foreach ($data as $user) {
        if (empty($user['reportsTo'])) {
            continue;
        }
        if (!isset($numbRep[$user['reportsTo']])) {
            $numbRep[$user['reportsTo']] = 1;
        } else {
            $numbRep[$user['reportsTo']]++;
        }
    }

    $maxNumb = 0;
    $maxName = '';
    foreach ($numbRep as $name => $value) {
        if ($maxNumb <= $value) {
            $maxName = $name;
            $maxNumb = $value;
        }
    }

    echo $maxName;
}