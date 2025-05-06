<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Meme Appreciation Month</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="xp.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" />
  </head>

  <body>
    <?php
    //open database
    $db = new PDO('sqlite:mam.sqlite');
    ?>
    <div class="window" style="min-width: 640px; max-width: 1000px; width: flex;font-size: 14px;">
        <div class="title-bar">
          <div class="title-bar-text">Information about Meme Appreciation Month 3: Found it!</div>
          <div class="title-bar-controls">
            <a href="https://mememonth.org"><button aria-label="Minimize"></button></a>
            <a href="https://mememonth.org"><button aria-label="Maximize"></button></a>
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><button aria-label="Close"></button></a>
          </div>
        </div>
        <div class="window-body">
            <section class="tabs" style="width: flex;">
                <menu role="tablist" aria-label="Windowstabs">
                  <button role="tab" aria-selected="true" aria-controls="tab-A">About</button>
                  <button role="tab" aria-controls="tab-B">Who?</button>
                  <button role="tab" aria-controls="tab-C">When?</button>
                  <button role="tab" aria-controls="tab-D">Where and what?</button>
                  <button role="tab" aria-controls="tab-E">Why?</button>
                  <button role="tab" aria-controls="tab-F">QSL?</button>
                  <button role="tab" aria-controls="tab-G">Archive 2024</button>
                  <button role="tab" aria-controls="tab-H">Archive 2023</button>
                  <button role="tab" aria-controls="tab-I">Archive 2022</button>
                  <button role="tab" aria-controls="tab-J">Legal stuff</button>
                </menu>
                <!-- the tab content -->
                <article role="tabpanel" id="tab-A" style="size: A4">
                    <h3>What in the world is this "Meme Appreciation Month"?</h3>
                    <p>The archives say it started in Canada as the brainchild of Ben (VA4BEN), as a way to spread joy & cheer to all the good little hams on the RF spectrum.</p>
                    <p>Honestly it's a way for young hams to have some fun, use a cool callsign and do a neat activity together.</p>
                    <p>The shenanigans started 2022 with the first ever Meme Apprecation Month and iconic callsigns such as VB4LIGMA, VB3YEET, VC9CATGIRL, VC3RIKROLL, VC3DEEZ and many more. </p>
                    <p>The second event in 2023 birthed callsigns such as VC9FEMBOY, DZ2NUTS, PD33ZDOGE and DL0NGCAT.</p>
                    <p>2024 was the fourth installment already. Well. Kind of. Thats the joke.</p>
                    <p>2025 is the third installment, since we were successful in finding it in 2024.</p>
                    <h4>What is a meme and why does it have to be appreciated?</h4>
                    <p>Officially, according to a dictionary, a meme is "an image, video, piece of text, etc., typically humorous in nature, that is copied and spread rapidly by internet users, often with slight variations".</p>
                    <p>To make it short - a meme is something most young people know and find funny.</p>
                    <p>If this funny bit makes it into amateur radio and attracts the young folk - perfect, right?</p>
                    <h4>Meme Appreciation Award 2025</h4>
                    <p>This time, for your QSOs with all the meme callsigns, you can earn yourself some fancy awards!</p>
                    <p>You can check if you qualify and download your award on this nifty webpage:</p>
                    <a href="https://hamawardz.app/logcheck/meme-appreciation-award-2025"><button>Check your award here</button></a>
                    <p></p>
                    <hr>
                    <h4>This info in foreign languages:</h4>
                    <section class="field-row">
                      <a href="https://www.db4scw.de/meme-appreciation-month/"><button>Deutsch/German</button></a>
                    </section>
                </article>
                <article role="tabpanel" hidden id="tab-B">
                    <h3>Who is in this? How much LIDs can there be?</h3>
                    <p>
                      The following callsigns have been registered for Meme Appreciation Month:
                        <p>IARU Region 1:
                        <ul>
                          <?php
                          $query1 = "SELECT * FROM callsigns WHERE year = 2025 AND region = 1 AND hide = 0 ORDER BY sort ASC, id ASC";
                          $stmt1 = $db->query($query1);
                          $results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                          if (count($results1) > 0) {
                              foreach ($results1 as $row) {
                                  $flag = htmlspecialchars($row['flag']);
                                  $callsign = htmlspecialchars($row['callsign']);
                                  $mainop = htmlspecialchars($row['mainop']);
                                  echo "<li><span class=\"flag-icon flag-icon-{$flag} flag-icon-squared\"></span><a href=\"https://qrz.com/db/{$callsign}\" style=\"color: black; padding-left: 5px;\">{$callsign}</a> <!-- {$mainop} --></li>";
                              }
                          } else {
                              echo "<li>For this region, there are no participants announced yet. Check back later!</li>";
                          }
                          ?>
                        </ul>
                      </p>
                      <p>IARU Region 2:
                        <ul>
                        <?php
                          $query1 = "SELECT * FROM callsigns WHERE year = 2025 AND region = 2 AND hide = 0 ORDER BY sort ASC, id ASC";
                          $stmt1 = $db->query($query1);
                          $results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                          if (count($results1) > 0) {
                              foreach ($results1 as $row) {
                                  $flag = htmlspecialchars($row['flag']);
                                  $callsign = htmlspecialchars($row['callsign']);
                                  $mainop = htmlspecialchars($row['mainop']);
                                  echo "<li><span class=\"flag-icon flag-icon-{$flag} flag-icon-squared\"></span><a href=\"https://qrz.com/db/{$callsign}\" style=\"color: black; padding-left: 5px;\">{$callsign}</a> <!-- {$mainop} --></li>";
                              }
                          } else {
                              echo "<li>For this region, there are no participants announced yet. Check back later!</li>";
                          }
                          ?>
                        </ul>
                      </p>
                      <p>IARU Region 3:
                        <ul>
                        <?php
                          $query1 = "SELECT * FROM callsigns WHERE year = 2025 AND region = 3 AND hide = 0 ORDER BY sort ASC, id ASC";
                          $stmt1 = $db->query($query1);
                          $results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                          if (count($results1) > 0) {
                              foreach ($results1 as $row) {
                                  $flag = htmlspecialchars($row['flag']);
                                  $callsign = htmlspecialchars($row['callsign']);
                                  $mainop = htmlspecialchars($row['mainop']);
                                  echo "<li><span class=\"flag-icon flag-icon-{$flag} flag-icon-squared\"></span><a href=\"https://qrz.com/db/{$callsign}\" style=\"color: black; padding-left: 5px;\">{$callsign}</a> <!-- {$mainop} --></li>";
                              }
                          } else {
                              echo "<li>For this region, there are no participants announced yet. Check back later!</li>";
                          }
                          ?>
                        </ul>
                      </p>
                    </p>
                    
                    <p>The actual operators of these calls may and will rotate throughout the event in order to get the most out of our money (cries in event callsign fees).</p>
                    <hr>
                    <h3>How to join the madness?</h3>
                    <a rel="noopener" target="_blank" href="https://discord.gg/fyvjGkky7W"><img class="hover-shadow" src="join-our-discord.png" alt="Join our Discord server" style="max-width:200px;border-radius:5px;"></a>
                </article>
                <article role="tabpanel" hidden id="tab-C">
                    <h3>When does this happen?</h3>
                    <?php
                      $yearstmt = $db->query("SELECT MAX(year) AS max_year FROM callsigns");
                      $maxYear = $yearstmt->fetch(PDO::FETCH_ASSOC)['max_year'];
                    ?>
                    <p>The event will be active between June 15, <?php echo($maxYear)?> and August 15, <?php echo($maxYear)?>.</p>
                    <p>Between the group of operators behind this event, we will keep the meme calls on air for most of the event, surely with enough dial spinning you too can add a meme call to your logbook.</p>
                </article>
                <article role="tabpanel" hidden id="tab-D">
                    <h3>What and where do you operate?</h3>
                    <p>We will most likely operate mostly FT8 (to propagate the funny to as much people as possible) and SSTV (to share more memes). </p>
                    <p>Furthermore, SSB operations are planned, as well as other digital modes. OLIVIA, JS8, maybe Hellschreiber? Who knows.</p>
                    <p>If you are a POTA hunter, keep your eyes peeled for some POTA activations, too.</p>

                    <h4>Which of the Megahertz can I find you on?</h4>
                    <p>Likely operations will include all of HF (160m-10m), as well as 2m, 70cm and QO-100 satellite work (for those within the footprint).</p>
                </article>
                <article role="tabpanel" hidden id="tab-E">
                  <h3>Why the heck do you do this?</h3>
                  <p>Boredom, mischief, and too much free time (^:</p>
                  <p>Aside from that, we need moooooore of these young ham persons ;)</p>
                </article>
                <article role="tabpanel" hidden id="tab-F">
                  <h3>How do I get one of these epic meme-y goodness QSL cards?</h3>
                  <p>QSL policies vary from operator to operator. Please consult the QRZ pages of each callsign.</p>
                  <hr>
                  <h4>Examples of past QSL cards:</h4>
                  <img style="width: auto; height: 200px;" src="DL0LOL_QSL_card.jpg">
                  <img style="width: auto; height: 200px;" src="DL0NGCAT_QSL_card.jpg">
                  <img style="width: auto; height: 200px;" src="DF4CEPALM_QSL_card.jpg">
                </article>
                <article role="tabpanel" hidden id="tab-G">
                    <h3>Meme Appreciation Month 4: The search for the Third</h3>
                    <h3 style="font-size: 20px;">Callsign Archive</h3>
                    <p>
                      The following callsigns were on air for Meme Appreciation Month 4: The search for the Third from 2024-06-15 until 2024-08-15: 
                      <p>IARU Region 1:
                        <ul>
                        <?php
                          $query1 = "SELECT * FROM callsigns WHERE year = 2024 AND region = 1 AND hide = 0 ORDER BY sort ASC, id ASC";
                          $stmt1 = $db->query($query1);
                          $results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                          if (count($results1) > 0) {
                              foreach ($results1 as $row) {
                                  $flag = htmlspecialchars($row['flag']);
                                  $callsign = htmlspecialchars($row['callsign']);
                                  $mainop = htmlspecialchars($row['mainop']);
                                  echo "<li><span class=\"flag-icon flag-icon-{$flag} flag-icon-squared\"></span><a href=\"https://qrz.com/db/{$callsign}\" style=\"color: black; padding-left: 5px;\">{$callsign}</a> <!-- {$mainop} --></li>";
                              }
                          } else {
                              echo "<li>For this region, there are no participants announced yet. Check back later!</li>";
                          }
                          ?>
                        </ul>
                      </p>
                      <p>IARU Region 2:
                        <ul>
                        <?php
                          $query1 = "SELECT * FROM callsigns WHERE year = 2024 AND region = 2 AND hide = 0 ORDER BY sort ASC, id ASC";
                          $stmt1 = $db->query($query1);
                          $results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                          if (count($results1) > 0) {
                              foreach ($results1 as $row) {
                                  $flag = htmlspecialchars($row['flag']);
                                  $callsign = htmlspecialchars($row['callsign']);
                                  $mainop = htmlspecialchars($row['mainop']);
                                  echo "<li><span class=\"flag-icon flag-icon-{$flag} flag-icon-squared\"></span><a href=\"https://qrz.com/db/{$callsign}\" style=\"color: black; padding-left: 5px;\">{$callsign}</a> <!-- {$mainop} --></li>";
                              }
                          } else {
                              echo "<li>For this region, there are no participants announced yet. Check back later!</li>";
                          }
                          ?>
                        </ul>
                      </p>
                      <p>IARU Region 3:
                        <ul>
                        <?php
                          $query1 = "SELECT * FROM callsigns WHERE year = 2024 AND region = 3 AND hide = 0 ORDER BY sort ASC, id ASC";
                          $stmt1 = $db->query($query1);
                          $results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                          if (count($results1) > 0) {
                              foreach ($results1 as $row) {
                                  $flag = htmlspecialchars($row['flag']);
                                  $callsign = htmlspecialchars($row['callsign']);
                                  $mainop = htmlspecialchars($row['mainop']);
                                  echo "<li><span class=\"flag-icon flag-icon-{$flag} flag-icon-squared\"></span><a href=\"https://qrz.com/db/{$callsign}\" style=\"color: black; padding-left: 5px;\">{$callsign}</a> <!-- {$mainop} --></li>";
                              }
                          } else {
                              echo "<li>For this region, there are no participants announced yet. Check back later!</li>";
                          }
                          ?>
                        </ul>
                      </p>
                    </p>
                    <h3>Award check:</h3>
                    <a href="https://hamawardz.app/logcheck/meme-appreciation-award-2024"><button>Awardcheck Meme Appreciation Month 4 (2024)</button></a>
                </article>
                <article role="tabpanel" hidden id="tab-H">
                    <h3>Meme Appreciation Month 2: Electric Boogaloo</h3>
                    <h3 style="font-size: 20px;">Callsign Archive</h3>
                    <p>
                      The following callsigns were on air for Meme Appreciation Month 2: Electric Boogaloo from 2023-06-15 until 2023-08-15: 
                      <p>IARU Region 1:
                        <ul>
                          <?php
                            $query1 = "SELECT * FROM callsigns WHERE year = 2023 AND region = 1 AND hide = 0 ORDER BY sort ASC, id ASC";
                            $stmt1 = $db->query($query1);
                            $results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                            if (count($results1) > 0) {
                                foreach ($results1 as $row) {
                                    $flag = htmlspecialchars($row['flag']);
                                    $callsign = htmlspecialchars($row['callsign']);
                                    $mainop = htmlspecialchars($row['mainop']);
                                    echo "<li><span class=\"flag-icon flag-icon-{$flag} flag-icon-squared\"></span><a href=\"https://qrz.com/db/{$callsign}\" style=\"color: black; padding-left: 5px;\">{$callsign}</a> <!-- {$mainop} --></li>";
                                }
                            } else {
                                echo "<li>For this region, there are no participants announced yet. Check back later!</li>";
                            }
                          ?>
                        </ul>
                      </p>
                      <p>IARU Region 2:
                        <ul>
                          <?php
                            $query1 = "SELECT * FROM callsigns WHERE year = 2023 AND region = 2 AND hide = 0 ORDER BY sort ASC, id ASC";
                            $stmt1 = $db->query($query1);
                            $results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                            if (count($results1) > 0) {
                                foreach ($results1 as $row) {
                                    $flag = htmlspecialchars($row['flag']);
                                    $callsign = htmlspecialchars($row['callsign']);
                                    $mainop = htmlspecialchars($row['mainop']);
                                    echo "<li><span class=\"flag-icon flag-icon-{$flag} flag-icon-squared\"></span><a href=\"https://qrz.com/db/{$callsign}\" style=\"color: black; padding-left: 5px;\">{$callsign}</a> <!-- {$mainop} --></li>";
                                }
                            } else {
                                echo "<li>For this region, there are no participants announced yet. Check back later!</li>";
                            }
                          ?>
                        </ul>
                      </p>
                      <p>IARU Region 3:
                        <ul>
                          <?php
                            $query1 = "SELECT * FROM callsigns WHERE year = 2023 AND region = 3 AND hide = 0 ORDER BY sort ASC, id ASC";
                            $stmt1 = $db->query($query1);
                            $results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                            if (count($results1) > 0) {
                                foreach ($results1 as $row) {
                                    $flag = htmlspecialchars($row['flag']);
                                    $callsign = htmlspecialchars($row['callsign']);
                                    $mainop = htmlspecialchars($row['mainop']);
                                    echo "<li><span class=\"flag-icon flag-icon-{$flag} flag-icon-squared\"></span><a href=\"https://qrz.com/db/{$callsign}\" style=\"color: black; padding-left: 5px;\">{$callsign}</a> <!-- {$mainop} --></li>";
                                }
                            } else {
                                echo "<li>For this region, there are no participants announced yet. Check back later!</li>";
                            }
                          ?>
                        </ul>
                      </p>
                    </p>
                    
                    <h3>Award check:</h3>
                    <a href="https://hamawardz.app/logcheck/meme-appreciation-award-2023"><button>Awardcheck Meme Appreciation Month 2 (2023)</button></a>
                </article>
                <article role="tabpanel" hidden id="tab-I">
                    <h3>Meme Appreciation Month</h3>
                    <h3 style="font-size: 20px;">Callsign Archive</h3>
                    <p>
                      The following callsigns were on air for the first ever Meme Appreciation Month from 2022-06-25 until 2022-08-05:
                      <p>IARU Region 1:
                        <ul>
                          <?php
                            $query1 = "SELECT * FROM callsigns WHERE year = 2022 AND region = 1 AND hide = 0 ORDER BY sort ASC, id ASC";
                            $stmt1 = $db->query($query1);
                            $results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                            if (count($results1) > 0) {
                                foreach ($results1 as $row) {
                                    $flag = htmlspecialchars($row['flag']);
                                    $callsign = htmlspecialchars($row['callsign']);
                                    $mainop = htmlspecialchars($row['mainop']);
                                    echo "<li><span class=\"flag-icon flag-icon-{$flag} flag-icon-squared\"></span><a href=\"https://qrz.com/db/{$callsign}\" style=\"color: black; padding-left: 5px;\">{$callsign}</a> <!-- {$mainop} --></li>";
                                }
                            } else {
                                echo "<li>For this region, there are no participants announced yet. Check back later!</li>";
                            }
                          ?>
                        </ul>
                      </p>
                      <p>IARU Region 2:
                        <ul>
                          <?php
                            $query1 = "SELECT * FROM callsigns WHERE year = 2022 AND region = 2 AND hide = 0 ORDER BY sort ASC, id ASC";
                            $stmt1 = $db->query($query1);
                            $results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                            if (count($results1) > 0) {
                                foreach ($results1 as $row) {
                                    $flag = htmlspecialchars($row['flag']);
                                    $callsign = htmlspecialchars($row['callsign']);
                                    $mainop = htmlspecialchars($row['mainop']);
                                    echo "<li><span class=\"flag-icon flag-icon-{$flag} flag-icon-squared\"></span><a href=\"https://qrz.com/db/{$callsign}\" style=\"color: black; padding-left: 5px;\">{$callsign}</a> <!-- {$mainop} --></li>";
                                }
                            } else {
                                echo "<li>For this region, there are no participants announced yet. Check back later!</li>";
                            }
                          ?>
                        </ul>
                      </p>
                      <p>IARU Region 3:
                        <ul>
                          <li>No Calls were registered in Region 3 in 2022.</li>
                        </ul>
                      </p>
                    </p>
                    
                    <h3>Award check:</h3>
                    <p>There were no awards in 2022.</p>
                </article>
                <article role="tabpanel" hidden id="tab-J">
                    <h3>Impressum</h3>
                    <p><a href="https://legal.wolf.taipei/impressum.html">Click here for Impressum</a></p>
                    <h3>Privacy declaration</h3>
                    <p><a href="https://legal.wolf.taipei/privacy.html">Click here for Privacy declaration</a></p>
                </article>
            </section>

            <section class="field-row" style="justify-content: flex-end">
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><button>OK</button></a>
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><button>Cancel</button></a>
            </section>
        </div>

        <div class="status-bar">
            <p class="status-bar-field" style="font-family: Arial;">Press your PTT for more fun.</p>
            <p class="status-bar-field" style="font-family: Arial;">Transmitting all your sensitive passwords on 27.025 MHz USB.....<?php echo rand(50,99);?>% done</p>
            <p class="status-bar-field" style="font-family: Arial;" style="justify-content: flex-end">CPU Usage: <?php echo rand(61,99);?>%</p>
        </div>

      </div>

      <div class="footer">
        <div class="footer-header"></div>
        <div class="footer-content">
          Page best viewed in IE 6 at 640 x 480. Thanks!
        </div>
        <div style="font-size: 12px;">The only cookies we use are the ones we feed our web developers.</div>
      </div>
  </body>
<script src="script_db4scw.js"></script>


</html>
