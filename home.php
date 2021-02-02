<?php
include 'backend/initialize.php';

if(isset($_SESSION['userLoggedIn'])){
   $user_id=$_SESSION['userLoggedIn'];
}else if(Login::isLoggedIn()){
   $user_id=Login::isLoggedIn();
}
$status=$verify->getVerifyStatus(["status"],$user_id);
if(!$status->status=='1'){
   redirect_to(url_for('index'));
}

$user=$loadFromUser->userData($user_id);

$pageTitle="Home / Twitter";

?>
<?php require_once 'backend/shared/header.php'; ?>
<div class="u-p-id" data-uid="<?php echo $user_id; ?>"></div>
<section class="wrapper">
   <?php  require_once 'backend/shared/nav_header.php'; ?>
   <main role="main">
     <section class="mainSectionContainer">
        <div class="header-top">
           <h4>Home</h4>
           <img src="<?php echo url_for("frontend/assets/images/star.svg"); ?>" width="40px" height="40px" alt="">
        </div>
        <div class="header-post">
           <a href="<?php echo url_for($user->username); ?>" role="link" class="userImageContainer" aria-label="<?php echo $user->firstName.' '.$user->lastName; ?>">
              <img src="<?php echo url_for($user->profileImage); ?>" alt="<?php echo $user->firstName.' '.$user->lastName; ?>">
           </a>
           <form class="textareaContainer">
              <textarea  id="postTextarea" placeholder="What's happening?" aria-label="What's happening?"></textarea>
              <div class="hash-box-wrapper">
                 <div class="hash-box" role="listbox" aria-multiselectable="false">
                    <ul>
                    </ul>
                 </div>
              </div>
              <div class="buttonsContainer">
                 <input type="submit" id="submitPostButton" disabled="true" role="button" value="POST">
                 <div class="w-count-wrapper">
                     <div id="count">200</div>
                     <div class="vertical-pipe"></div>
                 </div>
              </div>
           </form>
        </div>
        <section aria-label="Timeline:Your Home Timeline" class="postContainer">
          <?php $loadFromTweet->tweets($user_id,10); ?>
        </section>
        <section class="retweet-container">
           <div class="retweet-wrapper">
              <div class="retweet-wrapper-content">
                 <div role="menuitem" data-focusable="true" tabindex="0" class="menuItem retweet-it">
                    <div class="retweet-icon-wrapper">
                     <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" class="r-p" viewBox="0 0 24 24" ><g><path d="M23.615 15.477c-.47-.47-1.23-.47-1.697 0l-1.326 1.326V7.4c0-2.178-1.772-3.95-3.95-3.95h-5.2c-.663 0-1.2.538-1.2 1.2s.537 1.2 1.2 1.2h5.2c.854 0 1.55.695 1.55 1.55v9.403l-1.326-1.326c-.47-.47-1.23-.47-1.697 0s-.47 1.23 0 1.697l3.374 3.375c.234.233.542.35.85.35s.613-.116.848-.35l3.375-3.376c.467-.47.467-1.23-.002-1.697zM12.562 18.5h-5.2c-.854 0-1.55-.695-1.55-1.55V7.547l1.326 1.326c.234.235.542.352.848.352s.614-.117.85-.352c.468-.47.468-1.23 0-1.697L5.46 3.8c-.47-.468-1.23-.468-1.697 0L.388 7.177c-.47.47-.47 1.23 0 1.697s1.23.47 1.697 0L3.41 7.547v9.403c0 2.178 1.773 3.95 3.95 3.95h5.2c.664 0 1.2-.538 1.2-1.2s-.535-1.2-1.198-1.2z"/></g></svg>
                    </div>
                    <div class="retweet-text">
                       <span>Retweet</span>
                    </div>
                 </div>
                 <div role="menuitem" data-focusable="true" tabindex="0" class="menuItem">
                    <div class="retweet-icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" class="r-p" viewBox="0 0 24 24" class="r-m0bqgq r-4qtqp9 r-yyyyoo r-1q142lx r-1xvli5t r-zso239 r-dnmrzs r-bnwqim r-1plcrui r-lrvibr"><g><path d="M22.132 7.653c0-.6-.234-1.166-.66-1.59l-3.535-3.536c-.85-.85-2.333-.85-3.182 0L3.417 13.865c-.323.323-.538.732-.63 1.25l-.534 5.816c-.02.223.06.442.217.6.14.142.332.22.53.22.023 0 .046 0 .068-.003l5.884-.544c.45-.082.86-.297 1.184-.62l11.337-11.34c.425-.424.66-.99.66-1.59zm-17.954 8.69l3.476 3.476-3.825.35.348-3.826zm5.628 2.447c-.282.283-.777.284-1.06 0L5.21 15.255c-.292-.292-.292-.77 0-1.06l8.398-8.398 4.596 4.596-8.398 8.397zM20.413 8.184l-1.15 1.15-4.595-4.597 1.15-1.15c.14-.14.33-.22.53-.22s.388.08.53.22l3.535 3.536c.142.142.22.33.22.53s-.08.39-.22.53z"/></g></svg>
                    </div>
                    <div class="retweet-text">
                       <span>Quote Retweet</span>
                    </div>
                 </div>
              </div>
           </div>
        </section>
     </section>
     <aside role="complementary">
        Aside
     </aside>
   </main>
</section>
<script src="<?php echo url_for("frontend/assets/js/fetchTweet.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/likeTweet.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/hashtag.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/common.js"); ?>"></script>