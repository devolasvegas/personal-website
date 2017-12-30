<?php session_start();

$confirm_msg = (isset($_SESSION['confirm-msg']) ? $_SESSION['confirm-msg'] : '');
$first_name_error = (isset($_SESSION['errors']['first-name']) ? $_SESSION['errors']['first-name'] : '');
$last_name_error = (isset($_SESSION['errors']['last-name']) ? $_SESSION['errors']['last-name'] : '');
$email_error = (isset($_SESSION['errors']['email']) ? $_SESSION['errors']['email'] : '');
$message_error = (isset($_SESSION['errors']['message']) ? $_SESSION['errors']['message'] : '');


session_unset();
session_destroy();

try {
    require ('php/db.php');

    $sql = "SELECT * FROM portfolio_pieces";
    $cmd = $conn->prepare($sql);
    $cmd->execute();
    $pieces = $cmd->fetchAll();

    $conn = null;
} catch (Exception $e) {
    echo $e;
}

?>
<!DOCTYPE html>
<html class="no-js" lang="en-CA">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>Web Developer | Devon Daviau</title>
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="manifest" href="site.webmanifest" />
        <link rel="apple-touch-icon" href="icon.png" />
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/normalize.css" />
        <link rel="stylesheet" href="css/main.css" />
    </head>
    <body>
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <header class="clearfix">
            <nav role="navigation" class="main-nav">
                <ul class="page-links">
                    <li><a href="#about-me" title="Link to my bio.">about me</a></li>
                    <li><a href="#my-work" title="Link to my portfolio.">my work</a></li>
                    <li><a href="#contact-me" title="Link to my contact form.">contact me</a></li>
                    <li><a href="https://github.com/devolasvegas" title="Link to my Github profile." target="_blank"><i class="fa fa-github" aria-hidden="true"></i></a></li>
                    <li><a href="" title="Linked to my LinkedIn profile."><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                </ul>
            </nav>
        </header>
        <main role="main" class="container">
            <article class="about-me">

            </article>
            <article class="my-work">

                <?php
                    foreach ($pieces as $piece) {
                        echo '<section class="project">
                                <p>' . $piece['project_name']. '</p>
                                <p>' . $piece['link']. '</p>
                                <p>' . $piece['image']. '</p>
                                <p>' . $piece['description']. '</p>
                            </section>';
                    }
                ?>
                <section class="project-1">

                </section>
                <section class="project-2">

                </section>
                <section class="project-3">

                </section>
            </article>
            <article class="contact-me" id="contact-me">
                <h2>Get in Contact with Me</h2>
                <ul id="form-messages"><?php echo $confirm_msg; ?></ul>
                <form id="contact-form" action="php/contact.php" method="post">
                    <fieldset>
                        <legend>Your Personal Details</legend>
                        <p class="form-row">
                            <label for="first-name">First Name*</label>
                            <input class="<?php if($first_name_error) { echo 'error'; } ?>" id="first-name" name="first-name" type="text" />
                        </p>
                        <p class="form-row">
                            <label for="last-name">Last Name*</label>
                            <input class="<?php if($last_name_error) { echo 'error'; } ?>" id="last-name" name="last-name" type="text" />
                        </p>
                        <p class="form-row">
                            <label for="email">Email*</label>
                            <input class="<?php if($email_error) { echo 'error'; } ?>" id="email" name="email" />
                        </p>
                        <p class="form-row">
                            <label for="phone">Phone Number</label>
                            <input id="phone" name="phone" type="tel" />
                        </p>
                        <p class="form-row">
                            <label for="message">Your Message*</label>
                            <textarea class="<?php if($message_error) { echo 'error'; } ?>" name="message" id="message" cols="30" rows="10"></textarea>
                        </p>
                        <p class="form-row">
                            <input type="submit" value="Submit" />
                            <input type="hidden" name="is-ajax" />
                        </p>
                    </fieldset>
                </form>
            </article>
        </main>
        <footer>
            <small>&copy; Copyright 2017 Devon Daviau</small>
        </footer>

        <script src="js/vendor/modernizr-3.5.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.2.1.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script src="js/ajax-form-submit.js"></script>

        <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
        <script>
            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
        </script>
        <script src="https://www.google-analytics.com/analytics.js" async defer></script>
    </body>
</html>
