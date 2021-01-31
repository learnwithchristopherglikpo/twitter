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
                       <!-- <li role="option" aria-selected="true">
                          <div role="button" tabindex="0" data-focusable="true" class="getValue h-ment">#PHP</div>
                       </li>
                       <li role="option" aria-selected="true">
                          <div role="button" tabindex="0" data-focusable="true" class="getValue h-ment">#PHP</div>
                       </li>
                       <li role="option" aria-selected="true">
                          <div role="button" tabindex="0" data-focusable="true" class="getValue h-ment">#PHP</div>
                       </li>
                       <li role="option" aria-selected="true">
                          <div role="button" tabindex="0" data-focusable="true" class="getValue h-ment">#PHP</div>
                       </li> -->
                       <li role="option" aria-selected="true">
                          <div role="button" tabindex="0" data-focusable="true" class="h-ment">
                             <div class="ment-w-container">
                                <div class="profile-user-icon">
                                    <div class="profile-user-wrapper">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="p-icon" viewBox="0 0 24 24"><g><path d="M12.225 12.165c-1.356 0-2.872-.15-3.84-1.256-.814-.93-1.077-2.368-.805-4.392.38-2.826 2.116-4.513 4.646-4.513s4.267 1.687 4.646 4.513c.272 2.024.008 3.46-.806 4.392-.97 1.106-2.485 1.255-3.84 1.255zm5.849 9.85H6.376c-.663 0-1.25-.28-1.65-.786-.422-.534-.576-1.27-.41-1.968.834-3.53 4.086-5.997 7.908-5.997s7.074 2.466 7.91 5.997c.164.698.01 1.434-.412 1.967-.4.505-.985.785-1.648.785z"/></g></svg>
                                    </div>
                                    <div class="f-follow">
                                       Follow
                                    </div>
                                </div>
                                <div class="ment-profile-wrapper">
                                   <div class="ment-profile-pic">
                                      <img src="<?php echo url_for('frontend/assets/images/profilePic.jpeg') ?>" alt="User FullName">
                                   </div>
                                   <div class="ment-profile-name">
                                      <div class="ment-user-fullName">
                                         <span class="ment-user-fullName-text">Christopher Glikpo</span>
                                      </div>
                                      <div class="ment-user-username">
                                         <span class="ment-user-username-text getValue">@cglikpo</span>
                                      </div>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </li>
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
     </section>
     <aside role="complementary">
        Aside
     </aside>
   </main>
</section>
<script src="<?php echo url_for("frontend/assets/js/fetchTweet.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/common.js"); ?>"></script>