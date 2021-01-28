<html lang="en">
  <head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/reset.min.css" />
    <link rel="stylesheet" href="css/nav_styles.css" />
    <link rel="stylesheet" href="css/header-12.css" />
    <link rel="stylesheet" href="css/style.css">

  </head>
  <body>
    <!-- Header Start -->
    <header class="site-header">
      <div class="wrapper site-header__wrapper">
        <div class="site-header__start">
          <a class="brand"><?php
          include ("login/config.php");
          if (! isset($_SESSION)){
            session_start();
          }
          echo $users[$_SESSION['user_id'] - 1]['username'];
          ?></a>
        </div>
        <div class="site-header__middle">
          <ul class="sub-nav">
            <li class=""><a href="home.php">Employee data</a></li>
            <li class=""><a href="profile.php">Profile</a></li>
            <li class=""><a href="#">Feature request</a></li>
          </ul>
        </div>
        <div class="site-header__end">

        <a href="login/logout.php" class="button button--icon" aria-label="Sign in">
          <svg
            version="1.1"
            viewBox="0 0 100 100"
            xmlns="http://www.w3.org/2000/svg"
          >
            <g>
              <path
                d="m83.898 77.398c-2.3984-13-13.699-22.5-26.898-22.5h-13.699c-13.5 0-24.898 9.8008-27.102 23.102-1.1016 6.6992 4.1016 12.699 10.801 12.699h46.199c6.8008 0 12-6.1992 10.801-12.898z"
              />
              <path
                d="m36.102 44.199c7.8008 7.8008 20.398 8 28.398 0.39844l0.19922-0.19922c6.8984-6.6016 7.6016-17.301 1.5-24.699-8.3008-10-23.699-9.8008-31.699 0.39844-5.6016 7.1992-5 17.5 1.5 24z"
              />
            </g>
          </svg>
          <span>Sign out</span>
        </a>
        
        </div>
      </div>
    </header>
    <!-- Header End -->
    <div class="container">
        <?php

            $tax_file = file_get_contents("tax-tables.json");
            $tax_json = json_decode($tax_file, true);

            if ($tax_json === null && json_last_error() !== JSON_ERROR_NONE) {
                #https://www.geeksforgeeks.org/how-to-pop-an-alert-message-box-using-php/#:~:text=PHP%20doesn%E2%80%99t%20support%20alert%20message%20box%20because%20it,to%20alert%20the%20message%20box%20on%20the%20screen.
                exit('Error loading tax file');
            }


            $employee_file = file_get_contents("employees-final.json");
            $employee_json = json_decode($employee_file, true);

            if ($tax_json === null && json_last_error() !== JSON_ERROR_NONE) {
                exit('Error loading employee file');
            }
            
        ?>
    </div>
  </body>
</html>
