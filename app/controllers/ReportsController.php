<?php

namespace App\Controllers;

use Address;
use App\Core\Auth;
use DateTime;
use Package;
use PackageStatus;
use PostOffice;
use State;
use Transaction;
use User;

class ReportsController
{

    public function getReports()
    {
        $user = Auth::user();
        if ($user) {
            if ($user->roleId === 2 || $user->roleId === 1) {
                $packageStatuses = PackageStatus::selectAll();
                if ($user->roleId === 1) {
                    $postOffices = PostOffice::selectAll();

                    return view('dashboard/reports', compact('packageStatuses', 'postOffices'));
                }

                return view('dashboard/reports', compact('packageStatuses'));
            }

            if ($user->roleId === 3) {
                return redirect('account');
            }

            if ($user->roleId === 1) {
                return redirect('admin');
            }
        }

        return redirect('login');
    }

    public function showReports()
    {
        $user = Auth::user();
        if ($user) {
            if ($user->roleId === 3) {
                return redirect('account');
            }
            $cols = [];
            $ops = [];
            $values = [];
            $startDate = '';
            $endDate = '';
            if ($user->roleId === 2) {
                $cols = ['postOfficeId'];
                $ops = ['='];
                $values = [$user->roleId];
                $selectedPostOffice = PostOffice::find()
                                                ->where(['id'], ['='], [$user->postOfficeId])
                                                ->get();
            } else if (isset($_POST['postOfficeSelector'])) {
                $cols[] = 'postOfficeId';
                $ops[] = '=';
                $values[] = $_POST['postOfficeSelector'];
                $selectedPostOffice = PostOffice::find()
                                                ->where(['id'], ['='], [$_POST['postOfficeSelector']])
                                                ->get();
            }
            if ($user->roleId === 2 || $user->roleId === 1) {
                $packageStatuses = PackageStatus::selectAll();
                if (isset($_POST['startDate']) && $_POST['startDate'] !== '') {
                    $cols[] = 'createdAt';
                    $ops[] = '>=';
                    $values[] = date('Y-m-d H:i:s', strtotime($_POST['startDate']));
                    $date = new DateTime($_POST['startDate']);
                    $startDate = $date->format('M j, Y');
                }
                if (isset($_POST['endDate']) && $_POST['endDate'] !== '') {
                    $cols[] = 'createdAt';
                    $ops[] = '<=';
                    $values[] = date('Y-m-d H:i:s', strtotime($_POST['endDate']));
                    $date = new DateTime($_POST['endDate']);
                    $endDate = $date->format('M j, Y');
                }
                // dd( $_POST , $cols , $ops , $values );
                if (isset($_POST['reportOption'])) {
                    if ($_POST['reportOption'] === 'queryPackages') {
                        if (isset($_POST['packageStatusSelector']) && $_POST['packageStatusSelector'] !== 'all') {
                            $cols[] = 'packageStatus';
                            $ops[] = '=';
                            $values[] = $_POST['packageStatusSelector'];
                        }
                        // dd( $_POST , $cols , $ops , $values );
                        $packages = Package::findAll()
                                           ->where($cols, $ops, $values)
                                           ->orderBy('createdAt', 'DESC')
                                           ->get();
                        foreach ($packages as $package) {
                            $package->destination = Address::find()
                                                           ->where(
                                                               ['id'],
                                                               ['='],
                                                               [$package->destinationId]
                                                           )
                                                           ->get();
                            $package->destination->state = State::find()
                                                                ->where(
                                                                    ['id'],
                                                                    ['='],
                                                                    [$package->destination->stateId]
                                                                )
                                                                ->get()->state;
                            $package->returnAddress = Address::find()
                                                             ->where(
                                                                 ['id'],
                                                                 ['='],
                                                                 [$package->returnAddressId]
                                                             )
                                                             ->get();
                            $package->returnAddress->state = State::find()
                                                                  ->where(
                                                                      ['id'],
                                                                      ['='],
                                                                      [$package->returnAddress->stateId]
                                                                  )
                                                                  ->get()->state;
                            $package->status = PackageStatus::find()
                                                            ->where(
                                                                ['id'],
                                                                ['='],
                                                                [$package->packageStatus]
                                                            )
                                                            ->get()->type;

                            $package->user = User::find()
                                                 ->where(['id'], ['='], [$package->userId]);
                        }
                        if ($user->roleId === 1) {
                            $postOffices = PostOffice::selectAll();

                            return view(
                                'dashboard/reports',
                                compact(
                                    'packageStatuses',
                                    'postOffices',
                                    'packages',
                                    'selectedPostOffice',
                                    'startDate',
                                    'endDate'
                                )
                            );
                        }

                        return view(
                            'dashboard/reports',
                            compact('packageStatuses', 'packages', 'selectedPostOffice', 'startDate', 'endDate')
                        );
                    }

                    $transactions = Transaction::findAll()
                                               ->where($cols, $ops, $values)
                                               ->orderBy('createdAt', 'DESC')
                                               ->get();
                    $totalTransactionsCost = 0;
                    foreach ($transactions as $transaction) {
                        $transaction->customer = User::find()
                                                     ->where(
                                                         ['id'],
                                                         ['='],
                                                         [$transaction->customerId]
                                                     )
                                                     ->get();
                        $totalTransactionsCost += $transaction->cost;
                    }

                    // dd( $_POST , $cols , $ops , $values, $transactions );
                    if ($user->roleId === 1) {
                        $postOffices = PostOffice::selectAll();

                        return view(
                            'dashboard/reports',
                            compact(
                                'packageStatuses',
                                'postOffices',
                                'transactions',
                                'totalTransactionsCost',
                                'selectedPostOffice',
                                'startDate',
                                'endDate'
                            )
                        );
                    }

                    return view(
                        'dashboard/reports',
                        compact(
                            'packageStatuses',
                            'transactions',
                            'totalTransactionsCost',
                            'selectedPostOffice',
                            'startDate',
                            'endDate'
                        )
                    );
                }
            } else if ($user->roleId === 3) {
                return redirect('account');
            } else if ($user->roleId === 1) {
                return redirect('admin');
            }
        }

        return redirect('login');
    }
}