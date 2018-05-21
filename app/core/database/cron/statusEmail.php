<?php
/**
 * This script will query the database at regular
 * intervals to alert users when the status
 * of their package has changed
 */
/**
 * Bootstrap the app similarly to how we initialize
 * the application on the main page in
 * /public/index.php
 */
require __DIR__ . '/../../bootstrap.php';
$alerts = Email::findAll()
               ->where(['sent'], ['='], [0])
               ->get();
/**
 * Get requisite data for each email
 */
foreach ($alerts as $alert) {
    $alert->user = User::find()
                       ->where(['id'], ['='], [$alert->userId])
                       ->get();
    $alert->package = Package::find()
                             ->where(['id'], ['='], [$alert->packageId])
                             ->get();
    $alert->package->status = PackageStatus::find()
                                           ->where(['id'], ['='], [$alert->package->packageStatus])
                                           ->get()->type;
    $to = $alert->user->email;
    $subject = "Status of Package #{$alert->package->id} Updated";
    $message = "The status of your order has been updated to: {$alert->package->status}";
    $headers = 'From: no-reply@prostoffice.pro';
    $emailSent = mail($to, $subject, $message, $headers);
    // var_dump("Email sent");
    /**
     * Update package after successful send
     */
    if ($emailSent) {
        Email::update([
            'sent' => 1
        ])
             ->where(['userId', 'packageId'], ['=', '=', '='], [$alert->userId, $alert->packageId])
             ->get();
    }
}