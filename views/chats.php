<?php
session_start();
require_once '../vendor/autoload.php';
require_once '../src/Classes/Db.php';
require_once '../src/Classes/User.php';
require_once '../src/Classes/Auth.php';

use Classes\Db, Classes\User, Classes\Auth;

$db = new Db();


$auth = new Auth($db);
$loggedInUser = $auth->loginUser('a@a.com','password');

// $messages = $loggedInUser->getLastDecryptedMessagesForUser();


//$user->isAuthenticated() ? null : header('Location: login.php');





$additionalScripts = [
    '<link rel="stylesheet" href="css/style.css">'
];
?>

<?php include('head.php'); ?>


<div class="container py-3">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card chat-app">
                <div id="plist" class="people-list">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                    <ul class="list-unstyled chat-list mt-2 mb-0">
                        <?php foreach($loggedInUser->getLastDecryptedMessagesForUser(7) as $message): ?>
                            <li class="clearfix">
                                <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                <div class="about">
                                    <div class="name"><?= $message['name'] ?></div>
                                    <div class="status"> <i class="fa fa-circle online"></i> online </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="chat">
                    <div class="chat-header clearfix">
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                </a>
                                <div class="chat-about">
                                    <h6 class="m-b-0"><?= '' ?></h6>
                                    <small>Last seen: 2 hours ago</small>
                                </div>
                            </div>
                            <div class="col-lg-6 hidden-sm text-right">
                                <a href="javascript:void(0);" class="btn btn-outline-secondary"><i
                                        class="fa fa-camera"></i></a>
                                <a href="javascript:void(0);" class="btn btn-outline-primary"><i
                                        class="fa fa-image"></i></a>
                                <a href="javascript:void(0);" class="btn btn-outline-info"><i
                                        class="fa fa-cogs"></i></a>
                                <a href="javascript:void(0);" class="btn btn-outline-warning"><i
                                        class="fa fa-question"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="chat-history">
                        <ul class="m-b-0">
                            <li class="clearfix">
                                <div class="message-data text-right">
                                    <span class="message-data-time">10:10 AM, Today</span>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                                </div>
                                <div class="message other-message float-right"> Hi Aiden, how are you? How is the
                                    project coming along? </div>
                            </li>
                            <li class="clearfix">
                                <div class="message-data">
                                    <span class="message-data-time">10:12 AM, Today</span>
                                </div>
                                <div class="message my-message">Are we meeting today?</div>
                            </li>
                            <li class="clearfix">
                                <div class="message-data">
                                    <span class="message-data-time">10:15 AM, Today</span>
                                </div>
                                <div class="message my-message">Project has been already finished and I have results to
                                    show you.</div>
                            </li>
                        </ul>
                    </div>
                    <div class="chat-message clearfix">
                        <div class="input-group mb-0">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-send"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Enter text here...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>