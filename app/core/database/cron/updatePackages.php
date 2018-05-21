<?php
//
// /**
//  * This script will query the database at regular
//  * intervals to update the status of packages
//  * for alerting the user
//  */
//
// require __DIR__ . '/../../bootstrap.php';
//
// $processing = Package::findAll()
//                      ->where(['packageStatus'], ['='], [1])
//                      ->get();
//
// $enRoute = Package::findAll()
//                   ->where(['packageStatus'], ['='], [2])
//                   ->get();
//
// $delivered = Package::findAll()
//                     ->where(['packageStatus'], ['='], [3])
//                     ->get();
//
// $cancelledList = Package::findAll()
//                         ->where(['packageStatus'], ['='], [4])
//                         ->get();
//
// /**
//  * Increment packageStatus property of packages collected above
//  */
// $ctr = 0;
// try {
//     foreach ($processing as $package) {
//         $rand = random_int(1, 10);
//         if ($rand <= 1) {
//             // var_dump( $package );
//             Package::update([
//                 'packageStatus' => $package->packageStatus + 1
//             ])
//                    ->where(['id'], ['='], [$package->id])
//                    ->get();
//             $ctr++;
//         }
//     }
// } catch (Exception $e) {
//     echo $e->getMessage();
// }
// $ctr = 0;
// try {
//     foreach ($enRoute as $package) {
//         $rand = random_int(1, 10);
//         if ($rand <= 1) {
//             Package::update([
//                 'packageStatus' => $package->packageStatus + 1
//             ])
//                    ->where(['id'], ['='], [$package->id])
//                    ->get();
//             $ctr++;
//         }
//     }
// } catch (Exception $e) {
//     echo $e->getMessage();
// }
// $ctr = 0;
// try {
//     foreach ($delivered as $package) {
//         $rand = random_int(1, 10);
//         if ($rand <= 1) {
//             Package::update([
//                 'packageStatus' => $package->packageStatus + 1
//             ])
//                    ->where(['id'], ['='], [$package->id])
//                    ->get();
//             $ctr++;
//         }
//     }
// } catch (Exception $e) {
//     echo $e->getMessage();
// }
// $ctr = 0;
// try {
//     foreach ($cancelledList as $package) {
//         $rand = random_int(1, 10);
//         if ($rand <= 1) {
//             Package::update([
//                 'packageStatus' => 1
//             ])
//                    ->where(['id'], ['='], [$package->id])
//                    ->get();
//             $ctr++;
//         }
//     }
// } catch (Exception $e) {
//     echo $e->getMessage();
// }