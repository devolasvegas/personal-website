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
    require ('php/mailing-details.php');
    mail($my_address, 'Website Home Page Error', $e);
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
                <h2>About Me</h2>
                <section>
                    <div class="bio-img">
                        <img src="img/headshot.jpg" alt="Portrait of Yours Truly" />
                        <small>Portrait courtesy of <a href="http://navynhum.com" target="_blank">Navy Nhum Photography</a></small>
                    </div>
                    <div class="bio-text">
                        <p>Hi! My name is Devon and I am a junior full-stack web developer. I love code, teaching people to code, and some other stuff too. But my biggest passion in life is learning. I like to learn new things every day and if I am not learning something new, I don't consider it a full day.</p>
                        <p>Born in Beautiful Barrie, Ontario, I was raised in the U.S.A. I returned to Canada in 2000 after my first year of university, and have been here since. My journey has led me down many paths since then, but I eventually found my way to HTML and CSS, which inspired me to join the Interactive Web Design and Development program at Georgian College in Barrie. Since completing the IWDD course, I have had the good fortune to be able to work in the industry, learning WordPress and honing my development skills.</p>
                        <p>Now I look forward to more opportunities to learn and grow as a web developer. While I have a great deal of love for the front-end, I particularly look forward to building on my back-end and programming skills.</p>
                    </div>
                </section>
            </article>
            <article class="my-work">
                <h2>My Work</h2>
                <?php
                    foreach ($pieces as $piece) {
                        echo '<section class="project">
                                <div class="project-image">
                                    <a href="' . $piece['link'] . '" target="_blank">
                                        <img src="' . $piece['image'] . '" alt="' . $piece['project_name'] . ' Screen Shot" />
                                    </a>
                                </div>
                                <div class="project-description">
                                    <h3>' . $piece['project_name'] . '</h3>
                                    <p>' . $piece['description'] . '</p>
                                    <a href="' . $piece['link'] . '" target="_blank" class="button">Visit this Project</a>
                                </div>
                            </section>';
                    }
                ?>

            </article>
            <article class="contact-me" id="contact-me">
                <h2>Contact Me</h2>
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
            <small>&copy; <?php echo date("Y") ?> Devon Daviau. All rights reserved.</small>
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
