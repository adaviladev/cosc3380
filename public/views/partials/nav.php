<?php

use App\Core\Auth;

?>
<nav class="nav-item">
    <ul class="clearfix menu navigation">
        <li class="parent-menu nav-item"><a href="/about">About</a></li>
        <li class="parent-menu nav-item"><a href="/locations">Locations</a></li>
        <li class="parent-menu nav-item"><a href="/contact">Contact Us</a></li>
        <?php if (empty(Auth::user())) { ?>
            <li class="parent-menu nav-item"><a href="/login">Login</a></li>
            <li class="parent-menu nav-item"><a href="/register">Register</a></li>
        <?php } else if (Auth::user()->roleId === 1) { ?>
            <li class="parent-menu nav-item">
                <a href="/admin">Admin</a>
                <ul class="sub-menu">
                    <?php if (false) { ?>
                        <li class="nav-item">
                            <a href="/admin/packages">Packages</a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/transactions">Transactions</a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a href="/admin/post-offices">Post Offices</a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/employees">Employees</a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/users">Users</a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/reports">Reports</a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/emails">Emails</a>
                    </li>
                </ul>
            </li>
        <?php } else if (Auth::user()->roleId === 2) { ?>
            <li class="parent-menu nav-item">
                <a href="/dashboard">Dashboard</a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="/dashboard/packages">Packages</a>
                    </li>
                    <li class="nav-item">
                        <a href="/dashboard/customers">Customers</a>
                    </li>
                    <li class="nav-item">
                        <a href="/dashboard/transactions">Transactions</a>
                    </li>
                    <li class="nav-item">
                        <a href="/dashboard/employees">Employees</a>
                    </li>
                    <li class="nav-item">
                        <a href="/dashboard/reports">Reports</a>
                    </li>
                </ul>
            </li>
        <?php } else if (Auth::user()->roleId === 3) { ?>
            <li class="parent-menu nav-item">
                <a href="/account">Account</a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="/account/packages">Packages</a>
                    </li>
                    <li class="nav-item">
                        <a href="/account/transactions">Order History</a>
                    </li>
                    <li class="nav-item">
                        <a href="/account/info">Account Info</a>
                    </li>
                </ul>
            </li>
        <?php } ?>
        <?php if (Auth::user()) { ?>
            <li class="parent-menu nav-item"><a href="/logout">Log Out</a></li>
        <?php } ?>
    </ul>
</nav>